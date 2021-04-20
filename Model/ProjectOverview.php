<?php
/*page -> project-overview.php
 * method to retrieve data from project table*/
class ProjectOverview
{

    public function getAllProjects($dbcon)
    {
        $query = "SELECT * FROM project";
        $pdostm = $dbcon->prepare($query);
        $pdostm->execute();
        $projects = $pdostm->fetchAll(PDO::FETCH_OBJ);
        return $projects;
    }


}