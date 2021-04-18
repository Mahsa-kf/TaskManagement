<?php

session_start();

require_once '../Model/ProjectOverview.php';
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
$users =  $m->getMembersByProjectId($id,$dbcon);

$p = new Project();
$project_details = $p->getProjectById($id,$dbcon);


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
                        : <input type="hidden" value="<?= $id; ?>"/><?php echo $project_details->name ?> </h3>
                </div>
                <table class="table table-hover">
                    <thead class="thead-light ">
                    <tr>
                        <th scope="col">UserID</th>
                        <th scope="col">First Name</th>
                        <th scope="col">Last Name</th>
                        <th scope="col"><label for="role">Role</label></th>
                    </tr>
                    </thead>
                    <tbody>
                     <?php if ($users) { ?>

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
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-sm-4 col-md-4">
                            <form action="./list-member.php?id=<?=  $project_details->id; ?>" method="post">
                                <input type="hidden" name="id" value="<?= $project_details->id; ?>"/>
                                <input type="submit" class="button btn btn-primary" name="updateMember" value="Update Member"/>
                            </form>
                        </div>
                        <div class="col-12 col-sm-4 col-md-4">
                            <form action="./projects-overview.php" method="post">
                                <input type="submit" class="button btn btn-info" name="listMember" value="Cancel"/>
                            </form>
                        </div>
                    </div>

                </div>


        </div>
        <!--Main End Here-->
    </main>





<?php
insertFooter();
?>