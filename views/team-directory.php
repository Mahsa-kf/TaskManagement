<?php
// Start or resume a session
session_start();

require_once '../Model/ProjectOverview.php';
require_once '../Model/SideBar.php';
require_once '../Model/Database.php';
require_once '../Model/UpcomingDueDates.php';
require_once '../Model/Notifications.php';

require("./partials/header.php");
insertHeader();

?>
<main>

</main>
<?php
require("./partials/footer.php");
insertFooter();
?>