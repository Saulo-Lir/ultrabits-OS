-- TABELA servicos --

create table servicos(

    id int unsigned not null AUTO_INCREMENT primary key,
    email varchar(100) not null,
    empresa varchar(100) not null,
    data_operacao datetime not null,    
    tipo varchar(20) not null,
    categoria varchar(100) not null,
    descricao text,
    status tinyint(2)
)


-- TABELA anexos --

create table anexos(
    id int unsigned not null auto_increment primary key,
    id_servico int,
    nome varchar(100) not null
)

-- TABELA usuarios --

create table usuarios(
    id int unsigned not null auto_increment primary key,
    email varchar(100) not null,
    senha varchar(32) not null
)
