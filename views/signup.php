<?php

require_once '../Model/Authentication.php';
require_once '../Model/Database.php';

require("./partials/footer.php");
require("./partials/header.php");
insertHeader();


// If form is submitted
if(isset($_POST['submit'])){

    $count = 0;

    // Connect to database
    $db = Database::getDb();

    // Create an instance of a class
    $s = new Authentication();

    $user = $s->getUserData($_POST['email'], $db);


    //Validate first name
    if ($_POST['fname'] == "") {
        $fnameError =  "Please input valid first name";
        $count++;
    }

    //Validate last name
    if ($_POST['lname'] == "") {
        $lnameError =  "Please input valid last name";
        $count++;
    }

    //Email validation
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $emailError =  "Please input valid email address";
        $count++;
    }

    //Check if email address is existing in DB
    if (isset($user['email_address'])) {

        // Set error message
        $emailError =  "This email address has already registered.";
        $count++;

    //Password check
    }else{

        //password regx
        if (preg_match('/\A(?=.*?[a-z])(?=.*?[A-Z])(?=.*?\d)[a-zA-Z\d]{8,20}+\z/', $_POST['password'])) {
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        // If password is no maching with regx
        } else {
            $passwordError = 'Password must 8 to 20 characters, at least one uppercase letter, one lowercase letter and one number';
            $count++;
        }

    }

    try {
        

        //All validation pass and no issue,
        if ($count == 0 ) {


            // Call registerUserData
            $insert = $s->registerUserData($_POST['fname'], $_POST['lname'], $_POST['email'], $password , $db);

            if($insert){
                //Session start
                session_start();
                
                //Get user data for session
                $user = $s->getUserData($_POST['email'], $db);

                // Set session 
                $_SESSION['email'] = $user['email_address'];

                // Set session 
                $_SESSION['userId'] = $user['id'];

                //Set isLoggedIn indicator for dynamic content and authentication on other pages
                $_SESSION['isLoggedIn'] = true; 

                //Redirect to projects-overview.php
                header("location: projects-overview.php");
                exit();
            }
        }

    } catch (\Exception $e) {
        echo $e;
    }
}

?>

<div class="container container-login text-center my-5">
    <div class="row justify-content-md-center">
        <h2>Sign up</h2>

        <div class="my-5">

            <form id="signupForm" name="form_signup" method="POST" action="">
                <div class="col-sm-9 offset-sm-3 errorMessage errorMsg text-left"><spam><?= isset($fnameError)? $fnameError: ''; ?></div>
                <div class="form-group row mb-3">
                    <label class="col-sm-3 col-form-label" for="fname">First Name</label>
                    <input class="col-sm-9" type="text" name="fname" id="fname" value="<?php echo $_POST['fname']; ?>">
                </div>
                <div class="col-sm-9 offset-sm-3 errorMessage errorMsg text-left"><spam><?= isset($lnameError)? $lnameError: ''; ?></div>
                <div class="form-group row mb-3">
                    <label class="col-sm-3 col-form-label" for="lname">Last Name</label>
                    <input class="col-sm-9" type="text" name="lname" id="lname" value="<?php echo $_POST['lname']; ?>">
                </div>

                <div class="col-sm-9 offset-sm-3 errorMessage errorMsg text-left"><spam><?= isset($emailError)? $emailError: ''; ?></div>
                <div class="form-group row mb-3">
                    <label class="col-sm-3 col-form-label" for="email">Email</label>
                    <input class="col-sm-9" type="text" name="email" id="email" value="<?php echo $_POST['email']; ?>">
                </div>

                <div class="col-sm-9 offset-sm-3 errorMessage errorMsg text-left"><spam><?= isset($passwordError)? $passwordError: ''; ?></div>                
                <div class="form-group row mb-3">
                    <label class="col-sm-3 col-form-label" for="password">Password</label>
                    <input class="col-sm-9" type="password" name="password" id="password" value="<?php echo $_POST['password']; ?>">
                </div>


                <div class="form-group my-5">
                    <div>
                        <input type="submit" name ="submit" class="btn btn-primary btn-lg" value="Sign up" >
                    </div>
                </div>

                <h3 class="side-border">OR You have an account?</h3>
                <div>
                    <a class="btn btn-primary btn-lg my-5" href="./login.php" role="button"> Log in</a>
                </div>

            </form>
        </div>
    </div>
</div>

<?php insertFooter(); ?>

