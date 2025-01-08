<?php
include_once('../../classes/User.php');
include_once('../../classes/Visiteur.php');
session_start();
session_unset();
session_destroy();
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
                        header("Location: VisiteurDash.php?id=" . urlencode($user["id_user"]));
                        break;
                    case 'auteur':
                        header("Location: AuteurDash.php?id=" . urlencode($user["id_user"]));
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
            $email = $_POST['email'];
            $password = $_POST['password'];
            $prenom = $_POST['prenom'];
            $nom = $_POST['nom'];
            $role = $_POST['role'];

            if (!$email || !$password) {
                echo "Veuillez entrer un email valide et un mot de passe.";
                break;
            }

            if ($_POST['role'] === "auteur") {
                $isRegistered = Visiteur::register($nom, $prenom, $email, $password, 'auteur');
            } else if ($_POST['role'] === "visiteur") {
                $isRegistered = Visiteur::register($nom, $prenom, $email, $password, 'visiteur');
            }

            if ($isRegistered) {
                // Envoi de l'email
                $to = $email;
                $subject = "Bienvenue sur notre plateforme";
                $message = "Bonjour,\n\nVotre inscription a été réussie ! Vous avez maintenant le rôle de visiteur.\n\nCordialement,\nL'équipe.";
                $headers = "From: amoudiri@gmail.com";

                if (mail($to, $subject, $message, $headers)) {
                    echo "Inscription réussie. Un email vous a été envoyé.";
                } else {
                    echo "Inscription réussie. Échec de l'envoi de l'email.";
                }

                header("Location: VisiteurDash.php");
            } else {
                echo "Échec de l'inscription. Veuillez réessayer.";
            }
            break;


        default:
            include_once __DIR__ . "/views/login.php";
            break;
    }
} else {
    include_once __DIR__ . "/login.php";
}
exit;
