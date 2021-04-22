<?php

//namespace Model;

class TaskProgress {

    public function __construct() {
        
    }

    // This method assesses the completion percentage of a task, then returns the HTML code to display the results as a progress bar using Bootstrap.
    public static function getTaskProgress($project_id, $dbconn) {

        $sql = "SELECT *
        FROM tasks 
        JOIN state 
            ON tasks.state_id = state.id
        WHERE tasks.project_id = :project_id;";

        $pdostm = $dbconn->prepare($sql);
        $pdostm->bindParam(':project_id', $project_id);
        $pdostm->setFetchMode(PDO::FETCH_OBJ); // Return the data from db as objects

        try {
        $pdostm->execute();
        $queryResults = $pdostm->fetchAll(); // Assign the result set to a variable

        $totalTasksCounter = 0;
        $completedTasksCounter = 0;
        foreach($queryResults as $result) {

            $totalTasksCounter = $totalTasksCounter + 1;

            if ($result->description === "Done" || $result->description === "Canceled") {

                $completedTasksCounter = $completedTasksCounter + 1;
            }
        }

        if ($totalTasksCounter > 0) {
            $completionPercentage = strval(round(($completedTasksCounter / $totalTasksCounter) * 100));   
        } else {
            $completionPercentage = "0";
        }


        $taskProgressElement = <<<PROGRESSHTML
            <div id="taskprogresstitlediv" class="my-1" style="background-color:#334561;color:white;height:1.5rem;">
                <h5 class="h6">Project Progress</h5>
            </div>
            <div class="progress border">
                <div class="progress-bar" role="progressbar" aria-valuenow="$completionPercentage"
                aria-valuemin="0" aria-valuemax="100" style="width:$completionPercentage%">
                <span class="sr-only">$completionPercentage% Complete</span>
                </div>
            </div>
        PROGRESSHTML;


        return $taskProgressElement;            


        }
        catch (\Exception $e) {
        return "Error: " . $e->getMessage();
        }



    }

}
?>
