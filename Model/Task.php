<?php

class Task
{
    public function getTaskById($id, $db){
        $sql = "SELECT * FROM tasks WHERE id = :id";
        $pst = $db->prepare($sql);
        $pst->bindParam(':id', $id);
        $pst->execute();
        return $pst->fetch(PDO::FETCH_ASSOC);
    }

    public function getProjectTasks($project_id, $db){
        $sql = "SELECT * FROM tasks WHERE project_id = :project_id";
        $pst = $db->prepare($sql);
        $pst->bindParam(':project_id', $project_id);
        $pst->execute();

        $tasks = $pst->fetchAll(PDO::FETCH_OBJ);
        return $tasks;
    }
}
