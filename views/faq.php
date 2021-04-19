<?php
// require_once '../Model/FAQ.php';
// require_once '../Model/Database.php';

require("./partials/header.php");
insertHeader();

?>

<!--Main Start Here-->
<div class="jumbotron">

    <img src="../images/faq.jpg" alt="faq" width="600" height="350">
    
    <div class="col-md-12">
        <form id="searchForm" action="searchResults.php" method="GET">
            
            <input class="w-50 py-2" id="search" type="text" name="search" placeholder="Search">
            <input class="py-2" name="searchSubmit" type="submit" value="Search">
            
        </form>
    </div>
    
</div>
<main class="container my-5">

    <div class="row">
       
        <!-- <div class="my-5"> -->
        <form id="searchForm2" action="searchResults.php" method="GET">
        <div class="container">
            <div class="row">
                <div class="col-md-6 my-2">
                    <input type="submit" class="btn btn-primary submitBtn py-2 py-4" name="faq" value="Getting Started" />
                </div>
                <div class="col-md-6 my-2">
                    <input type="submit" class="btn btn-primary submitBtn py-2 py-4" name="faq" value="Dashboard" />
                </div>
                <div class="col-md-6 my-2">
                    <input type="submit" class="btn btn-primary submitBtn py-2 py-4" name="faq" value="Troubleshooting" />
                </div>
                <div class="col-md-6 my-2">
                    <a href="contactus.php" class="btn btn-primary submitBtn py-2 py-4">Contact Us</a>
                </div>
                   
            </div>
        </div>
        </form>
       
    </div>
</main>


<?php

require("./partials/footer.php");
insertFooter();

?>