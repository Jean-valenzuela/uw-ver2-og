
document.addEventListener("DOMContentLoaded", function () {

    const mobileMenuBtn = document.getElementById("mobileMenuBtn");
    const sidebar = document.getElementById("sidebar");
    const sidebarOverlay = document.getElementById("sidebarOverlay");

    mobileMenuBtn.addEventListener("click", function () {
        sidebar.classList.toggle("open");
        sidebarOverlay.classList.toggle("show");
    });

    sidebarOverlay.addEventListener("click", function () {
        sidebar.classList.remove("open");
        sidebarOverlay.classList.remove("show");
    });


    const methodCards = document.querySelectorAll(".method-card");
    const methodInputs = document.querySelectorAll('input[name="payment_method"]');
    const instructionTabs = document.querySelectorAll(".instruction-tab");

    const gcashInstructions = document.querySelector(".gcash-instructions");
    const cashInstructions = document.querySelector(".cash-instructions");

    const receiptField = document.getElementById("receiptField");
    const cashMessage = document.getElementById("cashMessage");
    const instructionNote = document.getElementById("instructionNote");


    function selectMethod(method) {

        methodCards.forEach(function (card) {
            card.classList.toggle("selected", card.dataset.method === method);
        });

        methodInputs.forEach(function (input) {
            input.checked = input.value === method;
        });

        instructionTabs.forEach(function (tab) {
            tab.classList.toggle("active", tab.dataset.instruction === method);
        });

        gcashInstructions.classList.toggle("active", method === "gcash");
        cashInstructions.classList.toggle("active", method === "cash");

        receiptField.style.display = method === "gcash" ? "block" : "none";
        cashMessage.classList.toggle("show", method === "cash");
        instructionNote.style.display = method === "gcash" ? "flex" : "none";
    }


    methodCards.forEach(function (card) {
        card.addEventListener("click", function () {
            selectMethod(card.dataset.method);
        });
    });


    instructionTabs.forEach(function (tab) {
        tab.addEventListener("click", function () {
            selectMethod(tab.dataset.instruction);
        });
    });


    const receiptInput = document.getElementById("receiptInput");
    const uploadText = document.getElementById("uploadText");

    receiptInput.addEventListener("change", function () {

        if (!receiptInput.files.length) {
            uploadText.textContent = "Click to upload or drag and drop";
            return;
        }

        const file = receiptInput.files[0];

        if (file.size > 5 * 1024 * 1024) {
            alert("Please choose a file smaller than 5MB.");
            receiptInput.value = "";
            uploadText.textContent = "Click to upload or drag and drop";
            return;
        }

        uploadText.textContent = file.name;
    });


    const copyNumber = document.getElementById("copyNumber");

    copyNumber.addEventListener("click", function () {

        const number = document.getElementById("gcashNumber").textContent.trim();

        if (navigator.clipboard) {
            navigator.clipboard.writeText(number);
        }

        copyNumber.innerHTML = '<span class="material-symbols-outlined">check</span>';

        setTimeout(function () {
            copyNumber.innerHTML =
                '<span class="material-symbols-outlined">content_copy</span>';
        }, 1200);
    });


    document.getElementById("paymentForm").addEventListener("submit", function (event) {

        event.preventDefault();

        const selectedMethod =
            document.querySelector('input[name="payment_method"]:checked').value;

        if (selectedMethod === "gcash" && !receiptInput.files.length) {
            alert("Please upload your GCash receipt before submitting.");
            return;
        }

        alert(
            "Payment form is ready. Database submission can be connected once the payment backend is added."
        );
    });


    window.addEventListener("resize", function () {
        if (window.innerWidth > 1150) {
            sidebar.classList.remove("open");
            sidebarOverlay.classList.remove("show");
        }
    });

});
