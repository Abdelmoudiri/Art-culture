<?php
include_once('../../classes/User.php'); 

if (isset($_GET['action'])) {
    $action = $_GET['action'];

    switch ($action) {
        case 'login':
            $email = $_POST["email"];
            $password = $_POST["password"];
        
            if (!$email || !$password) {
                echo "Veuillez entrer un email valide et un mot de passe.";
                break;
            }
            $user = User::login($email, $password);
        
            if ($user) {
                switch ($user['role']) {
                    case 'admin':
                        header("Location: AdminDash.php?id=" . urlencode($user["id_user"]));
                        break;
                    case 'visiteur':
                        include_once __DIR__ . "/VisiteurDash.php";
                        break;
                    case 'auteur':
                        include_once __DIR__ . "/AuteurDash.php";
                        break;
                    default:
                        include_once __DIR__ . "/../views/Admin.php";
                        break;
                }
            } else {
                echo "Email ou mot de passe incorrect.";
            }
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
