<?php
require_once '../Model/Project.php';
require_once '../Model/Database.php';

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    $p = new Project();
    $count = $p->deleteProject($id, Database::getDb());
    if ($count) {
        header("Location: projects-overview.php");
    } else {
        echo " problem deleting";
    }


}