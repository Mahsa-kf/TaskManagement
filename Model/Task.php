<?php

class Task
{
    public function getTaskById($id, $db){
        $sql = "SELECT * FROM tasks where id = :id";
        $pst = $db->prepare($sql);
        $pst->bindParam(':id', $id);
        $pst->execute();
        return $pst->fetch(PDO::FETCH_OBJ);
    }

    public function getAllTask($db){
        $sql = "SELECT * FROM tasks";
        $pdostm = $db->prepare($sql);
        $pdostm->execute();

        $tasks = $pdostm->fetchAll(PDO::FETCH_OBJ);
        return $tasks;
    }
}
