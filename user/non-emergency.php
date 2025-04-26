<?php
include "layout/header.php";
?>

<style>
    body {
        padding-top: 80px;
        padding-bottom: 50px;
    }

    .form-overlay {
        margin: auto;
        background: rgba(255, 255, 255, 0.9);
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.3);
        max-width: 500px;
        width: 90%;
        min-height: 450px;
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
        visibility: hidden;
        height: 20px;
    }
</style>

<div class="content-container">
    <div class="form-overlay">
        <h2>Non-Emergency Form</h2>
        <form id="assistanceForm" action="submit_form.php" method="POST">
    <input type="hidden" name="form_type" value="non-emergency">
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
                <label for="message" class="form-label">Request Details</label>
                <textarea class="form-control" id="message" name="message" rows="2" placeholder="Provide details about your request"></textarea>
                <div class="error-message" id="error-message">This field is required.</div>
            </div>
            <div class="text-center">
                <button type="submit" id="submitButton" class="btn btn-primary w-100">Submit</button>
            </div>
        </form>
    </div>
</div>

<script>
    document.getElementById("assistanceForm").addEventListener("submit", function (event) {
        let isValid = true;
        let fields = ["lastname", "firstname", "contact", "address", "message"];

        fields.forEach(field => {
            let input = document.getElementById(field);
            let error = document.getElementById(`error-${field}`);

            if (input.value.trim() === "") {
                error.style.visibility = "visible";
                isValid = false;
            } else {
                error.style.visibility = "hidden";
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
