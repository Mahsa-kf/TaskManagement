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

    public function deleteTask($id, $db){
        $sql = "DELETE FROM tasks WHERE id = :id";

        $pst = $db->prepare($sql);
        $pst->bindParam(':id', $id);
        $count = $pst->execute();
        return $count;
    }

    public function getProjectTasksByFilters($project_id, $assigned_user_id, $category_id, $state_id, $db){
        $sql = "SELECT 
                    t.id as id, 
                    t.title as title, 
                    c.title as category, 
                    s.description as state 
                FROM tasks t 
                left join category c 
                on t.category_id = c.id 
                left join state s 
                on t.state_id = s.id 
                WHERE t.project_id = :project_id 
                    AND (:assigned_user_id = 0 OR t.assigned_user_id = :assigned_user_id)
                    AND (:category_id = 0 OR t.category_id = :category_id)
                    AND (:state_id = 0 OR t.state_id = :state_id)";

        $pst = $db->prepare($sql);
        $pst->bindParam(':project_id', $project_id);
        $pst->bindParam(':assigned_user_id', $assigned_user_id);
        $pst->bindParam(':category_id', $category_id);
        $pst->bindParam(':state_id', $state_id);
        $pst->execute();

        $tasks = $pst->fetchAll(PDO::FETCH_OBJ);
        return $tasks;
    }

    public function addTask($title, $description, $assigned_user_id, $state_id, $category_id, $priority_id, $estimated_time, $spent_time, $remaining_time, $due_date, $project_id, $creator_user_id, $dbcon) {
        
        $sql = "INSERT INTO tasks (title, description, assigned_user_id, state_id, category_id, priority_id, estimated_time, spent_time, remaining_time, due_date, project_id, creator_user_id, created_date) 
              VALUES (:title, :description, :assigned_user_id, :state_id, :category_id, :priority_id, :estimated_time, :spent_time, :remaining_time, :due_date, :project_id, :creator_user_id, NOW()) ";
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
        $pst->bindParam(':project_id', $project_id);
        $pst->bindParam(':creator_user_id', $creator_user_id);

        $count = $pst->execute();
        return $count;
    }

    public function updateTask($id, $title, $description, $assigned_user_id, $state_id, $category_id, $priority_id, $estimated_time, $spent_time, $remaining_time, $due_date, $dbcon) {
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

        $pst->bindParam(':id', $id);
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

        $count = $pst->execute();
        return $count;
    }
}
