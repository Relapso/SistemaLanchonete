create database Lanchonete;
use Lanchonete;

create table users(
    id int primary key auto_increment,
    nome varchar(50) not null,
    email varchar(50) not null,
    senha varchar(300) not null
);

create table lanches(
    id int primary key auto_increment,
    nome varchar(50) not null,
    preco decimal(6,2) not null,
    figura varchar(50) not null
);

CREATE TABLE pedidos (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome_cliente VARCHAR(50) NOT NULL,
    telefone VARCHAR(20) NOT NULL,
    endereco VARCHAR(100) NOT NULL,
    id_lanche INT NOT NULL,
    quantidade INT NOT NULL DEFAULT 1,
    FOREIGN KEY (id_lanche) REFERENCES lanches(id)
);

