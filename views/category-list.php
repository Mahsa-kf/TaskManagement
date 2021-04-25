<?php
session_start();

require("./partials/header.php");
require("./partials/footer.php");
insertHeader();

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
        <div class="row p-2">
            <div class="col-md-8 text-left mb-4">
                <h3 class="mb-0">Backlog items: <?= $project_name ?></h3>
            </div>
            <div class="col-sm-4 text-right">
                <a class="btn btn-secondary" href="task-board.php">TASK BOARD</a>
                <a class="btn btn-success" href="category-add.php">CREATE NEW</a>
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
                        <th scope="col"></th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($categories as $category) { ?>
                        <tr>
                            <th><?= $category->id; ?></th>
                            <td><?= $category->title; ?></td>
                            <td><?= $category->description; ?></td>
                            <td>
                                <form action="./category-delete.php" method="post" onsubmit="return confirm('Do you want to delete the category?');">
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
        </div>
    </section>
</main>