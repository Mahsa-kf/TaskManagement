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

//Submit New Changes to DB
if (isset($_POST['Add'])) {
    //Extract DAta from url query and from members_table.php
    $id = $_POST['projectId'];
    $userID = $_POST['userid'];
    $roleID = ($_POST['roleid']);

    if (empty($roleID) || $roleID == "0") {
        $roles_err = "please select role for this member";
    } else {
        $roleID = ($_POST['roleid']);
    }

    if (!empty($userID && $id && $roleID) && $roleID != '0') {
        $db = Database::getDb();

        $r = new Role();
        $roles = $r->getAllRoles($db);

        $m = new Member();
        $addUsers = $m->addMembersInProjectUser($userID, $id, $roleID, $db);
        $p = new Project();
        $project_details = $p->getProjectById($id, $db);

        header('Location:list-member.php?id=' . $_POST['projectId']);
    }

}

?>
