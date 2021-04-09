<?php

// The insertHeader() function creates a header bar and navigation menu. The function will accept 6 arguments as parameters: PageTitle (string), Navigation menu items (associative array), Path to CSS file (string), Path to JS file (string), Path to the Bootstrap CSS file (string), and Path to the Bootstrap JS file (string). If no arguments are supplied, the function will use its own default values. The function outputs the HTML code for the header.

function insertHeader($pageTitleParam = 'Task Management',
                      $navItemsParam = '',
                      $cssPathParam = '../style/global.css',
                      $jsPathParam = '',
                      $bootstrapCssPathParam = '../css/bootstrap.min.css',
                      $bootstrapJsPathParam = '../js/bootstrap.min.js') {

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
        $navItems = [
                        'Projects Overview' => './projects-overview.php',
                        'Create New Project' => './new-project.php',
                        'Add Category' => './add-category.php',
                        'Task Board' => './task-board.php',
                        'Logout' => './logout.php'
                    ];
    }    

    


    // Create the navigation menu list items HTML code
    foreach ($navItems as $linkName => $Uri) {
        $navListItemsString .= "<li class=\"nav-item\"><a class=\"nav-link\" href=\"$Uri\">$linkName</a></li>";
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



