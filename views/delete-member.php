<?php
require("./partials/header.php");
require("./partials/footer.php");
insertHeader();
session_start();

require_once '../Model/Database.php';
require_once '../Model/Category.php';

if(isset($_POST['id'])){
    $id = $_POST['id'];
    $db = Database::getDb();

    $m = new Member();
    $count = $m->deleteMember($id, $db);
    if($count){
        header("Location: list-member.php");
    }
    else {
        echo " member deleting";
    }


}
