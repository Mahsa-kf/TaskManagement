<?php
/*Page Title : Create New Project
 *Objectives: To create a new project with information including, project name, start date and description..
*/
// Start or resume a session
session_start();

require("./partials/header.php");
//require("./partials/sidebar.php");
insertHeader();
//insertSidebar();
//session_start();
//require_once './newprojectCheck.php';
require_once '../Model/Project.php';
require_once '../Model/Database.php';
require_once '../Model/SideBar.php';
require_once '../Model/UpcomingDueDates.php';
require_once '../Model/Notifications.php';

$dbcon = Database::getDb();
$upcomingDueDates = UpcomingDueDates::getUpcomingDueDates($_SESSION['userId'], $dbcon);
$notifications = Notifications::deadlineNotifications($_SESSION['userId'], $dbcon);

$name = $project_timestamp = $description = "";

if (isset($_POST['addProject'])) {
    $flag = true;

    if (empty($_POST['project_name'])) {
        $projectNameErr = "Please input your project name";
        $flag = false;
    } else {
        $name = $_POST['project_name'];
    }
    if (empty($_POST['project_timestamp'])) {
        $projectTimestampErr = "Please select the start date";
        $flag = false;
    } else {
        $project_timestamp = $_POST['project_timestamp'];
    }
    if (empty($_POST['project_description'])) {
        $projectDescErr = "Please input your project description";
        $flag = false;
    } else {
        $description = $_POST['project_description'];
    }
    if ($flag) {
        $db = Database::getDb();
        $p = new Project();
        $projects = $p->addProject($name, $project_timestamp, $description, $db);

        header('Location: projects-overview.php');
    }
}


?>
    <!--Main Start Here-->
    <!--Content Start here-->
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
    <main  role="main" class="col-md-10">
        <div class="container text-center my-5">
            <div class="row justify-content-md-center">
                <h2 class="mb-3">Create New Project</h2>
                <div>
                    <form id="add_project_form" name="form_add_project" method="POST" action="">

                        <div class="form-group row mb-3">
                            <label class="col-sm-3 col-form-label" for="project_name">Project Name</label>
                            <input class="col-sm-9" type="text" name="project_name" id="project_name"
                                   placeholder="Please type your project name">
                            <span style="color:red;"><?= isset($projectNameErr) ? $projectNameErr : ''; ?></span>
                        </div>


                        <div class="form-group row mb-3">
                            <label class="col-sm-3 col-form-label" for="project_timestamp">Start Date</label>
                            <input class="col-sm-9" type="datetime-local" name="project_timestamp"
                                   id="project_timestamp" placeholder="Please select the project's start date">
                            <span style="color:red;"><?= isset($projectTimestampErr) ? $projectTimestampErr : ''; ?></span>
                        </div>

                        <div class="form-group row mb-3">
                            <div class="label"><label class="col-form-label" for="project_description">Project
                                    Description</label>
                                <textarea class="form-control" name="project_description" id="project_description"
                                          rows="6" placeholder="Please provide the details of the project"></textarea>
                                <span style="color:red;"><?= isset($projectDescErr) ? $projectDescErr : ''; ?></span>
                            </div>


                            <!--div class="form-group row mb-3">
                                <label class="col-sm-3 col-form-label" for="member">Member(s)</label>
                                <input class="col-sm-9" type="" name="member[]" id="member[]" placeholder="Please Select your member">
                                <span style="color:red;"><?= isset($members_err) ? $members_err : ''; ?></span>
                            </div-->

                            <div class="form-group my-5 text-center">
                                <div>
                                    <input type="submit" name="addProject" class="btn btn-primary btn-lg"
                                           value="Create">
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </main>
<?php

require("./partials/footer.php");
insertFooter();

?>