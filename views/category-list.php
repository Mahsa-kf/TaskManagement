<?php
require("./partials/header.php");
require("./partials/footer.php");
insertHeader();
session_start();

require_once '../Model/Database.php';
require_once '../Model/Category.php';

if (isset($_SESSION['userId']) && $_SESSION['isLoggedIn']  && isset($_SESSION['projectId'])) {

    $dbcon = Database::getDb();
    $ca = new Category();
    $categories =  $ca->getAllCategories($dbcon);

    $project_name = $_SESSION['projectName'];
} else {
    // Redirect to login if user id does not exist
    header("Location: ./login.php");
    exit();
}
?>
<main>
    <section class="container my-5">

        <div class="row">
            <div class="col-md-8 text-left">
                <div class="row">
                    <h3 class="mb-0">Backlog items: <?= $project_name ?></h3>
                </div>
                <div class="text-left m-0">
                    <a class="btn btn-link ps-0" href="task-board.php">TASK BOARD</a>
                    <a class="btn btn-link ps-0" href="category-add.php">CREATE NEW Backlog Item</a>
                </div>
            </div>

        </div>
        <div class="m-1">
            <!--    Displaying Data in Table-->
            <table class="table tbl">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Title</th>
                        <th scope="col">Description</th>
                        <th scope="col">Update</th>
                        <th scope="col">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($categories as $category) { ?>
                        <tr>
                            <th><?= $category->id; ?></th>
                            <td><?= $category->title; ?></td>
                            <td><?= $category->description; ?></td>
                            <td>
                                <form action="./category-delete.php" method="post" onsubmit="return confirm('Are you sure you want to delete?');">
                                    <input type="hidden" name="id" value="<?= $category->id; ?>" />
                                    <input type="submit" class="button btn btn-danger" name="deleteCategory" value="Delete" />
                                </form>
                            </td>
                            <td>
                                <form action="./category-update.php" method="post">
                                    <input type="hidden" name="id" value="<?= $category->id; ?>" />
                                    <input type="submit" class="button btn btn-primary" name="getCategoryDetails" value="Update" />
                                </form>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <a href="./category-add.php" id="btn_addCategory" class="btn btn-success btn-lg float-right">Add Category</a>

        </div>
    </section>
</main>