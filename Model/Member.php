<?php
// namespace TaskManagement\Model;

class Member
{
    public function getAllUsers($dbcon){
        $query = "SELECT * FROM app_user";
        $pdostm = $dbcon->prepare($query);
        $pdostm->execute();
        $users = $pdostm->fetchAll(PDO::FETCH_OBJ);
        return $users;
    }

    public function addProjectUsers($app_user_id, $project_id, $role_id, $db)
    {
        foreach ($app_user_id as $userId) {
            $sql = "INSERT INTO project_user (app_user_id, project_id, role_id) 
                  VALUES (:app_user_id, :project_id, :role_id)
                  ";
            $pst = $db->prepare($sql);

            $pst->bindParam(':app_user_id', $userId);
            $pst->bindParam(':project_id', $project_id);
            $pst->bindParam(':role_id', $role_id);

            $count = $pst->execute();
        }

        return $count;
    }

    public function deleteProjectUser($userId, $db){
        $sql = "DELETE FROM project_user WHERE app_user_id = :id";

        $pst = $db->prepare($sql);
        $pst->bindParam(':app_user_id', $userId);
        $count = $pst->execute();
        return $count;

    }

    public function updateProjectUser($id, $name, $project_timestamp, $description, $db){
        $sql = "Update project
                set name = :name,
                project_timestamp = :project_timestamp,
                description = :description
                WHERE id = :project_id
        
        ";

        $pst =  $db->prepare($sql);

        $pst->bindParam(':name', $name);
        $pst->bindParam(':project_timestamp', $project_timestamp);
        $pst->bindParam(':description', $description);
        $pst->bindParam(':project_id', $id);

        $count = $pst->execute();

        return $count;
    }

    public function getProjectById($id, $db){
        $sql = "SELECT * FROM project where id = :id";
        $pst = $db->prepare($sql);
        $pst->bindParam(':id', $id);
        $pst->execute();
        return $pst->fetch(\PDO::FETCH_OBJ);
    }



}