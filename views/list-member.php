<?php

session_start();

require_once '../Model/ProjectOverview.php';
require_once '../Model/Member.php';
require_once '../Model/SideBar.php';
require_once '../Model/Database.php';
require_once '../Model/UpcomingDueDates.php';
require_once '../Model/Notifications.php';

require("./partials/footer.php");
require("./partials/header.php");
insertHeader();

$id = $_GET['id'];

$dbcon = Database::getDb();
$m = new Member();
$users =  $m->getMemberById($id,$dbcon);
$project_name = $users->project_name;
//$user_id = $users->user_id;
$project_id = $users->project_id;
//$first_name = $users->first_name;
//$last_name = $users->last_name;
//$role_id = $users->role_id;
//$role_description = $users->role_description;


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

    <main role="main" class="col-md-10">
        <div class=" py-5 bg-light">
            <div class="container">
                <div class="p-5 text-center">
                    <h2 class="mb-3">List of Members</h2>
                    <h3 class="mb-3">Please select who will be part of the project
                        : <input type="hidden" value="<?= $project_id; ?>"/><?php echo $project_name ?> </h3>
                </div>
                <table class="table table-hover">
                    <thead class="thead-light ">
                    <tr>
                        <th scope="col">UserID</th>
                        <th scope="col">First Name</th>
                        <th scope="col">Last Name</th>
                        <th scope="col">Role</th>
                    </tr>
                    </thead>
                    <tbody>
                     <?php if ($users) { ?>
                         <?php var_dump($users);?>

                            <?php foreach ($users as $user) { ?>
                                <tr>
                                    <td><?php echo $user['user_id'] ?></td>
                                    <td><?php echo $user['first_name']?></td>
                                    <td><?php echo $user['last_name'] ?></td>
                                    <td><input type="hidden" value="<?= $user['role_id']; ?>"/><?php echo $user['role_description'] ?></td>
                                </tr>
                            <?php } ?>
                     <?php } ?>
                    </tbody>
                </table>


        </div>
        <!--Main End Here-->
    </main>





<?php
insertFooter();
?>