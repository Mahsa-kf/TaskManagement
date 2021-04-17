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

$name = null;
$roles = null;
$users = null;
$project_details = null;

/*Extract the current data from DB*/
if (isset($_POST['addMember'])) {
    //Get the project ID from url query param
    $id = $_GET['id'];

    $db = Database::getDb();

    $p = new Project();
    $project_details = $p->getProjectById($id, $db);

    $u = new Member();
    $users = $u->getAllUsers(Database::getDb());

    $o = new ProjectOverview();

    $r = new Role();
    $roles = $r->getAllRoles(Database::getDb());

    $name = $project_details->name;


}

//Submit New Changes to DB
if (isset($_POST['addUser'])) {

    $project_id = $_GET['id'];
    $app_user_id = $_POST['app_user_id'];
    $role_id = $_POST['role'];

    $db = Database::getDb();
    /*Add User to Project -> to DB*/
    $u = new Member();
    $project_users = $u->addProjectUsers($app_user_id, $project_id, $role_id, $db);

//    header('Location:  projects-overview.php');
}

if (isset($_POST['deleteUser'])) {


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
                        : <?php echo $name ?> </h3>
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
                    <form id="add_member_form" name="form_add_member" method="POST" action="">
                        <?php if ($users) { ?>
                        <?php foreach ($users as $user) { ?>
                            <tr>
                                <td><input type="hidden" name="app_user_id"
                                           value="<?= $user->id; ?>"/><?php echo $user->id ?></td>
                                <td><?php echo $user->first_name ?></td>
                                <td><?php echo $user->last_name ?></td>
                                <td>
                                    <select class="col-sm-9" name="role" id="role">
                                        <option value='0'>Please select a role</option>
                                        <?php foreach ($roles as $role) { ?>
                                            <option type="hidden" name="role"
                                                    value="<?= $role->id; ?>"><?= $role->description; ?></option>
                                        <?php } ?>
                                    </select>

                                    <span style="color:red;"><?= isset($roles_err) ? $roles_err : ''; ?></span>
                                </td>
                                <!--Create Populate function for role from role table, get the data and insert to bridging table"-->
                                <td class="row align-content-center">
                                    <div class="col-12 col-sm-6 col-md-6">
                                        <form action="./add-member.php?id=<?= $project_details->id; ?>" method="post">
                                            <input type="hidden" name="id" value="<?= $project_details->id ?>"/>
                                            <input type="submit" class="button btn btn-info" name="addUser"
                                                   value="Add"/>
                                        </form>
                                    </div>
                                    <div class="col-12 col-sm-6 col-md-6">
                                        <form action="./delete-project.php?id=<?= $project_details->id; ?>"
                                              method="post">
                                            <input type="hidden" name="id" value="<?= $project_details->id; ?>"/>
                                            <input type="submit" class="button btn btn-danger" name="deleteUser"
                                                   value="Delete"/>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                        <?php } ?>
                    </form>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

<?php
insertFooter();
?>