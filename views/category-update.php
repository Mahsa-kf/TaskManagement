
<?php
require("./partials/header.php");
require("./partials/footer.php");
insertHeader();
session_start();

require_once '../Model/Database.php';
require_once '../Model/Category.php';

/*Extract the current data from DB*/
if(isset($_POST['getCategoryDetails'])){
    $id= $_POST['id'];

    $db = Database::getDb();

    $ca = new Category();
    $category = $ca->getCategoryById($id, $db);
    
    $title = $category->title;
    $description = $category->description;
}

//Submit New Changes to DB
if(isset($_POST['updCategory'])) {
    $id= $_POST['id'];
    $creator_user_id = $_SESSION['creator_user_id'];
    $title = $_POST['title']; 
    $description =  $_POST['description'];
    $project_id = $_SESSION['projectId'];;



    if ($title != "" && $description != "") {
        $db = Database::getDb();
        $ca = new Category();
        $count = $ca->updateCategory($id, $title, $description, $project_id, $creator_user_id, $db);

        if($count){
            header("Location: ./category-list.php");
        } else {
            echo "problem";
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

if (isset($_POST['cancelCategory'])) {
    header("Location: ./category-list.php");
}
?>

<main>
    <section class="container my-5">
        <form action="" name="categoryForm" method="post">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">UPDATE BACKLOG ITEM</h3>
                </div>
                <div class="col-6">
                    <div class="float-end">
                        <button type="submit" name="cancelCategory" class="btn btn-secondary">Cancel</button>                        
                        <button type="submit" name="updCategory" class="btn btn-success">Save</button>
                    </div>
                </div>
            </div>
            <input type="hidden" id="id" name="id" value="<?=$id?>"/>
            <input type="hidden" id="creator_user_id" name="creator_user_id" value="<?=isset($creator_user_id) ? $creator_user_id : '';?>"/>
            <div class="row">
                <div class="form-group col-12">
                    <label for="title">Title</label>
                    <input class="form-control required" type="text" id="title" name="title" value="<?= isset($title) ? $title : ''; ?>" />
                    <span class="text-danger"><?= isset($titleErr) ? $titleErr : ''; ?></span>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-12">
                    <label for="description">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="8" cols="50"><?= isset($description) ? $description : ''; ?></textarea>
                </div>
            </div>
            <!-- <div class="row">
                <div>Created By: Mahsa Karimi Fard </div>
                <div>Last Modify: 2021-02-21</div>  
            </div>  -->
        </form>
    </section>
</main>