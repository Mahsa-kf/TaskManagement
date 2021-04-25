<?php
require("./partials/header.php");
require("./partials/footer.php");
insertHeader();


require_once '../Model/Database.php';
require_once '../Model/Task.php';

if(isset($_POST['id'])){
    echo "zzz";
     
    $id = $_POST['id'];
    echo $id;
    $db = Database::getDb();

    $s = new Task();
    $count = $s->deleteTask($id, $db);

    if($count){
        header("Location: category-list.php");
    }
    else {
        echo " category deleting";
    }


}