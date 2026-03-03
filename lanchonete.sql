create database lanchonete;
use lanchonete;
create table usuarios
    (
        usuid int primary key auto_increment,
        usunome varchar(100),
        usulogin varchar(100),
        ususenha varchar(100),
        usulogado boolean default 0
    );

INSERT INTO usuarios(usunome,usulogin,ususenha)
VALUE
('Pedro Henrique Barussi de Moraes','irussaB',MD5(19062008)),
('João Gabriel Leme Bernardina','JG',MD5(09012009)),
('João Pedro da Silva Souza','JP',MD5(19102008)),
('Pedro de Sales Santos','Salisson',MD5(16042008)),
('Leonardo Camargo Graminha','Grama',MD5(31122007)),
('Gabriel Pereira Alves','Biel',MD5(32102008))
;