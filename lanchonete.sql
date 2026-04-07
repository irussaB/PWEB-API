create database lanchonete;
use lanchonete;
create table usuarios
    (
        usuid int primary key auto_increment,
        usunome varchar(150),
        usulogin varchar(150),
        ususenha varchar(150),
        usulogado boolean default 0
    );
create table categorias
    (
        catid int primary key auto_increment,
        catnome varchar(150),
        catativo boolean default 1
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

INSERT INTO categorias(catnome)
VALUE
('Promoção do dia'),
('Lanches'),
('Porções'),
('Bebidas')
;