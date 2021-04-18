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

    public function addMembersInProjectUser($userId, $project_id, $role_id, $db)
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

    public function deleteMembersInProjectUser($userId, $db)
    {
        $sql = "DELETE FROM project_user WHERE app_user_id = :id";

        $pst = $db->prepare($sql);
        $pst->bindParam(':app_user_id', $userId);
        $count = $pst->execute();
        return $count;

    }

    public function updateMembersInProjectUser($userID, $project_id, $roleID, $db)
    {
        $sql = "Update project_user
                set app_user_id = :app_user_id,
                role_id = :role_id
                WHERE project_id = :id
        
        ";

        $pst = $db->prepare($sql);

        $pst->bindParam(':app_user_id', $userID);
        $pst->bindParam(':role_id', $roleID);
        $pst->bindParam(':id', $project_id);

        $count = $pst->execute();

        return $count;
    }


    public function getMembersByProjectId($id, $db)
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

    public function getMembersNotInProject($projectId, $db)
    {
        $sql = "SELECT app_user.id AS user_id,app_user.first_name AS first_name,app_user.last_name AS last_name 
                FROM app_user 
                where app_user.id not in (
                    select app_user_id from project_user where project_id = :id
                ) 
                ";
        $pst = $db->prepare($sql);
        $pst->bindParam(':id', $projectId);
        $pst->execute();
        return $pst->fetchAll(\PDO::FETCH_ASSOC);
    }
}