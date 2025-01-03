<?php

include './classes/User.php';
include './classes/Admin.php';


// $pass = password_hash("ahmed",PASSWORD_BCRYPT);

// $u=new User("ahmed","sari","ahmed@gmail.com","ahmed","jjj");

// $us=User::login("ahmed@gmail.com","ahmed");
// echo $us;
// var_dump($us);

// ::://////////////////////////////////////////
// include_once __DIR__ . "/classes/User.php";
// include_once __DIR__ . "/classes/Auteur.php";
// include_once __DIR__ . "/classes/database.php";
// echo "<br> <br> <br> <br> hhh <br>";
// $auteur = new Auteur("Ahmed", "Sari", "ahmed@gmail.com", "ahmed", "auteur");

// $articles = $auteur->getArticles();

// $articles = $auteur->getArticles();
// var_dump($articles); 
$utilisateurs = Admin::getAllUtilisateur();
var_dump($utilisateurs);


?>
