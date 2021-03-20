<?php


// Start or resume a session
session_start();

require_once '../Model/ProjectOverview.php';
require_once '../Model/SideBar.php';
require_once '../Model/Database.php';
require_once '../Model/UpcomingDueDates.php';
require_once '../Model/Notifications.php';

require("./partials/footer.php");
require("./partials/header.php");
insertHeader();
 
//session_start();

$dbcon = Database::getDb();
$p = new ProjectOverview();
$projects =  $p->getAllProjects(Database::getDb());

$Nav = new SideBar(['About Us','Work', 'Contact Us']);

$_SESSION['user_id'] = 'James@bond.com'; //code to get rid of error msg temporarily, delete it after work has been shown to Nithya
$upcomingDueDates = UpcomingDueDates::getUpcomingDueDates($_SESSION['user_id'], $dbcon);

$notifications = Notifications::deadlineNotifications($_SESSION['user_id'], $dbcon);

?>

<div class="d-xl-flex row" id="overview-wrapper">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
<!--             <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
              <span>Due Dates</span>
            </h6> -->
            
                <?php
                    //echo $Nav->display_SideNav();
                    echo $upcomingDueDates;
                    echo $notifications;
                ?>

        </nav>
        
<main role="main" class="overviewpage col-md-10">  
    <div class=" py-5 bg-light">
        <div class="container">
            <div class="p-5 text-center">
                <h2 class="mb-3">Projects Overview</h2>
            </div>
            <div class="row">
            <?php foreach ($projects as $project) { ?>
                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm">
                        <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><?= $project->id; ?></h5>
                            <h6 class="card-subtitle mb-2 text-muted"><?= $project->name; ?></h6>
                            <p class="card-text"><?= $project->description; ?>.</p>
                            <a href="#" class="card-link">Edit</a>
                            <a href="#" class="card-link">Delete</a>
                        </div>
                        </div>
                    </div>
                </div>
        <?php } ?>
        
                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm">
                        <div class="card">
                        <div class="card-body">
                            <button type="button" class="btn btn-default btn-lg">
                                <span aria-hidden="true"><i class="bi bi-plus" style="font-size: 4.2rem; color: cornflowerblue;"></i></span> 
                            </button>
                        </div>
                        </div>
                    </div>
                </div>
                
            </div>
            </div>
        </div>
    </div>
</main>
<?php
insertFooter();
?>