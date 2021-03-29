<?php

// Start or resume a session
session_start();

require("./partials/header.php");
//require("./partials/sidebar.php");
insertHeader();
//insertSidebar();
//session_start();
//require_once './newprojectCheck.php';
require_once '../Model/Project.php';
require_once '../Model/Database.php';
require_once '../Model/ProjectOverview.php';


$name = $project_timestamp = $description = "";

if(isset($_POST['updateProject'])){
    $id= $_POST['id'];

    $db = Database::getDb();

    $p = new Project();
    $project = $p->getProjectById($id, $db);
    
    $name = $project->name;
    $project_timestamp =  new Datetime($project_timestamp);
    $date = $project_timestamp->format('Y-m-d');
    $description = $project->description;

}

if(isset($_POST['updProject'])) {
    $id= $_POST['id'];
    $name = $_POST['project_name'];
    $project_timestamp = $_POST['project_timestamp'];
    $description = $_POST['project_description'];
    
    $db = Database::getDb();
    $p = new Project();
    $projects = $p->updateProject($id, $name, $project_timestamp, $description, $db);
    
    if($count){
        header('Location:  projects-overview.php');
    } else {
        echo "problem";
    }

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
                    <input type="hidden" name="id" value="<?= $id; ?>" />
                        <div class="form-group row mb-3">
                            <label class="col-sm-3 col-form-label" for="project_name">Project Name</label>
                            <input class="col-sm-9" type="text" name="project_name" id="project_name" value="<?= $name; ?>" placeholder="Please type your project name">
                            <span style="color:red;"><?= isset($projectNameErr) ? $projectNameErr : ''; ?></span>
                        </div>


                        <div class="form-group row mb-3">
                            <label class="col-sm-3 col-form-label" for="project_timestamp">Start Date</label>
                            <input class="col-sm-9" type="date" name="project_timestamp" id="project_timestamp" value="<?= $date ?>" placeholder="Please select the project's start date">
                            <span style="color:red;"><?= isset($projectTimestampErr) ? $projectTimestampErr : ''; ?></span>
                        </div>

                        <div class="form-group row mb-3">
                            <div class="label"><label class="col-form-label" for="Description">Project Description</label>
                                <textarea class="form-control" name="project_description" id="project_description" rows="6" placeholder="Please provide the details of the project"><?= $description ?></textarea>
                                <span style="color:red;"><?= isset($projectDescErr) ? $projectDescErr : ''; ?></span>
                            </div>


                            <div class="form-group row mb-3">
                                <label class="col-sm-3 col-form-label" for="member">Member(s)</label>
                                <input class="col-sm-9" type="" name="member[]" id="member[]" placeholder="Please Select your member">
                                <span style="color:red;"><?= isset($members_err) ? $members_err : ''; ?></span>
                            </div>

                            <div class="form-group my-5 text-center">
                                <div>
                                    <input type="submit" name ="updProject" class="btn btn-primary btn-lg" value="Update Project" >
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
