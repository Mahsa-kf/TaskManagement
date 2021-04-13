<?php
// namespace TaskManagement\Model;

// THIS PAGE NEED TO DO FURTHER CHECKING

class UpdateProject
{

    public function getProjects($db){
        $query = "SELECT *  FROM project";
        $pdostm = $db->prepare($query);
        $pdostm->execute();

        //fetch all result
        $results = $pdostm->fetchAll(\PDO::FETCH_OBJ);
        return $results;
    }

    
    
}

    
