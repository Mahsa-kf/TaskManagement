<?php

class Task
{
    public function getTaskById($id, $db){
        $sql = "SELECT * FROM tasks WHERE id = :id";
        $pst = $db->prepare($sql);
        $pst->bindParam(':id', $id);
        $pst->execute();
        return $pst->fetch(PDO::FETCH_OBJ);
    }

    public function getProjectTasks($project_id, $db){
        $sql = "SELECT * FROM tasks WHERE project_id = :project_id";
        $pst = $db->prepare($sql);
        $pst->bindParam(':project_id', $project_id);
        $pst->execute();

        $tasks = $pst->fetchAll(PDO::FETCH_OBJ);
        return $tasks;
    }

    public function updateTask($id, $title, $description, $assigned_user_id, $state_id, $category_id, $priority_id, $estimated_time, $spent_time, $remaining_time, $due_date, $dbcon){
        $sql = "UPDATE tasks
                SET title = :title,
                    description = :description,
                    assigned_user_id = :assigned_user_id,
                    state_id = :state_id,
                    category_id = :category_id,
                    priority_id = :priority_id,
                    estimated_time = :estimated_time,
                    spent_time = :spent_time,
                    remaining_time = :remaining_time,
                    due_date = :due_date
                WHERE id = :id
        ";

        $pst = $dbcon->prepare($sql);

        $pst->bindParam(':title', $title);
        $pst->bindParam(':description', $description);
        $pst->bindParam(':assigned_user_id', $assigned_user_id);
        $pst->bindParam(':state_id', $state_id);
        $pst->bindParam(':category_id', $category_id);
        $pst->bindParam(':priority_id', $priority_id);
        $pst->bindParam(':estimated_time', $estimated_time);
        $pst->bindParam(':spent_time', $spent_time);
        $pst->bindParam(':remaining_time', $remaining_time);
        $pst->bindParam(':due_date', $due_date);
        // $pst->bindParam(':project_id', $project_id);
        // $pst->bindParam(':creator_user_id', $creator_user_id);
        // $pst->bindParam(':created_date', $created_date);
        $pst->bindParam(':id', $id);

        $count = $pst->execute();
        return $count;
    }
}
