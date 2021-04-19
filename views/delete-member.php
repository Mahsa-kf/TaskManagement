<?php
require_once '../Model/ProjectOverview.php';
require_once '../Model/Role.php';
require_once '../Model/Project.php';
require_once '../Model/Member.php';
require_once '../Model/SideBar.php';
require_once '../Model/Database.php';
require_once '../Model/UpcomingDueDates.php';
require_once '../Model/Notifications.php';

require("./partials/footer.php");
require("./partials/header.php");
insertHeader();

if(isset($_POST['deleteMember'])) {
    //Extract DAta from url query and from members_table.php
    $project_id = $_POST['projectId'];
    $userID = $_POST['userid'];
    //$roleID = $_POST['roleid'];
    //var_dump($project_id,$roleID, $userID);
    var_dump($project_id, $userID);
    if (!empty( $userID && $project_id)) {
        $db = Database::getDb();

        $r = new Role();
        $roles = $r->getAllRoles($db);

        $p = new Project();
        $project_details = $p->getProjectById($project_id, $db);

        $m = new Member();
        $updateUsers = $m->deleteMembersInProjectUser($userID, $project_id, $db);


        header('Location:list-member.php?id=' . $_POST['projectId']);
    } else {
        echo "member is not delete";
    }
}
?>
