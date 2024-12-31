-- Active: 1733407253980@@127.0.0.1@3306@art_culture
CREATE DATABASE art_culture;
use art_culture;

-- Table des utilisateurs 

CREATE TABLE User (
    id_user INT AUTO_INCREMENT PRIMARY KEY,
    firstname VARCHAR(50),
    lastname VARCHAR(50),
    email VARCHAR(100) UNIQUE,
    role VARCHAR(20) DEFAULT 'visiteur',
    password VARCHAR(255),
    date_created TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    is_deleted BOOLEAN DEFAULT false
);

insert into `user`(firstname,lastname,email,role,password) VALUES
("abdeljabbar","moudiri","amoudiri@gmail.com","admin","moudiri"),
("ahmed","sari","ahmed@gmail.com","auteur","ahmed"),
("salma","salamat","salma@gmail.com","visiteur","salma");

select * from User;
-- categorie

CREATE TABLE Categorie (
    id_categorie INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(50) NOT NULL
);

-- article
CREATE TABLE Article (
    id_article INT AUTO_INCREMENT PRIMARY KEY,
    titre VARCHAR(100) NOT NULL,
    content TEXT NOT NULL,
    datePublication DATE,
    image VARCHAR(255),
    etat VARCHAR(20) DEFAULT 'En attente',
    id_categorie INT,
    id_auteur INT,
    FOREIGN KEY (id_categorie) REFERENCES Categorie(id_categorie),
    FOREIGN KEY (id_auteur) REFERENCES User(id_user)
);



