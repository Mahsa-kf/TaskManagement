<?php
require("./partials/header.php");
require("./partials/sidebar.php");
insertHeader();
//insertSidebar();
session_start();

require_once '../Model/Database.php';
require_once '../Model/Task.php';

$dbcon = Database::getDb();
$t = new Task();
$tasks =  $t->getAllTask($dbcon);

?>
<!--Main Start Here-->
<!--Content Start here-->

<main class="text-center">
    <section class="container my-5">
        <!--name of the project-->
        <h2>Aroma website project -Task board</h2>
        <form class="row my-md-4 task-filters" >

            <div class="col-md-3" >
                <select class="form-control" >
                    <option value="">Assigned To</option>
                </select>
            </div>
            <div class="col-md-3">
                <select class="form-control">
                    <option value="">Category</option>
                </select>
            </div>
            <div class="col-md-3">
                <select class="form-control">
                    <option value="">State</option>
                </select>
            </div>
            <div class="col-md-3">
                <select class="form-control ">
                    <option value="">Sort By</option>
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
                <tbody >
                
                    <?php foreach ($tasks as $task) { ?>
                        <tr>
                            <th><?= $task->id; ?></th>
                            <td><?= $task->title; ?></td>
                            <td><?= $task->category_id; ?></td>  
                            <td><?= $task->state_id; ?></td>      
                            <td>
                                <form action="./task-form.php" method="post">
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