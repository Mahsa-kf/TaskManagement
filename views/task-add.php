<?php
require_once '../Model/Task.php';
require_once '../Model/Member.php';
require_once '../Model/Category.php';
require_once '../Model/State.php';
require_once '../Model/Priority.php';

session_start();

require("./partials/header.php");
insertHeader();


$project_id = $_SESSION['projectId'];;
$user_id = $_SESSION['userId'];

$dbcon = Database::getDb();
$t = new Task();

//Get all the users in the project to display in the drop-down
$m = new Member();
$users = $m->getProjectUsersList($project_id, $dbcon);

//Get all categories in project to display in the drop-down
$ca = new Category();
$categories =  $ca->getCategoriesList($dbcon);

//Get all the states to display in the drop-down
$st = new State();
$states = $st->getStates($dbcon);

//Get all the priorities to display in the drop-down
$pr = new Priority();
$priorities = $pr->getPriorities($dbcon);

$category_id = 0;
$priority_id = 3;
$state_id = 1;
$assigned_user_id = $_SESSION['userId'];

//Submit New Changes to DB
if (isset($_POST['addTask'])) {
    
    $title = $_POST['title'];
    $description =  $_POST['description'];
    $assigned_user_id =  $_POST['assigned_user_id'];
    $state_id =  $_POST['state_id'];
    $category_id = $_POST['category_id'];
    $priority_id =  $_POST['priority_id'];
    $estimated_time =  $_POST['estimated_time'];
    $spent_time =  $_POST['spent_time'];
    $remaining_time =  $_POST['remaining_time'];
    $due_date =  $_POST['due_date'];
    $project_id = $_SESSION['projectId'];
    $creator_user_id = $_SESSION['userId'];


    $count = $t->addTask($title, $description, $assigned_user_id, $state_id, $category_id, $priority_id, $estimated_time, $spent_time, $remaining_time, $due_date, $project_id, $creator_user_id, $dbcon);

    echo $count;

    if ($count) {
        header("Location: ./task-board.php");
    } else {
        echo "Problem in adding new task";
    }
}

// Navigate to task board on Cancel
if (isset($_POST['cancelEditTask'])) {
    header("Location: ./task-board.php");
}
?>

<main>
    <section class="container my-5">
        <form action="" name="taskForm" method="post">
            <div class="row">
            <div class="col-sm-6">
                    <h3 class="mb-0">CREATE NEW TASK</h3>
                </div>
                <div class="col-6">
                    <div class="float-end">
                        <button type="submit" name="cancelEditTask" class="btn btn-secondary">Cancel</button>
                        <button type="submit" name="addTask" class="btn btn-success">Save</button>
                    </div>
                </div>
            </div>
            <input type="hidden" id="id" name="id" value="<?= $id ?>" />
            <div class="row">
                <div class="form-group col-12">
                    <label for="task">Title:</label>
                    <input class="form-control" type="text" id="title" name="title" value="<?= isset($title) ? $title : ''; ?>" />
                </div>
            </div>
            <div class="row">
                <div class="form-group col-12">
                    <label for="category">Backlog Item:</label>
                    <select class="form-control" name="category_id" id="category_id" value="<?= isset($category_id) ? $category_id : ''; ?>">
                        <option value="0" select="selected">-- Backlog Item --</option>
                        <?php foreach ($categories as $category) { ?>
                            <option value="<?= $category['id'] ?>" <?= $category_id == $category['id'] ? ' selected="selected"' : ''; ?>><?php echo $category['title'] ?></option>
                        <?php } ?>
                    </select>
                    <span style="color:red;"><?= isset($CategoryErr) ? $CategoryErr : ''; ?></span>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="assignedTo">Assigned to:</label>
                    <select class="form-control" name="assigned_user_id" id="assigned_user_id" value="<?= isset($assigned_user_id) ? $assigned_user_id : ''; ?>">
                        <option value="0" select="selected">-- Assigned To --</option>
                        <?php foreach ($users as $user) { ?>
                            <option value="<?= $user['user_id'] ?>" <?= $assigned_user_id == $user['user_id'] ? ' selected="selected"' : ''; ?>><?php echo $user['name'] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="state">State:</label>
                    <select class="form-control" name="state_id" id="state_id" value="<?= isset($state_id) ? $state_id : ''; ?>">
                        <option value="0" select="selected">-- State --</option>
                        <?php foreach ($states as $state) { ?>
                            <option value="<?= $state['ID'] ?>" <?= $state_id == $state['ID'] ? ' selected="selected"' : ''; ?>><?php echo $state['description'] ?></option>
                        <?php } ?>
                    </select>
                    <span style="color:red;"><?= isset($stateErr) ? $stateErr : ''; ?></span>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-12">
                    <label for="description">Description:</label>
                    <textarea class="form-control" name="description" id="description" rows="8" cols="50"><?= isset($description) ? $description : ''; ?></textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="row">
                        <div class="form-group">
                            <label for="estimated_time">Original Estimated:</label>
                            <input class="form-control" type="number" step="0.5" id="estimated_time" name="estimated_time" value="<?= isset($estimated_time) ? $estimated_time : ''; ?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label for="spent_time">Spent time:</label>
                            <input class="form-control" name="spent_time" id="spent_time" value="<?= isset($spent_time) ? $spent_time : ''; ?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label for="remaining_time">Remaining:</label>
                            <input class="form-control" type="number" step="0.5" name="remaining_time" id="remaining_time" value="<?= isset($remaining_time) ? $remaining_time : ''; ?>">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="form-group">
                            <label for="due_date">Due date:</label>
                            <input class="form-control" type="date" id="due_date" name="due_date" value="<?= isset($due_date) ? $due_date : ''; ?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label for="priority_id">Priority:</label>
                            <select class="form-control" name="priority_id" id="priority_id" value="<?= isset($priority_id) ? $priority_id : ''; ?>">
                                <option value="0" select="selected">-- Backlog Item --</option>
                                <?php foreach ($priorities as $priority) { ?>
                                    <option value="<?= $priority['id'] ?>" <?= $priority_id == $priority['id'] ? ' selected="selected"' : ''; ?>><?php echo $priority['description'] ?></option>
                                <?php } ?>
                            </select>
                            <span style="color:red;"><?= isset($priorityErr) ? $priorityErr : ''; ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>
</main>

<?php

require("./partials/footer.php");
insertFooter();

?>