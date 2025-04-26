<?php
include "layout/header.php";
session_start();
?>

<style>
    body {
        padding-top: 80px;
        padding-bottom: 50px;
    }

    .form-overlay {
        margin: auto;
        background: rgba(255, 255, 255, 0.95);
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        max-width: 500px;
        width: 90%;
        min-height: 550px;
    }

    .content-container {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        padding: 20px;
    }

    .error-message {
        color: red;
        font-size: 14px;
        margin-top: 5px;
        display: none;
    }

    button:disabled {
        background-color: gray !important;
        cursor: not-allowed;
    }
</style>

<div class="content-container">
    <div class="form-overlay">
        <h2 class="text-center">Emergency Form</h2>
        <form id="emergencyForm" action="submit_form.php" method="POST">
            <input type="hidden" name="form_type" value="emergency">

            <div class="row">
                <div class="col-md-6">
                    <label for="lastname" class="form-label">Last Name</label>
                    <input type="text" class="form-control" id="lastname" name="lastname">
                    <div class="error-message" id="error-lastname">This field is required.</div>
                </div>
                <div class="col-md-6">
                    <label for="firstname" class="form-label">First Name</label>
                    <input type="text" class="form-control" id="firstname" name="firstname">
                    <div class="error-message" id="error-firstname">This field is required.</div>
                </div>
            </div>

            <div class="mb-3">
                <label for="contact" class="form-label">Contact Number</label>
                <input type="tel" class="form-control" id="contact" name="contact">
                <div class="error-message" id="error-contact">This field is required.</div>
            </div>

            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <textarea class="form-control" id="address" name="address" rows="1"></textarea>
                <div class="error-message" id="error-address">This field is required.</div>
            </div>

            <div class="mb-3">
                <label for="report" class="form-label">Type of Emergency</label>
                <select class="form-select" id="report" name="report">
                    <option value="" selected disabled>Select Emergency Type</option>
                    <option value="medical">Medical</option>
                    <option value="fire">Fire</option>
                    <option value="flood">Flood</option>
                    <option value="car-accident">Car/Motorcycle Accident</option>
                    <option value="criminal">Criminal</option>
                    <option value="missing-person">Lost or Missing Person</option>
                </select>
                <div class="error-message" id="error-report">This field is required.</div>
            </div>

            <div class="mb-3">
                <label for="message" class="form-label">Message</label>
                <textarea class="form-control" id="message" name="message" rows="2" placeholder="Provide details"></textarea>
                <div class="error-message" id="error-message">This field is required.</div>
            </div>

            <div class="text-center">
                <button type="submit" id="submitButton" class="btn btn-primary w-100">Submit</button>
            </div>
        </form>
    </div>
</div>

<script>
    document.getElementById("emergencyForm").addEventListener("submit", function (event) {
        let isValid = true;
        let fields = ["lastname", "firstname", "contact", "address", "report", "message"];

        fields.forEach(field => {
            let input = document.getElementById(field);
            let error = document.getElementById(`error-${field}`);

            if (input.value.trim() === "" || (field === "report" && input.value === "")) {
                error.style.display = "block";
                isValid = false;
            } else {
                error.style.display = "none";
            }
        });

        if (!isValid) {
            event.preventDefault();
        } else {
            document.getElementById("submitButton").disabled = true;
        }
    });
</script>

<?php
include "layout/footer.php";
?>
