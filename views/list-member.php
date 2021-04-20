<?php

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


//Submit New Changes to DB
//if (isset($_POST['addMember'])) {
//    //Extract DAta from url query and from members_table.php
//    $id = $_POST['projectId'];
//    $userID = $_POST['userid'];
//    $roleID = ($_POST['roleid']);
//
//    if ($_POST['roleid'] === "0") {
//        $roles_err = "please select role for this member";
//    } else {
//        $roleID = ($_POST['roleid']);
//    }
//
//    if(!empty($userID && $id) && $roleID != '0') {
//        $db = Database::getDb();
//
//        $r = new Role();
//        $roles = $r->getAllRoles($db);
//
//        $m = new Member();
//        $addUsers = $m->addMembersInProjectUser($userID, $id, $roleID, $db);
//        $p = new Project();
//        $project_details = $p->getProjectById($id, $db);
//
//        header('Location:list-member.php?id=' . $_POST['projectId']);
//    }

//}

$_SESSION['user_id'] = 'James@bond.com'; //code to get rid of error msg temporarily, delete it after work has been shown to Nithya
$upcomingDueDates = UpcomingDueDates::getUpcomingDueDates($_SESSION['user_id'], $dbcon);

$notifications = Notifications::deadlineNotifications($_SESSION['user_id'], $dbcon);

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
                        <h3 class="mb-3">Project Name :
                            <input type="hidden" value="<?= $id; ?>"/><?php echo $project_details->name ?> </h3>
                        <h2 class="mb-3">Update Members</h2>
                    </div>
                    <?php showUsersTable($users, $roles, $project_details, './update-member.php', 'Update', 'submit'); ?>
                    <div class="container ">
                        <h2 class="mb-3 ">Add Members</h2>
                        <?php showUsersTable($remainingMembers, $roles, $project_details, './add-member.php', 'Add', 'submit'); ?>
                    </div>
                </div>


                <?php
                function showUsersTable($users, $roles, $project_details, $actionLink, $buttonLabel, $actionButton)
                {
                    include('partials/members_table.php');
                }

                ?>


                <div class="m-5">
                    <a href="projects-overview.php" class="button btn btn-info">Back to List of Projects</a>
                </div>


            </div>
            <!--Main End Here-->
        </main>
    </div>
<?php
insertFooter();
?>