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
    public function getStudentsInProgram($db, $program){
        $query = "SELECT programs.program as program, students.id, students.name,students.email FROM students, programs where programs.id = students.program_id AND program_id = :program";
        $pdostm = $db->prepare($query);
        $pdostm->bindValue(':program', $program, \PDO::PARAM_STR);
        $pdostm->execute();
        $s = $pdostm->fetchAll(\PDO::FETCH_OBJ);
        return $s;
    }
    
    
}

    
