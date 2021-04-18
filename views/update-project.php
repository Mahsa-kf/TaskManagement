<?php

// Start or resume a session
session_start();

require("./partials/header.php");
//require("./partials/sidebar.php");
insertHeader();
//insertSidebar();
//session_start();
require_once '../Model/Project.php';
require_once '../Model/Database.php';
require_once '../Model/ProjectOverview.php';




//Declare variables for empty string, error message
$name = "";
$project_timestamp = "";
$description = "";
//$projectNameErr = "Please enter a project name";
//$projectTimestampErr = "Please select the start time for this project";
//$projectDescErr = "Please enter a description about this project";


/*Extract the current data from DB*/
if (isset($_POST['updateProject'])) {
    $id = $_POST['id'];

    $db = Database::getDb();

    $p = new Project();
    $project = $p->getProjectById($id, $db);

    $name = $project->name;
    $project_timestamp = $project->project_timestamp;
    $description = $project->description;

}

//Submit New Changes to DB
if (isset($_POST['updProject'])) {
    //Project ID
    $project_id = $_POST['id'];
    if ($_POST['id'] == "") {
        $projectIdErr = "Please re-confirm your project id";
    }
    $name = $_POST['project_name'];
    if ($_POST['project_name'] == "") {
        $projectNameErr = "Please enter a project name";
    }
    $project_timestamp = $_POST['project_timestamp'];
    if ($_POST['project_timestamp'] == "") {
        $projectTimestampErr = "Please select the start time for this project";
    }
    $description = $_POST['project_description'];
    if ($_POST['project_description'] == "") {
        $projectDescErr = "Please enter a description about this project";
    }
    if(!empty($project_id && $name && $project_timestamp && $description)) {
        $db = Database::getDb();
        $p = new Project();
        $projects = $p->updateProject($project_id, $name, $project_timestamp, $description, $db);
    }
    header('Location:  projects-overview.php');
}
?>
<!--Main Start Here-->
<!--Content Start here-->
<main>
    <div class="container container-login text-center my-5">
        <div class="row justify-content-md-center">
            <h2>Update Project</h2>
            <div>
                <form id="add_project_form" name="form_add_project" method="POST" action="">
                    <input type="hidden" name="id" value="<?= $id; ?>"/>
                    <span style="color:red;"><?= isset($projectIdErr) ? $projectIdErr : ''; ?></span>
                    <div class="form-group row mb-3">
                        <label class="col-sm-3 col-form-label" for="project_name">Project Name</label>
                        <input class="col-sm-9" type="text" name="project_name" id="project_name" value="<?= $name; ?>"
                               placeholder="Please type your project name">
                        <span style="color:red;"><?= isset($projectNameErr) ? $projectNameErr : ''; ?></span>
                    </div>


                    <div class="form-group row mb-3">
                        <label class="col-sm-3 col-form-label" for="project_timestamp">Start Date</label>
                        <input class="col-sm-9" type="datetime-local" name="project_timestamp"
                               id="project_timestamp datepicker"
                               value="<?= str_replace(" ", "T", $project_timestamp) ?>"
                               placeholder="Please select the project's start date">
                        <span style="color:red;"><?= isset($projectTimestampErr) ? $projectTimestampErr : ''; ?></span>
                    </div>

                    <div class="form-group row mb-3">
                        <div class="label"><label class="col-form-label" for="Description">Project Description</label>
                            <textarea class="form-control" name="project_description" id="project_description" rows="6"
                                      placeholder="Please provide the details of the project"><?= $description ?></textarea>
                            <span style="color:red;"><?= isset($projectDescErr) ? $projectDescErr : ''; ?></span>
                        </div>

                        <div class="form-group my-5 text-center">
                            <div>
                                <input type="submit" name="updProject" class="btn btn-primary btn-lg"
                                       value="Update Project">
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</main>
<?php

require("./partials/footer.php");
insertFooter();

?>
