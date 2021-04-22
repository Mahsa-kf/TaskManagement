<?php

//namespace Model;

class UpcomingDueDates {

    public function __construct() {
        
    }

    // This method will show the top 5 most urgent open tasks that a user is responsible for, tasks that are past due will be included since they are deemed even more urgent 
    public static function getUpcomingDueDates($user_id, $dbconn) {

        /* $sql = "SELECT *, DATE_ADD(tasks.created_date, INTERVAL tasks.estimated_time DAY) AS due_date FROM tasks JOIN state ON tasks.state_id = state.id WHERE tasks.assigned_user_id = :id AND state.description <> 'Done' AND state.description <> 'Canceled' ORDER BY due_date ASC LIMIT 5;"; */

        $sql = "SELECT *, 
                DATE_ADD(tasks.created_date, INTERVAL tasks.estimated_time DAY) AS due_date 
                FROM tasks 
                JOIN project_user 
                    ON tasks.assigned_user_id = project_user.app_user_id 
                JOIN state 
                    ON tasks.state_id = state.id
                WHERE project_user.app_user_id = :id 
                    AND state.description <> 'Done' 
                    AND state.description <> 'Canceled' 
                ORDER BY due_date ASC
                LIMIT 5;";

        $pdostm = $dbconn->prepare($sql);
        $pdostm->bindParam(':id', $user_id);
        $pdostm->setFetchMode(PDO::FETCH_OBJ); // Return the data from db as objects

        try {
            $pdostm->execute();
            $queryResults = $pdostm->fetchAll(); // Assign the result set to a variable

            $taskElements = '';
            foreach($queryResults as $result) {
            
            $formattedDueDate = date("Y-m-d", strtotime($result->due_date)); 

            $taskElements .= <<<TASKHTML
                <div class="border-top border-bottom">
                    <h4 class="h6">$result->title</h4>
                    <p>$result->description</p>
                    <p>Due: $formattedDueDate</p>
                </div>
            TASKHTML;
            }

            $dueDatesDiv = <<<DUEDATESDIV
                <div class="border rounded mx-1 my-3 border border-dark">
                    <h3 class="h6">Upcoming Due Dates</h3>
                    $taskElements
                </div>
            DUEDATESDIV;

            return $dueDatesDiv;            
        
        
        }
        catch (\Exception $e) {
            return "Error: " . $e->getMessage();
        }
    }
}


?>