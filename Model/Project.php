<?php
// namespace TaskManagement\Model;

class Project
{
    public function getProjects($db){
        $query = "SELECT *  FROM project";
        $pdostm = $db->prepare($query);
        $pdostm->execute();

        //fetch all result
        $results = $pdostm->fetchAll(\PDO::FETCH_OBJ);
        return $results;
    }

    public function addProject($name, $project_timestamp, $description, $db)
    {
        $sql = "INSERT INTO project (name, project_timestamp, description) 
              VALUES (:name, :project_timestamp, :description)";
        $pst = $db->prepare($sql);

        $pst->bindParam(':name', $name);
        $pst->bindParam(':project_timestamp', $project_timestamp);
        $pst->bindParam(':description', $description);
        $count = $pst->execute();
        return $count;
    }

    public function deleteProject($id, $db){
        $sql = "DELETE FROM project WHERE id = :id";

        $pst = $db->prepare($sql);
        $pst->bindParam(':id', $id);
        $count = $pst->execute();

        return $count;

    }

    public function updateProject($id, $name, $project_timestamp, $description, $db){
        $sql = "UPDATE project
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
        $project_details = $pst->fetch(\PDO::FETCH_OBJ);
        return $project_details;
    }

    /* This have been move to Member Class and apply to add-member.php
    public function getAllUsersForProject($db){
        $sql = "SELECT * FROM app_user";
        $pdostm = $db->prepare($sql);
        $pdostm->execute();
        $project_users = $pdostm->fetchAll(PDO::FETCH_OBJ);
        return $project_users;
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
    }*/

}