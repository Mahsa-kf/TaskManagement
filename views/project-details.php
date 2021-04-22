<?php
/*Page Title : Project Overview
 *Objectives: To view a list of projects that user created,able to update or delete the project from the list.
 * User able to access to list of member from this page by clicking 'Member' button.
*/

// Start or resume a session
session_start();


require_once '../Model/ProjectOverview.php';
require_once '../Model/Project.php';
require_once '../Model/SideBar.php';
require_once '../Model/Database.php';
require_once '../Model/UpcomingDueDates.php';
require_once '../Model/Notifications.php';

require("./partials/footer.php");
require("./partials/header.php");
insertHeader();

//session_start();

$dbcon = Database::getDb();

//To obtain all of the projects for the logged in user.
$p = new ProjectOverview();
$projects = $p->getAllProjects(Database::getDb());
$id = $_GET['id'];


//Declare variables for empty string, error message
$name = "";
$project_timestamp = "";
$description = "";

/*Extract the current data from DB before applying any changes*/
if (isset($_POST['detailsProject'])) {
    $project_id = $_GET['id'];

    $db = Database::getDb();

    $p = new Project();
    $project = $p->getProjectById($project_id, $db);

    $name = $project->name;
    $project_timestamp = $project->project_timestamp;
    $description = $project->description;

}

$upcomingDueDates = UpcomingDueDates::getUpcomingDueDates($_SESSION['userId'], $dbcon);

$notifications = Notifications::deadlineNotifications($_SESSION['userId'], $dbcon);

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
    <main role="main" class="col-md-10 min-vh-100">
        <div class=" py-5 bg-light">
            <div class="container-fluid">
                <div class="">
                    <h2 class="mb-3">Project Name : <?= $name; ?></h2>
                </div>
                    <div class="mb-5">Project Start Date : <?= $project_timestamp; ?></div>
                <div class="mb-lg-5">
                    <h3>Project Description : </h3>
                    <div><?= $description; ?></div>
                </div>
                <div class="container pt-lg-5 pb-5">
                    <div class="row ">
                        <div class="col-sm-3 col-lg-3">
                            <form action="./update-project.php?id=<?= $id; ?>"
                                  method="post">
                                <input type="hidden" name="id"
                                       value="<?= $id; ?>"/>
                                <input type="submit" class="button btn btn-primary btn-md btn-responsive"
                                       name="updateProject" value="Update"/>
                            </form>
                        </div>
                        <div class="col-sm-3 col-lg-3">
                            <form action="list-member.php?id=<?= $id; ?>"
                                  method="post">
                                <input type="hidden" name="id"
                                       value="<?= $id; ?>"/>
                                <input type="submit" class="button btn btn-info btn-md btn-responsive"
                                       name="member" value="Member"/>
                            </form>
                        </div>
                        <div class="col-sm-3 col-lg-3">
                            <form action="task-board.php?id=<?= $id; ?>"
                                  method="post">
                                <input type="hidden" name="id"
                                       value="<?= $id; ?>"/>
                                <input type="submit" class="button btn btn-dark btn-md btn-responsive"
                                       name="tasks" value="Tasks"/>
                            </form>
                        </div>
                        <div class="col-sm-3 col-lg-3">
                            <form action="./delete-project.php?id=<?= $id; ?>"
                                  method="post">
                                <input type="hidden" name="id"
                                       value="<?= $id; ?>"/>
                                <input type="submit" class="button btn btn-danger btn-md btn-responsive"
                                       name="deleteProject" value="Delete"/>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
<?php
insertFooter();
?>
