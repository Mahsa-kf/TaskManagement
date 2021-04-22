<?php
session_start();
require_once '../Model/ProjectOverview.php';
require_once '../Model/Project.php';
require_once '../Model/SideBar.php';
require_once '../Model/Database.php';
require_once '../Model/UpcomingDueDates.php';
require_once '../Model/Notifications.php';
require_once '../Model/Task.php';
require_once '../Model/Member.php';
require_once '../Model/Category.php';
require_once '../Model/State.php';
require_once '../Model/TaskProgress.php';

require("./partials/header.php");
insertHeader();
//insertSidebar();

$dbcon = Database::getDb();

//Get project_id from session and put in a variable
//$project_id = $_SESSION['project_id'];
$project_id = $_GET['id'];

$p = new Project();
$project = $p->getProjectById($project_id, $dbcon);

//Get all the tasks in this project
$t = new Task();
$tasks =  $t->getProjectTasks($project_id, $dbcon);

//Get all the users in the project to display in filter drop-down
$m = new Member();
$users = $m->getProjectUsersList($project_id, $dbcon);

//Get all categories in project to display in filter drop-down
$ca = new Category();
$categories =  $ca->getAllCategories($dbcon);

//Get all the users in the project to display in filter drop-down
$st = new State();
$states = $st->getStates($dbcon);

//Get the progress of the current task
$taskProgressBar = TaskProgress::getTaskProgress($project_id, $dbcon);


?>
<!--Main Start Here-->
<!--Content Start here-->

<main class="text-center">
    <section class="container my-5">
        <!--name of the project-->
        <div class="container d-flex justify-content-between p-0 mb-5">
            <div>
                <h2 ><?= $project->name; ?></h2>
            </div>
            <div class="col-md-4 m-0 p-2 border border-dark rounded">
                <?= $taskProgressBar ?>
            </div>
        </div>
        <form class="row my-md-4 task-filters">

            <div class="col-md-3">
                <select class="form-control">
                    <option value="0" select="selected">-- Assigned To --</option>
                    <?php foreach ($users as $user) { ?>
                        <option value="<?= $user['user_id'] ?>"><?php echo $user['name'] ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-md-3">
                <select class="form-control">
                    <option value="0" select="selected">-- Category --</option>
                    <?php foreach ($categories as $category) { ?>
                        <option value="<?= $category['id'] ?>"><?php echo $category['title'] ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-md-3">
                <select class="form-control">
                    <option value="0" select="selected">-- State --</option>
                    <?php foreach ($states as $state) { ?>
                        <option value="<?= $state['ID'] ?>"><?php echo $state['description'] ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-md-3">
                <select class="form-control ">
                    <option value="0" select="selected">-- Sort By --</option>
                </select>
            </div>
        </form>
        <div class="table-responsive">
            <table class="table table-hover" data-toggle="table" data-search="true" data-filter-control="true" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
                <thead class="table-dark">
                    <tr>
                        <th scope="col" data-field="id">ID</th>
                        <th scope="col" data-field="title" data-filter-control="input" data-sortable="true">TITLE</th>
                        <th scope="col" data-field="project" data-filter-control="select" data-sortable="true">TASK GROUP</th>
                        <th scope="col" data-field="status" data-filter-control="select" data-sortable="true">STATE</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($tasks as $task) { ?>
                        <tr>
                            <th><?= $task->id; ?></th>
                            <td><?= $task->title; ?></td>
                            <td><?= $task->category_id; ?></td>
                            <td><?= $task->state_id; ?></td>
                            <td>
                                <form action="./task-update.php" method="post">
                                    <input type="hidden" name="id" value="<?= $task->id; ?>" />
                                    <input type="submit" class="button btn btn-primary" name="updateTask" value="Details" />
                                </form>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </section>
</main>


<?php

require("./partials/footer.php");
insertFooter();

?>