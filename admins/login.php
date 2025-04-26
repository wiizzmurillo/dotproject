<?php
session_start();
include "header.php";
include "db.php";


$siteKey = "6LebvRUrAAAAALbLTM0ZK5wkWh85L68b5m2Nb5o9"; 
$secretKey = "6LebvRUrAAAAAIBESzMLlv9Ph5bbK35wQ2gIFTBj"; 

if (isset($_SESSION["email"])) {
    header("location: ./index.php");
    exit;
}

$email = "";
$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

 
    if (empty($_POST['g-recaptcha-response'])) {
        $error = "Please verify that you are not a robot.";
    } else {
        $captcha = $_POST['g-recaptcha-response'];
        $verify = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$captcha");
        $captchaSuccess = json_decode($verify);

        if (!$captchaSuccess->success) {
            $error = "CAPTCHA verification failed.";
        }
    }
    

    if (empty($error)) {
        if (empty($email) || empty($password)) {
            $error = "Email and Password are required";
        } else {
            $dbConnection = getDatabaseConnection();

            $stmt = $dbConnection->prepare("SELECT id, first_name, last_name, phone, address, password, created_at FROM users WHERE email = ?");
            $stmt->bind_param('s', $email);
            $stmt->execute();
            $stmt->bind_result($id, $first_name, $last_name, $phone, $address, $stored_password, $created_at);

            if ($stmt->fetch()) {
                if (password_verify($password, $stored_password)) {
                    $_SESSION["id"] = $id;
                    $_SESSION["first_name"] = $first_name;
                    $_SESSION["last_name"] = $last_name;
                    $_SESSION["email"] = $email;
                    $_SESSION["phone"] = $phone;
                    $_SESSION["address"] = $address;
                    $_SESSION["created_at"] = $created_at;
                    session_regenerate_id(true);

                    header("location: ./home.php");
                    exit;
                }
            }

            $stmt->close();
            $error = "Invalid email or password";
        }
    }
}
?>

<div class="container py-5">
    <div class="mx-auto border shadow p-4" style="width: 400px">
        <h2 class="text-center mb-4">Login</h2>

        <?php if (!empty($error)) { ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong><?= $error ?></strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php } ?>

        <form method="post">
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input class="form-control" name="email" value="<?= htmlspecialchars($email); ?>" />
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input class="form-control" type="password" name="password" />
            </div>

        
            <div class="mb-3">
                <div class="g-recaptcha" data-sitekey="<?= $siteKey ?>"></div>
            </div>
       
            <button type="submit" class="btn btn-primary w-100">Log In</button>
        </form>
    </div>
</div>


<script src="https://www.google.com/recaptcha/api.js" async defer></script>

<?php include "./footer.php"; ?>
