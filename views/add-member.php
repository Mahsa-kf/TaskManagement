<?php
// Start or resume a session
session_start();
require_once '../Model/Project.php';
require_once '../Model/Role.php';
require_once '../Model/Member.php';
require_once './user-function.php';
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
//Carry project ID from project-overview to this page
$phpVariable = $_REQUEST['id'];


echo "project: $phpVariable";

//Submit New Changes to DB
if (isset($_POST['addMember'])) {

    $project_id = $_REQUEST['id'];
    $role_id = $_POST['role_id'];
    $app_user_id = $_POST['app_user_id'];
    $db = Database::getDb();
    $u = new Member();
    $o = new ProjectOverview();
    $p = new Project();
    $r = new Role();

    $users = $u->getAllUsers(Database::getDb());
    $project_details = $p->getProjectById($project_id, Database::getDb());
    $roles = $r->getAllRoles(Database::getDb());
    /*Add User to Project -> to DB*/
    $project_users = $p->addProjectUsers($app_user_id, $project_id, $role_id, $db);

//    header('Location:  projects-overview.php');
}
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

        <main role="main" class="col-md-10">
            <div class=" py-5 bg-light">
                <div class="container">
                    <div class="p-5 text-center">
                        <h2 class="mb-3">List of Members</h2>
                        <h3 class="mb-3">Please select who will be part of the project
                            : <?php echo $project_details->name ?> </h3>
                    </div>
                    <table class="table table-hover">
                        <thead class="thead-light ">
                        <tr>
                            <th scope="col">UserID</th>
                            <th scope="col">First Name</th>
                            <th scope="col">Last Name</th>
                            <th scope="col"><label class="col-sm-3 col-form-label" for="role">Role</label></th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($users as $user) { ?>
                            <tr>
                                <td><input type="hidden" name="app_user_id"
                                           value="<?= $user->id; ?>"/><?php echo $user->id ?></td>
                                <td><?php echo $user->first_name ?></td>
                                <td><?php echo $user->last_name ?></td>
                                <td>
                                    <select class="col-sm-9" name="role_id" id="role_id">
                                        <option value='0'>Please select a role</option>
                                        <?php foreach ($roles as $role) { ?>
                                            <option value="<?= $role->id; ?>"><?= $role->description; ?></option>
                                        <?php } ?>
                                    </select>

                                    <span style="color:red;"><?= isset($roles_err) ? $roles_err : ''; ?></span>
                                </td>
                                <!--Create Populate function for role from role table, get the data and insert to bridging table"-->
                                <td class="row align-content-center">
                                    <div class="col-12 col-sm-6 col-md-6">
                                        <form action="./add-member.php" method="post">
                                            <input type="hidden" name="id" value="<?= $projects->id ?>"/>
                                            <input type="submit" class="button btn btn-info" name="addMember"
                                                   value="Add"/>
                                        </form>
                                    </div>
                                    <div class="col-12 col-sm-6 col-md-6">
                                        <form action="./delete-project.php" method="post">
                                            <input type="hidden" name="id" value="<?= $projects->id; ?>"/>
                                            <input type="submit" class="button btn btn-danger" name="deleteProject"
                                                   value="Delete"/>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
<?php
insertFooter();
?>