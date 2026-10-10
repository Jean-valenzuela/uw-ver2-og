<?php
require_once __DIR__ . '/../helpers/lender_records.php';
$lender = lender_user();
$applicants = lender_applicants($lender['user_id']);
$loans = lender_loans($lender['user_id']);
$counts = [];
$tableRows = [];
if ($mode === 'applications') {
    $title = 'Applications';
    $description = 'Review borrower profiles and send account decisions.';
    $counts = ['Total Applicants' => count($applicants), 'Pending Review' => 0, 'Approved' => 0, 'Denied' => 0];
    $headers = ['#', 'Applicant', 'Application ID', 'Date Applied', 'Loan Amount', 'Purpose', 'Term', 'Status', 'Action'];
    foreach ($applicants as $index => $a) {
        $counts[['pending' => 'Pending Review', 'approved' => 'Approved', 'rejected' => 'Denied'][$a['account_status']]]++;
        if ($a['account_status'] !== 'pending')
            continue;
        $index = count($tableRows);
        $p = $a['preferences'];
        $tableRows[] = ['status' => $a['display_status'], 'type' => 'Installment', 'term' => (string) ($p['loan_term'] ?? ''), 'cells' => [$index + 1, $a['user_fn'] . ' ' . $a['user_ln'], 'APP-' . $a['user_id'], $a['submitted_at'] ?: 'Not recorded', isset($p['loan_amount']) ? money($p['loan_amount']) : 'Not recorded', ucfirst($p['loan_purpose'] ?? 'Not recorded'), isset($p['loan_term']) ? $p['loan_term'] . ' months' : 'Not recorded', $a['display_status']], 'id' => $a['user_id'], 'kind' => 'application', 'button' => 'View profile'];
    }
} elseif ($mode === 'loaners') {
    $title = 'Loaners';
    $description = 'Borrower accounts, current loan balances, and application status.';
    $counts = ['Total Loaners' => 0, 'Active Loaners' => 0, 'Pending Applicants' => 0, 'Overdue Loaners' => 0];
    $headers = ['#', 'Client Name', 'Phone Number', 'Loan Type', 'Total Loan', 'Total Due', 'Status', 'Client Label', 'Date Registered', 'Action'];
    foreach ($applicants as $index => $a) {
        $own = array_values(array_filter($loans, fn($l) => (int) $l['borrower_id'] === (int) $a['user_id']));
        $active = array_filter($own, fn($l) => in_array($l['display_status'], ['Active', 'Overdue'], true));
        $overdue = array_filter($own, fn($l) => $l['display_status'] === 'Overdue');
        $status = $a['display_status'];
        if ($a['account_status'] === 'approved') {
            $counts['Total Loaners']++;
            if ($active)
                $counts['Active Loaners']++;
            if ($overdue)
                $counts['Overdue Loaners']++;
            $status = $overdue ? 'Overdue' : ($active ? 'Active' : ($own ? $own[0]['display_status'] : 'Approved'));
        }
        if ($a['account_status'] === 'pending')
            $counts['Pending Applicants']++;
        $type = $own ? 'Money' : 'No loan';
        $tableRows[] = ['status' => $status, 'type' => $type, 'term' => '', 'cells' => [$index + 1, $a['user_fn'] . ' ' . $a['user_ln'], $a['phone'], $type, money(array_sum(array_column($own, 'principal'))), money(array_sum(array_column($own, 'balance'))), $status, $own ? 'Borrower' : 'Applicant', $a['submitted_at'] ?: 'Not recorded'], 'id' => $a['user_id'], 'kind' => 'application', 'button' => 'View profile'];
    }
} elseif ($mode === 'loans') {
    $title = 'Loans';
    $description = 'Track signed agreements, release, installment payments, and outstanding balances.';
    $counts = ['Total Loans' => count($loans), 'Active Loans' => 0, 'Overdue Loans' => 0, 'Completed Loans' => 0];
    $headers = ['#', 'Borrower', 'Loan ID', 'Loan Amount', 'Amount Paid', 'Balance', 'Term', 'Next Due Date', 'Status', 'Action'];
    foreach ($loans as $index => $l) {
        if (in_array($l['display_status'], ['Active', 'Overdue'], true))
            $counts['Active Loans']++;
        if ($l['display_status'] === 'Overdue')
            $counts['Overdue Loans']++;
        if ($l['display_status'] === 'Completed')
            $counts['Completed Loans']++;
        $tableRows[] = ['status' => $l['display_status'], 'type' => 'Installment', 'term' => (string) $l['term_months'], 'cells' => [$index + 1, $l['user_fn'] . ' ' . $l['user_ln'], 'UW-' . $l['agreement_id'], money($l['principal']), money($l['amount_paid']), money($l['balance']), $l['term_months'] . ' months', $l['next_due_date'] ?: '—', $l['display_status']], 'id' => $l['agreement_id'], 'kind' => 'loan', 'button' => 'View loan'];
    }
} else {
    $title = 'Extension Requests';
    $description = 'Review requests to move installment due dates without adding interest or fees.';
    $rows = lender_extensions($lender['user_id']);
    $counts = ['Pending Requests' => 0, 'Approved Requests' => 0, 'Denied Requests' => 0, 'Total Requests' => count($rows)];
    $headers = ['#', 'Borrower', 'Request ID', 'Current Term', 'Requested Term', 'Request Date', 'Status', 'Action'];
    foreach ($rows as $index => $r) {
        $status = ['pending' => 'Pending', 'approved' => 'Approved', 'rejected' => 'Denied'][$r['status']];
        $counts[$status === 'Pending' ? 'Pending Requests' : ($status === 'Approved' ? 'Approved Requests' : 'Denied Requests')]++;
        $tableRows[] = ['status' => $status, 'type' => 'Installment', 'term' => (string) $r['term_months'], 'cells' => [$index + 1, $r['user_fn'] . ' ' . $r['user_ln'], 'EXT-' . $r['request_id'], $r['term_months'] . ' months; due ' . $r['original_due_date'], 'Move due date to ' . $r['requested_due_date'], $r['requested_at'], $status], 'id' => $r['request_id'], 'kind' => 'extension', 'button' => 'View request'];
    }
}
