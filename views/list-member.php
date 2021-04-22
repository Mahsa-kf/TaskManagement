<?php
/* Objective: to display who are the member in this project (top) and
  * to display who are remaining that is not on the list and
  * remainders can be added with different role and
 * users able to update the role of the current member of the project
 * pages that connect to this interface: members_table.php, add-member.php, update-member.php,delete-member.php
 * Learning curve:
*/
session_start();

require_once '../Model/ProjectOverview.php';
require_once '../Model/Role.php';
require_once '../Model/Project.php';
require_once '../Model/Member.php';
require_once '../Model/SideBar.php';
require_once '../Model/Database.php';
require_once '../Model/UpcomingDueDates.php';
require_once '../Model/Notifications.php';

require("./partials/footer.php");
require("./partials/header.php");
insertHeader();

/*Gather Data to display all users based on projectID*/
//Obtain project ID from URL query
$id = $_GET['id'];
$dbcon = Database::getDb();

$m = new Member();
$users = $m->getMembersByProjectId($id, $dbcon);

$p = new Project();
$project_details = $p->getProjectById($id, $dbcon);
$remainingMembers = $m->getMembersNotInProject($id, $dbcon);

$r = new Role();
$roles = $r->getAllRoles($dbcon);

$_SESSION['user_id'] = 'James@bond.com'; //code to get rid of error msg temporarily, delete it after work has been shown to Nithya
$upcomingDueDates = UpcomingDueDates::getUpcomingDueDates($_SESSION['userId'], $dbcon);

$notifications = Notifications::deadlineNotifications($_SESSION['userId'], $dbcon);

?>
    <div class="d-xl-flex row" id="overview-wrapper">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
            <?php
            echo $upcomingDueDates;
            echo $notifications;
            ?>
        </nav>
        <!--Main Start Here-->
        <!--Content Start here-->

        <main role="main" class="col-md-10 ">
            <div class=" py-5 bg-light ">
                <div class="container">
                    <div class="p-5 text-center">
                        <h2 class="mb-3 ">Project Name :
                            <input type="hidden" value="<?= $id; ?>"/><?php echo $project_details->name ?> </h2>
                        <div><h2 class="mb-3 pt-3">List of Members</h2></div>
                    </div>
                    <?php showUsersTable($users, $roles, $project_details, './update-member.php', 'Update','submit'); ?>
                    <div class="container ">
                        <div class="pt-3"><h2 class="mb-3 ">Add Members</h2></div>
                        <?php showUsersTable($remainingMembers, $roles, $project_details, './add-member.php', 'Add','button'); ?>
                    </div>
                </div>


                <?php
                function showUsersTable($users, $roles, $project_details, $actionLink, $buttonLabel,$buttonAction)
                {
                    include('partials/members_table.php');
                }

                ?>


                <div class="m-5">
                    <a href="projects-overview.php" class="button btn btn-secondary">Back to List of Projects</a>
                </div>


            </div>
            <!--Main End Here-->
        </main>
    </div>
<?php
insertFooter();
?>