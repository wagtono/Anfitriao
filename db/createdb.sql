create database anfitriao;
use anfitriao;

CREATE TABLE IF NOT EXISTS `pessoa` (
`img` VARCHAR( 20 ) ,
`rg` VARCHAR( 7 ) UNIQUE ,
`cpf` VARCHAR( 15 ) UNIQUE ,
`nome` VARCHAR( 120 ) ,
`email` VARCHAR( 60 ) ,
`tel` VARCHAR( 15 ) ,
`sexo` VARCHAR( 10 ) ,
`id` INT( 200 ) AUTO_INCREMENT ,
UNIQUE (`id`)
);

CREATE TABLE IF NOT EXISTS `visitas` (
  `id` INT( 200 ) AUTO_INCREMENT ,
  UNIQUE (`id`), 
  id_pessoa INT NOT NULL,
  entrada DATETIME,
  saida DATETIME,
  status VARCHAR( 25) NOT NULL,
  PRIMARY KEY(id),
  INDEX(id),
  FOREIGN KEY (id_pessoa) REFERENCES pessoa(id)
); 

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `usuario` varchar(100) NOT NULL,
  `nome` VARCHAR( 120 ) NOT NULL,
  `senha` varchar(50) NOT NULL,
  `criado` DATETIME,
  PRIMARY KEY (`id`)
);

insert into usuarios ( usuario, nome, senha, criado ) values ('admin', 'Administrador do Sistema', 'admin', NOW() );
insert into pessoa (img, nome, email, sexo, rg, cpf, tel) values ( 'img/1.png', 'Visitante', 'visitante@mantenedor.com.br', 'Masculino', '0000000', '00000000000', '00 0000-0000000' );

