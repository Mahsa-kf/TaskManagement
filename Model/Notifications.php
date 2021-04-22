<?php

//namespace Model;

class Notifications {

    public function __construct() {
        
    }

    // This method will create a notification about the number of tasks that are past due and will be due in the next 7 days for a user. This function can distinguish between tasks that are past due and those that are due in the next 7 days.
    public static function deadlineNotifications($user_id, $dbconn) {

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
                AND DATE_ADD(tasks.created_date, INTERVAL tasks.estimated_time DAY) < DATE_ADD(NOW(), INTERVAL 7 DAY)
            ORDER BY due_date;";


        $pdostm = $dbconn->prepare($sql);
        $pdostm->bindParam(':id', $user_id);
        $pdostm->setFetchMode(PDO::FETCH_OBJ); // Return the data from db as objects

        try {
            $pdostm->execute();
            $queryResults = $pdostm->fetchAll(); // Assign the result set to a variable

            $tasksPastDue = []; // Array to store project id of any past due tasks
            $tasksComingDue = []; // Array to store project id of any tasks due within 7 days
            $currentDate = date_create(date("Y-m-d"));

            foreach($queryResults as $result) {

                $formattedDueDate = date_create(date("Y-m-d", strtotime($result->due_date)));
                $dateDifference = date_diff($currentDate, $formattedDueDate);

                if (intval($dateDifference->format("%R%a")) < 0) {
                    $tasksPastDue[$result->title] = $result->project_id;
                }

                if (intval($dateDifference->format("%R%a")) >= 0) {
                    $tasksComingDue[$result->title] = $result->project_id;
                }

            }

            if (count($tasksPastDue) === 0 && count($tasksComingDue) === 0) {
                
                $notificationDiv = <<<NOTIFICATIONDIV
                    <div class="border rounded mx-1 my-3 border border-dark">
                        <h3 class="h6">Notifications</h3>
                        <p>You have no tasks that are past due or will become due in the next 7 days.</p>
                    </div>
                    NOTIFICATIONDIV;
                    
            } else {

                $tasksPastDueCount = strval(count($tasksPastDue));
                $tasksComingDueCount = strval(count($tasksComingDue));
                // TODO: Add code to display links to the overdue tasks by reading the project id from the arrays
                $notificationDiv = <<<NOTIFICATIONDIV
                    <div class="border rounded mx-1 my-3 border border-dark">
                        <h3 class="h6">Notifications</h3>
                        <p>Tasks past due: $tasksPastDueCount</p>
                        <p>Tasks due within seven days: $tasksComingDueCount</p>
                    </div>
                    NOTIFICATIONDIV;

            }

            return $notificationDiv;            
        
        
        }
        catch (\Exception $e) {
            return "Error: " . $e->getMessage();
        }
    }
}


?>