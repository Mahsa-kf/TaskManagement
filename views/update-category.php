
<?php
require("./partials/header.php");
require("./partials/footer.php");
insertHeader();
session_start();

require_once '../Model/Database.php';
require_once '../Model/Category.php';

/*Extract the current data from DB*/
if(isset($_POST['updCategory'])){
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
    $title = $_POST['title']; 
    $description = $_POST['description'];
    $project_id = $_POST['project_id'];
    $creator_user_id = $_POST['creator_user_id'];


    $db = Database::getDb();
    $ca = new Category();
    $categories = $ca->updateCategory($id, $title, $description, $project_id, $creator_user_id, $db);

    if($count){
        header('Location:  list-category.php');
     } else {
         echo "problem";
     }
}
?>

<main>
    <section class="container my-5">
        <h2>Update Category</h2>        
        <form action="./list-category.php" name="upd_category" method="post">
            <div class="row">
                <div class="col-12">
                    <div class="float-end">
                        <button type="submit" name="cancelCategory" class="btn btn-secondary">Cancel</button>                        
                        <button type="submit" name="addCategory" class="btn btn-success">Save</button>
                    </div>
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