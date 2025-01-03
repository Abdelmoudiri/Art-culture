-- Active: 1733407253980@@127.0.0.1@3306@art_culture
CREATE DATABASE art_culture;
drop DATABASE art_culture;
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

insert into User(firstname,lastname,email,role,password) VALUES
("abdeljabbar","moudiri","amoudiri@gmail.com","admin","moudiri"),
("ahmed","sari","ahmed@gmail.com","auteur","ahmed"),
("salma","salamat","salma@gmail.com","visiteur","salma");

select * from User;
-- categorie

CREATE TABLE Categorie (
    id_categorie INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(50) NOT NULL,
    description text NOT NULL
);
drop Table categorie;

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
    datePublication DATETIME DEFAULT CURRENT_TIMESTAMP,
    image VARCHAR(255) DEFAULT 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSlSjpT0YPXyFzHpBKIPoedcq1J-G-9c25Jxw&s',
    etat VARCHAR(20) DEFAULT 'En attente',
    id_categorie INT,
    id_auteur INT,
    FOREIGN KEY (id_categorie) REFERENCES Categorie(id_categorie)
        ON DELETE CASCADE 
        ON UPDATE CASCADE,
    FOREIGN KEY (id_auteur) REFERENCES User(id_user)
        ON DELETE CASCADE 
        ON UPDATE CASCADE
);

SELECT * FROM Article WHERE id_auteur = 2;
INSERT INTO Article (titre, content, id_categorie, id_auteur) 
VALUES 
    ('Article 1', 'Contenu de l\'article 1 : Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce sit amet quam ut lorem laoreet fermentum a in erat. Integer auctor sem ut velit tincidunt, vitae cursus neque tincidunt. Sed lacinia lectus vitae magna convallis, vel tincidunt lorem fringilla. Fusce tempus tortor ut leo accumsan, nec facilisis nulla volutpat. Nullam cursus lectus felis, et tristique felis posuere vel. Suspendisse potenti. Curabitur viverra ipsum quis nisi malesuada pharetra.', 1, 2),
    ('Article 2', 'Contenu de l\'article 2 : Pellentesque euismod orci id mauris consequat, id euismod turpis dignissim. Fusce imperdiet, sapien ut vehicula tempor, erat orci vehicula magna, ac ullamcorper ante justo et erat. Integer sagittis, nisi nec interdum auctor, turpis risus tincidunt odio, id rutrum ligula ante a tortor. Morbi aliquet, risus et varius convallis, elit ligula volutpat risus, at lobortis ex libero sed purus. Nulla facilisi. Sed lacinia neque non nisl tristique, at sollicitudin ligula tempor.', 2, 2),
    ('Article 3', 'Contenu de l\'article 3 : Nulla at diam non velit maximus auctor. Integer tincidunt, odio ac cursus suscipit, sem metus vulputate lorem, ac ullamcorper dui felis et turpis. Sed pellentesque leo nisi, ut pharetra nisl maximus ac. Curabitur vestibulum eros ac ligula facilisis, ut auctor metus posuere. Proin eget augue nec ante viverra condimentum. Etiam bibendum auctor lectus ut sollicitudin. Mauris tristique arcu vel odio tristique, a iaculis arcu sodales.', 3, 2),
    ('Article 4', 'Contenu de l\'article 4 : Aliquam erat volutpat. Cras a risus nec metus luctus porttitor vel eu nulla. Integer ut libero ut nulla auctor tincidunt a in lorem. Sed vel eros a orci elementum dapibus. Suspendisse tincidunt ligula id ex scelerisque, sit amet auctor sem consequat. Nulla eget felis et magna convallis lacinia. Curabitur at sollicitudin metus. Donec non magna fringilla, dignissim leo ac, posuere velit.', 1, 2),
    ('Article 5', 'Contenu de l\'article 5 : Vivamus sed orci in erat interdum tincidunt. Fusce auctor dolor ac dui cursus, eget cursus libero tincidunt. Cras gravida metus in nunc efficitur, et tempor leo tincidunt. Nam vitae dui vel mi cursus maximus. Donec cursus varius felis, at tincidunt justo congue a. Sed viverra, arcu id sollicitudin placerat, orci augue luctus purus, ut elementum neque urna a eros. Fusce malesuada, arcu in tristique tincidunt, erat purus condimentum arcu.', 2, 2),
    ('Article 6', 'Contenu de l\'article 6 : Donec posuere lobortis gravida. Fusce vel vestibulum nisi. Sed ac nunc scelerisque, auctor sem nec, feugiat turpis. Nam nec lectus et nulla ullamcorper mollis. Phasellus lacinia, libero id gravida vestibulum, elit est euismod nisi, id scelerisque risus nunc sed neque. Vivamus ac sollicitudin elit. Nulla facilisi. Mauris faucibus justo at eros auctor, in iaculis ex dignissim.', 3, 2),
    ('Article 7', 'Contenu de l\'article 7 : Curabitur ullamcorper mi eu arcu varius, et tincidunt nulla ullamcorper. Integer ac enim sit amet velit auctor tincidunt. Aenean vulputate, leo ac volutpat maximus, sem leo lacinia ipsum, at facilisis ante urna vel felis. Sed cursus maximus mi, sit amet tristique nunc dignissim sed. Morbi mollis metus vitae sapien iaculis, ac scelerisque arcu tincidunt. Nam sit amet nisi ac metus varius scelerisque.', 1, 2),
    ('Article 8', 'Contenu de l\'article 8 : Nam ac urna nisi. Phasellus euismod purus ac sem vulputate, nec posuere erat lacinia. Integer nec nisl at ipsum accumsan tincidunt. Fusce tincidunt sit amet justo eget tempus. Aenean gravida nisi sit amet bibendum tincidunt. Proin tristique mi in tincidunt viverra. Nam volutpat, augue sit amet mollis mollis, elit nulla consectetur erat, at pretium ligula nulla at purus. Sed ut neque purus.', 2, 2),
    ('Article 9', 'Contenu de l\'article 9 : Duis iaculis lacus non augue dictum sollicitudin. Proin facilisis augue id urna placerat, at aliquam felis viverra. Etiam placerat, urna a fringilla luctus, mi leo pharetra ipsum, eu feugiat risus eros non lorem. Nullam at nunc vel lacus volutpat venenatis. Ut ut sollicitudin erat. Nulla feugiat erat ac tortor feugiat, id volutpat nisi rhoncus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae.', 3, 2),
    ('Article 10', 'Contenu de l\'article 10 : Ut dictum lacus a bibendum vehicula. Fusce condimentum, nisl eu fermentum lacinia, enim velit tristique lorem, ac vulputate turpis urna in velit. Integer non risus at eros consequat tempor non sit amet nisi. Curabitur feugiat odio et risus gravida, ac fermentum ipsum ultricies. Maecenas consequat tortor in mauris iaculis, ut sodales arcu facilisis. Vivamus sagittis felis nec turpis aliquet malesuada. Nam volutpat suscipit sem ac consequat.', 1, 2);

SELECT * FROM Article WHERE etat = 'En attente';

SELECT * FROM Article ;
SELECT * FROM categorie ;
SELECT * FROM `user` ;


SELECT u.* FROM Article a JOIN User u on a.id_auteur=u.id_user GROUP BY u.firstname ;



