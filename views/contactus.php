<?php
require_once '../Model/Contact.php';
require_once '../Model/Database.php';

require("./partials/header.php");
insertHeader();

// Used this associated array for select
$subjects = ['Select' => 'select','About this product' => 'product', 'About customer service' => 'service', 'About Media' => 'media', 'Others' => 'others'];

$count = 0;
$sent = false;
   
    // If form is submitted
    if(isset($_POST['submit'])){
        
        // Set email value
        $email = $_POST['email'];
        
        // Validate name value
        if($_POST['name'] == "" ){

            // Set and return error message
            $nameError =  "Please input your name";
            $count++;
        }

        // Validate email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

            // Set error message
            $emailError =  "Please input your email address";
            $count++;
        }
        
        // Validate select
        if($_POST['subjects'] == "select") {
           
            // Set error message
            $selectError = "Please choose your topic";
            $count++;
        } 

        // Validate message
        if ($_POST['message'] == '') {

            // Set error message
            $messageError = "Please input message";
            $count++;
        }

        // If there is no error, 
        if($count == 0){

            try {
                // Connect to database
                $db = Database::getDb();
    
                // Create an instant of a class
                $c = new Contact();

                // Call addContactInfoPublic 
                $count =  $c->addContactInfoPublic($_POST['name'], $_POST['email'], $_POST['phone'], $_POST['subjects'], $_POST['message'], $db);

                // If data is registered successfully,
                if($count){
                    $msg = "Thank you for your email. We will contact you shortly!";
                    $sent = true;

                // If error occured,
                }else{
                    $msg = "Error occured. Please send email us again.";
                }

            
            } catch (\Exception $e) {
                echo $e;
            }   
        }

    }


?>

<!--Main Start Here-->

<main class="container container-login  my-5">
    <div class="row">
        <h2>We are here for you</h2>
        <p class="lead ">Get quick answers from <a href="faq.php">FAQ</a> or <a href="contactus.php">contact us</a></p> 

        <div class="my-5">

            <h4><b><?= isset($msg) ? $msg : ''; ?></b></h4>
            <form id="loginForm" name="form_login" method="POST" action="">
                <div class="my-3">
                    
                    <div class="form-group">
                    <div class="label"><label class="col-form-label" for="name">Name *</label><span class="errorMsg"><?= isset($nameError) ? $nameError : ''; ?></span></div>
                        <input class="form-control" type="text" name="name" id="name" value="<?php echo $_POST['name']; ?>">
                    </div>
                </div>

                <div class="my-3">
                    
                    <div class="form-group">
                    <div class="label"><label class="col-form-label" for="email">Email *</label><span class="errorMsg"> <?= isset($emailError) ? $emailError : ''; ?></span></div>
                        <input class="form-control" type="email" name="email" id="email" value="<?php echo $_POST['email'] ?>">
                    </div>
                </div>

                <div class="my-3">
                    
                    <div class="form-group">
                        <div class="label"><label class="col-form-label" for="phone">Phone Number - if you wish to talk with us</label> <span class="errorMsg"><?= isset($phoneError) ? $phoneError : ''; ?></span></div>
                        <input class="form-control" type="text" name="phone" id="phone" value="<?php echo $_POST['phone'] ?>">
                    </div>
                </div>

                <div class="my-3">
                    
                    <div class="form-group">
                        <div class="label"><label class="col-form-label" for="subjects">Please select the topic *</label><span class="errorMsg"> <?= isset($selectError) ? $selectError : ''; ?></span></div>
                        <select class="form-control" name= "subjects" id="subject">
                        <?php 
                            foreach ($subjects as $key => $value){
                        ?>
                            <option value="<?= $value ?>"<?= $_POST['subjects'] == $value ? 'selected' : ''; ?>><?php echo $key ?></option>
                        <?php
                            }
                        ?>
                        </select>
                    </div>
                </div>

                <div class="my-3">
                    
                    <div class="form-group">
                        <div class="label"><label class="col-form-label" for="message">Tell us how we can help *</label> <span class="errorMsg"><?= isset($messageError) ? $messageError : ''; ?></span></div>
                        <textarea class="form-control" name="message" id="message" rows="6"><?php echo htmlspecialchars($_POST['message']);?></textarea>
                    </div>
                </div>

                <div class="my-3">
                    <div class="margin_top">
                        <input type="submit" class="btn btn-primary" name="submit" value="Submit" <?php if ($sent){ ?> disabled <?php   } ?> >    
                    </div>
                </div>
            </form>
        </div>
    </div>
</main>




<?php

require("./partials/footer.php");
insertFooter();

?>