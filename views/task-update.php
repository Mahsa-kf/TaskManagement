<?php
require("./partials/header.php");
//require("./partials/sidebar.php");
insertHeader();
//insertSidebar();
session_start();

//Get project_id and user_id from session
//$project_id = $_SESSION['project_id'];
$project_id = 2;
$user_id = $_SESSION['user_id'];

?>
<main>
    <section class="container my-5">
        <h2>Create New Task</h2>
        <form action="" name="taskForm" method="post">
            <div class="row">
                <div class="col-12">
                    <div class="float-end">
                        <button type="button" class="btn btn-secondary">Cancel</button>                        
                        <button type="button" class="btn btn-danger">Delete</button>
                        <button type="button" class="btn btn-success">Save</button>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-6">
                    <label for="AssignedTo">Assigned to:</label>
                    <select class="form-control" name="AssignedTo" id="AssignedTo">
                        <option value="">Choose one</option>
                    </select>
                    <span style="color:red;"><?= isset($AssignedToErr) ? $AssignedToErr : ''; ?></span>
                </div>
                <div class="form-group col-md-6">
                    <label for="AssignedTo">State:</label>
                    <select class="form-control" name="State" id="State">
                        <option value="">Choose one</option>
                    </select>
                    <span style="color:red;"><?= isset($stateErr) ? $stateErr : ''; ?></span>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-12">
                    <label for="task">task title:</label>
                    <input class="form-control" type="text" id="task" name="task" value="<?= isset($task) ? $task : ''; ?>" />
                    <span style="color:red;"><?= isset($taskErr) ? $taskErr : ''; ?></span>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-12">
                    <label for="Category">Task Group:</label>
                    <input class="form-control" type="text" id="Category" name="Category" value="<?= isset($projectName) ? $task : ''; ?>" />
                    <span style="color:red;"><?= isset($CategoryErr) ? $CategoryErr : ''; ?></span>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-12">
                    <label for="description">Description:</label>
                    <textarea class="form-control" name="description" id="description" rows="8" cols="50" value="<?= isset($comment) ? $comment : ''; ?>"></textarea>
                    <span style="color:red;"><?= isset($commentErr) ? $commentErr : ''; ?></span>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="row">
                        <div class="form-group">
                            <label for="dueDate">Due date:</label>
                            <input class="form-control" type="date" id="dueDate" name="dueDate">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label for="priority">Priority:</label>
                            <select class="form-control" name="State" id="State">
                                <option value="">Choose one</option>
                            </select>
                            <span style="color:red;"><?= isset($priorityErr) ? $priorityErr : ''; ?></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3"></div>
                <div class="col-md-3">
                    <div class="row">
                        <div class="form-group">
                            <label for="estimatedTime">Original Estimated:</label>
                            <input class="form-control" type="number" step="0.5" id="estimatedTime" name="estimatedTime">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label for="spentTime">Spent time:</label>
                            <input class="form-control" name="spentTime" id="spentTime">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label for="remaining">Remaining:</label>
                            <input class="form-control" type="number" step="0.5" name="remaining" id="remaining">
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