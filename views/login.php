<?php

// Start or resume a session
session_start();

require_once '../Model/Authentication.php';
require_once '../Model/Database.php';

require("./partials/header.php");
require("./partials/footer.php");
insertHeader();

// When form is submitted
 if(isset($_POST['submit'])){

    $count = 0;
     
    // Validataion 
    if (!filter_var($_POST['userName'], FILTER_VALIDATE_EMAIL)) {
       
        // Set error message
        $userNameError =  "Please input valid user name";
        $count++;
    }
    
    // Connect to database
    $db = Database::getDb();
    
    // Create an interface of a class
    $s = new Authentication();

    // call and return getUserData
    $user =  $s->getUserData($_POST['userName'], $db);
    
    //Check if email address is existing in DB
    if (!isset($user['email_address'])) {

        // Set error message
        $userNameError =  "Please input valid user name";
        $count++;
    }
    
    //Pass email address after check password
    if ($count == 0 && password_verify($_POST['password'], $user['password'])) {
    
        //generate and replace new session_id
        session_regenerate_id(true); 
        $_SESSION['EMAIL'] = $user['email_address'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['userId'] = $user['id'];

        //Set isLoggedIn indicator for dynamic content and authentication on other pages
        $_SESSION['isLoggedIn'] = true; 
        
        // Redirect to projects-overview.php
        header("location: projects-overview.php");
        exit();
    
    } else {
        
        $passwordError = 'Wrong email address or password';
    
    }
}
 
?>

<div class="container container-login text-center my-5">
    <div class="row justify-content-sm-center">
        <h2>Log in</h2>

        <div class="my-5">

            <form id="loginForm" name="form_login" method="POST" action="">
           
                <div class="errorMessage"><span class="errorMsg"><?= isset($userNameError) ? $userNameError : ''; ?></span></div>
                <div class="form-group row mb-3">
                    <label class="col-sm-3 col-form-label" for="userName">User Name</label>
                    <!-- value="<?php echo $_POST['userName']; ?>" -->
                    <input class="col-sm-9" type="text" name="userName" id="userName">
                </div>

                <div class="errorMessage"><span class="errorMsg"><?= isset($passwordError) ? $passwordError : ''; ?></span></div>
                <div class="form-group row mb-3">
                    <label class="col-sm-3 col-form-label" for="password">Password</label>
                    <!-- value="<?php echo $_POST['password']; ?>" -->
                    <input class="col-sm-9" type="password" name="password" id="password">
                </div>


                <div class="form-group my-5">
                    <div>
                        <input type="submit" name ="submit" class="btn btn-primary btn-lg" value="Log in">
                    </div>
                </div>

                <h3 class="side-border">Do not have an account?</h3>
                <div>
                    <a class="btn btn-primary btn-lg my-5" href="signup.php" role="button">Sign up</a>
                </div>

            </form>
        </div>
    </div>
</div>

<?php insertFooter(); ?>