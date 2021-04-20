<?php
/*page -> add-member.php
       -> delete-member.php
       -> delete-project.php
       -> list-member.php
       -> new-project.php
       -> update-member.php
       -> update-project.php

 * method to retrieve/edit/delete data from project table*/

class Project
{

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

    public function deleteProject($id, $db)
    {
        $sql = "DELETE FROM project WHERE id = :id";

        $pst = $db->prepare($sql);
        $pst->bindParam(':id', $id);
        $count = $pst->execute();

        return $count;

    }

    public function updateProject($id, $name, $project_timestamp, $description, $db)
    {
        $sql = "UPDATE project
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
        $sql = "SELECT * FROM project where id = :id";
        $pst = $db->prepare($sql);
        $pst->bindParam(':id', $id);
        $pst->execute();
        $project_details = $pst->fetch(\PDO::FETCH_OBJ);
        return $project_details;
    }


}