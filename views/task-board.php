<?php
session_start();
require_once '../Model/ProjectOverview.php';
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

$dbcon = Database::getDb();
$t = new Task();

if (isset($_SESSION['userId']) && $_SESSION['isLoggedIn']  && isset($_SESSION['projectId'])) {

    //Get project_id from session and put in a variable
    $project_id = $_SESSION['projectId'];
    $project_name = $_SESSION['projectName'];

    //Get all the tasks in this project
    $tasks =  $t->getProjectTasksByFilters($project_id, 0, 0, 0, $dbcon);

    //Get all the users in the project to display in filter drop-down
    $m = new Member();
    $users = $m->getProjectUsersList($project_id, $dbcon);

    //Get all categories in project to display in filter drop-down
    $ca = new Category();
    $categories =  $ca->getCategoriesList($dbcon);

    //Get all states to display in filter drop-down
    $st = new State();
    $states = $st->getStates($dbcon);

    //Get the progress of the current task
    $taskProgressBar = TaskProgress::getTaskProgress($project_id, $dbcon);
} else {
    // Redirect to login if user id does not exist
    header("Location: ./login.php");
    exit();
}

if(isset($_POST['applyFilters'])){
    $assigned_user_id = $_POST['assigned_user_id'];
    $category_id = $_POST['category_id'];
    $state_id = $_POST['state_id'];
    $tasks = $t->getProjectTasksByFilters($project_id, $assigned_user_id, $category_id, $state_id, $dbcon);
}

if(isset($_POST['resetFilters'])){
    $tasks = $t->getProjectTasksByFilters($project_id, 0, 0, 0, $dbcon);
}

?>
<!--Main Start Here-->
<!--Content Start here-->

<main class="text-center">
    <section class="container my-5">
        <h3 class="mb-2 text-left">Task board: <?= $project_name ?></h3>
        <div class="row mb-4">
            <div class="col-md-6 text-left">
                <div class="col-xl-10 p-2 border border-dark rounded">
                    <?= $taskProgressBar ?>
                </div>
            </div>
            <div class="col-md-6 text-right mt-4">
                <a class="btn btn-secondary" href="category-list.php">BACKLOG ITEMS</a>
                <a class="btn btn-success" href="task-add.php">CREATE NEW TASK</a>
            </div>
        </div>
        <form class="mb-3 row task-filters" action="" method="post">
            <div class="row m-1" style="width: calc(100% - 270px)">
                <div class="col-md-4">
                    <select class="form-control" name="assigned_user_id" id="assigned_user_id">
                        <option value="0" select="selected">-- Assigned To --</option>
                        <?php foreach ($users as $user) { ?>
                            <option value="<?= $user['user_id'] ?>"><?php echo $user['name'] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <select class="form-control" name="category_id" id="category_id">
                        <option value="0" select="selected">-- Backlog Item --</option>
                        <?php foreach ($categories as $category) { ?>
                            <option value="<?= $category['id'] ?>"><?php echo $category['title'] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <select class="form-control" name="state_id" id="state_id">
                        <option value="0" select="selected">-- State --</option>
                        <?php foreach ($states as $state) { ?>
                            <option value="<?= $state['ID'] ?>"><?php echo $state['description'] ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="row text-right p-2" style="width:270px;">
                <button type="submit" name="resetFilters" class="btn btn-outline-secondary m-1" style="width: 115px;  float: right">Reset Filters</button>
                <button type="submit" name="applyFilters" class="btn btn-outline-success m-1" style="width: 115px;  float: right">Apply Filters</button>
            </div>
        </form>
        <div class="table-responsive">
            <table class="table table-hover" data-toggle="table" data-search="true" data-filter-control="true" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
                <thead class="table-dark">
                    <tr>
                        <th scope="col" data-field="id">ID</th>
                        <th scope="col" data-field="title" data-filter-control="input" data-sortable="true">TITLE</th>
                        <th scope="col" data-field="project" data-filter-control="select" data-sortable="true">BACKLOG ITEM</th>
                        <th scope="col" data-field="status" data-filter-control="select" data-sortable="true">STATE</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($tasks as $task) { ?>
                        <tr>
                            <th><?= $task->id; ?></th>
                            <td><?= $task->title; ?></td>
                            <td><?= $task->category; ?></td>
                            <td><?= $task->state; ?></td>
                            <td class="text-right">
                                <form action="./task-update.php" method="post">
                                    <input type="hidden" name="id" value="<?= $task->id; ?>" />
                                    <input type="submit" class="button btn text-white bg-primary bg-gradient" name="getTaskDetails" value="Details" />
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