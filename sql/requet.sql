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

select * from Categorie;
-- categorie

CREATE TABLE Categorie (
    id_categorie INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(50) NOT NULL
);

SET foreign_key_checks = 0;
TRUNCATE TABLE Categorie;
SET foreign_key_checks = 1;


INSERT INTO Categorie (nom, description)
VALUES
    ('Programmation', 'Apprentissage des langages de programmation et des concepts de base de la programmation informatique'),
    ('Sécurité Informatique', 'Formation sur la protection des systèmes informatiques contre les attaques et les menaces'),
    ('Développement Web', 'Création de sites web et d’applications en utilisant des technologies web modernes'),
    ('Bases de Données', 'Gestion des données à l’aide des systèmes de gestion de bases de données relationnelles et non relationnelles'),
    ('JavaScript', 'Apprentissage du langage de programmation JavaScript pour le développement web dynamique'),
    ('Technologies Emergentes', 'Étude des nouvelles technologies et des tendances dans le domaine de l’informatique');



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
    FOREIGN KEY (id_categorie) REFERENCES Categorie(id_categorie) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (id_auteur) REFERENCES User(id_user) ON DELETE CASCADE ON UPDATE CASCADE
);
INSERT INTO Article (titre, content, datePublication, image, etat, id_categorie, id_auteur)
VALUES
    ('Introduction à la Programmation', 'Cet article explore les bases de la programmation.', '2025-01-01', 'programming_intro.jpg', 'Publié', 1, 2),
    ('L\'importance de la Sécurité Informatique', 'Découvrez pourquoi la sécurité est essentielle dans le monde numérique.', '2025-01-02', 'cybersecurity.jpg', 'Publié', 2, 3),
    ('Guide Complet sur le PHP', 'Un guide détaillé pour apprendre PHP de zéro.', '2025-01-03', 'php_guide.jpg', 'En attente', 3, 1),
    ('Les Tendances du Web en 2025', 'Les nouveautés et les tendances dans le domaine du développement web.', '2025-01-04', 'web_trends.jpg', 'Publié', 4, 2),
    ('Bases de Données Modernes', 'Une introduction aux bases de données relationnelles et NoSQL.', '2025-01-05', 'databases.jpg', 'En attente', 5, 3),
    ('Les Meilleurs Frameworks en JavaScript', 'Une analyse des frameworks JavaScript les plus populaires.', '2025-01-06', 'js_frameworks.jpg', 'Publié', 1, 2);

SELECT * FROM Article WHERE etat = 'En attente';



