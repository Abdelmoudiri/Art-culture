<?php
if (isset($_GET['action'])) {
    $action = $_GET['action'];

    switch ($action) {
        case 'login':
            header('Location: /views/login.php');
            break;
        case 'register':
            header('Location: /views/register.php');
            break;
        default:
            header('Location: ./index.php');
            break;
    }
} else {
    header('Location: ./index.php');
}
exit; 
?>
