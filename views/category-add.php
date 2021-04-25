<?php
session_start();
require("./partials/header.php");
require("./partials/footer.php");
insertHeader();


require_once '../Model/Database.php';
require_once '../Model/Category.php';

// session_start();

if (isset($_POST['addCategory'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $project_id = 2;   // to do: get info from session
    $creator_user_id = 3;   // to do: get info from session

    if ($title != "" && $description != "") {
        $db = Database::getDb();
        $ca = new Category();
        $count = $ca->addCategory($title, $description, $project_id, $creator_user_id, $db);

        if ($count) {
            //on success navigate to category list
            header("Location: ./category-list.php");
        } else {
            echo "problem adding a category";
        }
    } else {
        //validate title
        if ($title == "") {
            $titleErr = "Please enter category name";
        }
        //validate description
        if ($description == "") {
            $descriptionErr = "Please enter description!";
        }
    }
}

if (isset($_POST['cancelAddCategory'])) {
    header("Location: ./category-list.php");
}

?>

<main>
    <section class="container my-5">
        <form action="" name="categoryForm" method="post">
            <div class="row">
            <div class="col-md-8 text-left mb-4">
                <h3 class="mb-0">CREATE NEW BACKLOG ITEM</h3>
            </div>
                <div class="col-sm-4 text-right">
                    <button type="submit" name="cancelAddCategory" class="btn btn-secondary">Cancel</button>
                     <button type="submit" name="addCategory" class="btn btn-success">Save</button>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-12">
                    <label for="category">Category name:</label>
                    <input class="form-control" type="text" id="category" name="title" value="<?= isset($title) ? $title : ''; ?>" />
                    <span style="color:red;"><?= isset($titleErr) ? $titleErr : ''; ?></span>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-12">
                    <label for="description">Description:</label>
                    <textarea class="form-control" name="description" id="description" rows="8" cols="50" value="<?= isset($description) ? $description : ''; ?>"></textarea>
                    <span style="color:red;"><?= isset($descriptionErr) ? $descriptionErr : ''; ?></span>
                </div>
            </div>

            <!-- <div class="row">
            <div>Created By: Mahsa Karimi Fard </div>
            <div>Last Modify: 2021-02-21</div>  
        </div>  -->
        </form>
    </section>
</main>