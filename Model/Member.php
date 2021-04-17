<?php
// namespace TaskManagement\Model;

class Member
{
    public function getAllUsers($dbcon)
    {
        $query = "SELECT * FROM app_user";
        $pdostm = $dbcon->prepare($query);
        $pdostm->execute();
        $users = $pdostm->fetchAll(PDO::FETCH_OBJ);
        return $users;
    }

    public function addProjectUsers($userId, $project_id, $role_id, $db)
    {
        //foreach ($app_user_id as $userId) {}
        $sql = "INSERT INTO project_user (app_user_id, project_id, role_id) 
                  VALUES (:app_user_id, :project_id, :role_id)";
        $pst = $db->prepare($sql);
        $pst->bindParam(':app_user_id', $userId);
        $pst->bindParam(':project_id', $project_id);
        $pst->bindParam(':role_id', $role_id);
        $count = $pst->execute();
        return $count;
    }

    public function deleteProjectUser($userId, $db)
    {
        $sql = "DELETE FROM project_user WHERE app_user_id = :id";

        $pst = $db->prepare($sql);
        $pst->bindParam(':app_user_id', $userId);
        $count = $pst->execute();
        return $count;

    }

    public function updateProjectUser($id, $name, $project_timestamp, $description, $db)
    {
        $sql = "Update project
                set name = :name,
                project_timestamp = :project_timestamp,
                description = :description
                WHERE id = :project_id
        
        ";

        $pst = $db->prepare($sql);

        $pst->bindParam(':name', $name);
        $pst->bindParam(':project_timestamp', $project_timestamp);
        $pst->bindParam(':description', $description);
        $pst->bindParam(':project_id', $id);

        $count = $pst->execute();

        return $count;
    }

    public function getProjectById($id, $db)
    {
        var_dump($id);
        $sql = "SELECT * FROM project where id = :id";
        $pst = $db->prepare($sql);
        $pst->bindParam(':id', $id);
        $pst->execute();
        return $pst->fetch(\PDO::FETCH_OBJ);
    }


    public function getMemberById($id, $db)
    {
        $sql = "SELECT app_user.id AS user_id,app_user.first_name AS first_name,app_user.last_name AS last_name,project.id AS project_id ,project.name AS project_name, role.id AS role_id, role.description AS role_description 
                FROM project_user 
                    JOIN app_user ON app_user.id = project_user.app_user_id 
                    JOIN project ON project.id = project_user.project_id 
                    JOIN role ON role.id = project_user.role_id 
                where project_user.project_id = :id";
        $pst = $db->prepare($sql);
        $pst->bindParam(':id', $id);
        $pst->execute();
        return $pst->fetchAll(\PDO::FETCH_ASSOC);
    }


}