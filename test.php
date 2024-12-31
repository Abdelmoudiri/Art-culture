<?php

include './classes/User.php';
include './classes/Admin.php';


// $pass = password_hash("ahmed",PASSWORD_BCRYPT);

$u=new User("ahmed","sari","ahmed@gmail.com","ahmed");

$us=User::login("ahmed@gmail.com","ahmed");
echo $us;
var_dump($us);
