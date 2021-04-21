<?php
require("./partials/header.php");
require("./partials/footer.php");
insertHeader();
session_start();

require_once '../Model/Database.php';
require_once '../Model/Category.php';

$dbcon = Database::getDb();
$ca = new Category();
$categories =  $ca->getAllCategories($dbcon);

?>
<main>
    <section class="container my-5">

        <p class="h1 text-center">Category List</p>
        <div class="m-1">
            <!--    Displaying Data in Table-->
            <table class="table tbl">
                <thead>
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
                                    <input type="hidden" name="id" value="<?= $category->id;?>"/>
                                    <input type="submit" class="button btn btn-danger" name="deleteCategory" value="Delete"/>
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