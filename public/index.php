<?php
include_once __DIR__ . "/classes/User.php";
include_once __DIR__ . "/classes/Admin.php";

if (isset($_GET['action'])) {
    $action = $_GET['action'];

    switch ($action) {
        case 'login':

            include_once __DIR__ . "/views/Admin.php";
            break;
        case 'register':
            include_once __DIR__ . "/views/login.php";
            break;
        default:
            include_once __DIR__ . "/views/VisiteurDashboard.php";
            break;
    }
} else {
    include_once __DIR__ . "/views/VisiteurDashboard.php";

}
exit; 
?>
