create database base_iaitogo;
use base_iaitogo;

CREATE TABLE exercice(
    id int AUTO_INCREMENT PRIMARY key,
    titre varchar(60),
    auteur varchar(60),
    date_creation date
    );
