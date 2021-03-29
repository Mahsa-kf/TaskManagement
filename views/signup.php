
<?php

require_once '../Model/Authentication.php';
require_once '../Model/Database.php';

require("./partials/footer.php");
require("./partials/header.php");
insertHeader();
 
session_start();

// If form is submitted
if(isset($_POST['submit'])){
    $count = 0;

    //Validate
    if (!$email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        echo 'Invalid email';
        $count++;
    }
    //password regx
    if (preg_match('/\A(?=.*?[a-z])(?=.*?\d)[a-z\d]{8,100}+\z/i', $_POST['password'])) {
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    
    // If password is no maching with regx    
    } else {
        echo 'password must 8 character or more';
        $count++;
    }
    
    try {
        // Connect to database
        $db = Database::getDb();

        // Create an instatnce of a class
        $s = new Authentication();

        // Call registerUserData
        $user =  $s->registerUserData($_POST['fname'], $_POST['lname'], $_POST['email'], $password , $db);
        
        // Regenerate session
        session_regenerate_id(true); //generate and replace new session_id
        
        // Set email address for session
        $_SESSION['EMAIL'] = $_POST['email'];
        
        // Redirect to projects-overview.php
        header("location: projects-overview.php");
        exit();

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
                    <div class="errorMessage hidden"><?= isset($fnameError)? $fnameError: ''; ?></div>
                    <div class="form-group row mb-3">
                        <label class="col-sm-3 col-form-label" for="fname">First Name</label>
                        <input class="col-sm-9" type="text" name="fname" id="fname" placeholder="Please type your first name">
                    </div>
                    <div class="errorMessage hidden"><?= isset($LnameError)? $LnameError: ''; ?></div>
                    <div class="form-group row mb-3">
                        <label class="col-sm-3 col-form-label" for="lname">Last Name</label>
                        <input class="col-sm-9" type="text" name="lname" id="lname" placeholder="Please type your last name">
                    </div>
                        
                    <div class="errorMessage hidden"><?= isset($emailError)? $emailError: ''; ?></div>
                    <div class="form-group row mb-3">
                        <label class="col-sm-3 col-form-label" for="email">Email</label>
                        <input class="col-sm-9" type="text" name="email" id="email" placeholder="Please type your email address">
                    </div>
            
                    <div class="errorMessage hidden"><?= isset($passwordError)? $passwordError: ''; ?></div>
                    <div class="form-group row mb-3">
                        <label class="col-sm-3 col-form-label" for="password">Password</label>
                        <input class="col-sm-9" type="password" name="password" id="password" placeholder="Please type your password">
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

