<?php
include "./header.php";



if(isset($_SESSION ["email"])) {
    header("location:./index.php");
    exit;
}

$first_name = "";
$last_name = "";
$email = "";
$phone = "";
$address = "";

$first_name_error = "";
$last_name_error = "";
$email_error = "";
$phone_error = "";
$address_error = "";
$password_error = "";
$confirm_password_error = "";

$error =  false;


    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];


    if (empty($first_name)) {
        $first_name_error = "Firstname is required";
        $error = true;
    }

         if (empty($last_name)) {
            $last_name_error = "Lastname is required";
            $error = true;
    }

         if (empty($email)) {
            $email_error = "Email format is not valid";
            $error = true;
    }


    include "./db.php";
    $dbConnection = getDatabaseConnection();

    $statement = $dbConnection->prepare("SELECT id FROM users WHERE email =?");

    $statement->bind_param("s", $email);
    

    $statement->execute();


    $statement->store_result();
    if ($statement->num_rows > 0) {
        $email_error = " Email is already used ";
        $error = true;
    }

 
    $statement->close();



         if (!preg_match("/^(\+|00\d{1,3})?[--]?\d{7,12}$/", $phone)){
            $phone_error = "Phone Format is not valid";
            $error = true;
    }


         if (strlen($password) <6) {
            $password_error = "Password must have at least 6 characters";
            $error = true;
    }


         if ($confirm_password != $password) {
            $confirm_password_error = "Password and Confirm Password do not match";
            $error = true;
    }

    if (!$error) {

        $password = password_hash($password, PASSWORD_DEFAULT);
        $created_at = date('Y-m-d H:i:s');


        $statement = $dbConnection->prepare(
            "INSERT INTO users (first_name, last_name, email, phone, address, password, created_at)" .
            "VALUES (?, ?, ?, ?, ?, ?, ?)"
        );

  
        $statement->bind_param('sssssss',$first_name, $last_name, $email, $phone, $address, $password, $created_at);


        $statement->execute();

        $insert_id = $statement->insert_id;
        $statement->close();


        $_SESSION["id"] = $insert_id;
        $_SESSION["first_name"] = $first_name;
        $_SESSION["last_name"] = $last_name;
        $_SESSION["email"] = $email;
        $_SESSION["phone"] = $phone;
        $_SESSION["address"] = $address;
        $_SESSION["created_at"] = $created_at;

    
        header("location:./home.php");
        exit;

    }
    }
?>

    <div class="container py-5">
        <div class= "row">
            <div class= "col-lg-6 mx-auto border shadow p-4">
                <h2 class="text-center mb-4">Register</h2>
                <hr />


        <form method="post">
            <div class= "row mb-3">
                <label class="col-sm-4 col-form-label">First Name*</label>
                <div class="col-sm-8">
                    <input class= "form-control" name= "first_name" value= "<?php echo $first_name; ?>">
                    <span class="text-danger"><?php echo $first_name_error; ?></span>
                </div>
            </div>

            <div class= "row mb-3">
                <label class="col-sm-4 col-form-label">Last Name*</label>
                <div class="col-sm-8">
                    <input class= "form-control" name= "last_name" value= "<?php echo $last_name; ?>">
                    <span class="text-danger"><?php echo $last_name_error; ?></span>
                </div>
            </div>


            <div class= "row mb-3">
                <label class="col-sm-4 col-form-label">Email*</label>
                <div class="col-sm-8">
                    <input class= "form-control" name= "email" value= "<?php echo $email; ?>">
                    <span class="text-danger"><?php echo $email_error; ?></span>
                </div>
            </div>


            <div class= "row mb-3">
                <label class="col-sm-4 col-form-label">Phone*</label>
                <div class="col-sm-8">
                    <input class= "form-control" name= "phone" value= "<?php echo $phone; ?>">
                    <span class="text-danger"><?php echo $phone_error; ?></span>
                </div>
            </div>
            

            <div class= "row mb-3">
                <label class="col-sm-4 col-form-label">Address*</label>
                <div class="col-sm-8">
                    <input class= "form-control" name= "address" value= "<?php echo $address; ?>">
                    <span class="text-danger"><?php echo $address_error; ?></span>
                </div>
            </div>


            <div class= "row mb-3">
                <label class="col-sm-4 col-form-label">Password*</label>
                <div class="col-sm-8">
                    <input class= "form-control" type= "password" name= "password">
                    <span class="text-danger"><?php echo $password_error; ?></span>
                </div>
            </div>


            <div class= "row mb-3">
                <label class="col-sm-4 col-form-label">Confirm Password*</label>
                <div class="col-sm-8">
                    <input class= "form-control" type= "password" name= "confirm_password">
                    <span class="text-danger"><?php echo $confirm_password_error; ?></span>
                </div>
            </div>
            

            <div class="row mb-3">
                <div class="offset-sm-4 col-sm-4 d-grid">
                    <button type= "submit" class= "btn btn-primary">Register</button>
                </div>
                <div class= "col-sm-4 d-grid">
                    <a href="./index.php" class="btn btn-outline-primary">Cancel</a>
                </div>
            </div>
            
        </form>
            </div>
        </div>
    </div>
<?php
         include "footer.php";
         ?>