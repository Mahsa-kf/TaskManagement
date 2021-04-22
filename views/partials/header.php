<?php

require_once '../Model/Authentication.php';
require_once '../Model/Database.php';

// The insertHeader() function creates a header bar and navigation menu. The function will accept 6 arguments as parameters: PageTitle (string), Navigation menu items (associative array), Path to CSS file (string), Path to JS file (string), Path to the Bootstrap CSS file (string), and Path to the Bootstrap JS file (string). If no arguments are supplied, the function will use its own default values. The function outputs the HTML code for the header.

function insertHeader($pageTitleParam = 'Task Management',
                      $navItemsParam = '',
                      $cssPathParam = '../style/global.css',
                      $jsPathParam = '',
                      $bootstrapCssPathParam = '../css/bootstrap.min.css',
                      $bootstrapJsPathParam = '../js/bootstrap.bundle.min.js') {

    $pageTitle = $pageTitleParam;
    $navItems = $navItemsParam;
    $cssPath = $cssPathParam;
    $jsPath = $jsPathParam;
    $bootstrapCssPath = $bootstrapCssPathParam;
    $bootstrapJsPath = $bootstrapJsPathParam;
    $navListItemsString = '';

    if ($navItemsParam === '' && !isset($_SESSION['isLoggedIn'])) {
        $navItems = [
                        'About Us' => './aboutus.php',
                        'FAQ' => './faq.php',
                        'Contact Us' => './contactus.php',
                        'Register' => './signup.php',
                        'Log In' => './login.php'
                    ];
    }

    if ($navItemsParam === '' && isset($_SESSION['isLoggedIn'])) {
        $db = Database::getDb();
    
        // Create an interface of a class
        $s = new Authentication();

        // call and return getUserData
        $user =  $s->getUserData($_SESSION['email'], $db);
        
        $loginUser = $user['first_name'] . " " . $user['last_name'];
        $loginUserEmail = $user['email_address'];
        // $loginUserInitial = substr($user['first_name'], 0, 1) . " " . substr($user['last_name'], 0, 1);

        $navItems = [
                        'Projects Overview' => './projects-overview.php',
                        'Create New Project' => './new-project.php',
                        'Add Category' => './category-add.php'
                    ];
    }    

    


    // Create the navigation menu list items HTML code
    foreach ($navItems as $linkName => $Uri) {
        $navListItemsString .= "<li class=\"nav-item\"><a class=\"nav-link\" href=\"$Uri\">$linkName</a></li>";
    }

    if ($navItemsParam === '' && isset($_SESSION['isLoggedIn'])) {
        $navListItemsString .='<div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">'
            . $loginUser .'</button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
            <div>' . $loginUserEmail . '</div>
            <div><a href="./logout.php">Log out</a></div>
            </div></div>';
  
    }

    
 

    echo <<<HEADER
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width">
        <script type="text/javascript" src="$jsPath"></script>
        <link rel="stylesheet" href="$cssPath" />
        <link rel="stylesheet" href="$bootstrapCssPath" />
        <script type="text/javascript" src="$bootstrapJsPath"></script>
        <title>$pageTitle</title>
    </head>
    <body class="d-flex h-100 text-center">
    <div class="cover-container d-flex w-100 h-100 mx-auto flex-column">
    <header class = "modal-header ">
        <h1>
        <span class="hidden">Task Management</span>
        <a class="nav-link" href="../index.php">
            <img src="../images/logo-C4M.png" height="50px" alt="C4M Logo Image">
        </a></h1>
        <nav class="navbar-expand-lg ">
            <ul class="nav justify-content-end ">
                $navListItemsString
            </ul>
        </nav>
    </header>
    <body>
    HEADER;

}
?>



