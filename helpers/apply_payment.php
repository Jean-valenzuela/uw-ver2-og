<?php
require_once __DIR__ . '/payment_records.php';
// Caller owns an open transaction and the agreement row lock.
function apply_loan_payment($a, $rows, $amount, $mode, $date, $note, $token, $actor, $q = null)
{
    global $conn;
    $id = $a['agreement_id'];
    $lender = ['user_id' => $actor];
    db('INSERT INTO loan_payments(agreement_id,recorded_by,amount,payment_date,reference_note,request_token) VALUES (?,?,?,?,?,?)', [$id, $lender['user_id'], $amount / 100, $date, substr($note, 0, 255), $token]);
    $paymentId = $conn->insert_id;
    $left = $amount;
    foreach ($rows as $i) {
        if (!$left)
            break;
        $due = $i['principal_remaining'] + $i['interest_remaining'];
        if (!$due)
            continue;
        $take = min($left, $due);
        $interest = $mode === 'interest-only' ? $take : min($i['interest_remaining'], (int) round($take * $i['interest_remaining'] / $due));
        $principal = $take - $interest;
        db('INSERT INTO lender_payment_allocations(payment_id,installment_id,principal_amount,interest_amount) VALUES (?,?,?,?)', [$paymentId, $i['installment_id'], $principal / 100, $interest / 100]);
        db('UPDATE loan_installments SET amount_paid=amount_paid+? WHERE installment_id=?', [$take / 100, $i['installment_id']]);
        $left -= $take;
        if ($mode === 'interest-only')
            break;
    }
    if ($q) {
        $from = $q['from'];
        $carry = $q['carry_cents'] / 100;
        db('UPDATE loan_schedule_components SET principal_due=principal_due-? WHERE installment_id=?', [$carry, $from['installment_id']]);
        db('UPDATE loan_installments SET amount_due=amount_due-? WHERE installment_id=?', [$carry, $from['installment_id']]);
        if ($q['next']) {
            $nextId = $q['next']['installment_id'];
            db('UPDATE loan_installments SET amount_due=amount_due+?,settled_at=NULL WHERE installment_id=?', [$carry, $nextId]);
            db('UPDATE loan_schedule_components SET principal_due=principal_due+? WHERE installment_id=?', [$carry, $nextId]);
        } else {
            $added = $q['added_interest_cents'] / 100;
            db('INSERT INTO loan_installments(agreement_id,installment_number,due_date,amount_due) VALUES (?,?,?,?)', [$id, (int) $from['installment_number'] + 1, $q['next_due_date'], $carry + $added]);
            $nextId = $conn->insert_id;
            db('INSERT INTO loan_schedule_components(installment_id,principal_due,interest_due) VALUES (?,?,?)', [$nextId, $carry, $added]);
            db('UPDATE loan_agreements SET total_interest=total_interest+?,total_due=total_due+? WHERE agreement_id=?', [$added, $added, $id]);
        }
        db('INSERT INTO loan_principal_carries(payment_id,from_installment_id,to_installment_id,principal_amount,added_interest) VALUES (?,?,?,?,?)', [$paymentId, $from['installment_id'], $nextId, $carry, $q['added_interest_cents'] / 100]);
    }
    db('UPDATE loan_installments SET settled_at=CASE WHEN amount_paid>=amount_due THEN COALESCE(settled_at,NOW()) ELSE NULL END WHERE agreement_id=?', [$id]);
    if (!(int) db('SELECT COUNT(*) n FROM loan_installments WHERE agreement_id=? AND amount_due>amount_paid', [$id])->get_result()->fetch_assoc()['n'])
        db("UPDATE loan_agreements SET status='completed' WHERE agreement_id=?", [$id]);
    return $paymentId;
}
