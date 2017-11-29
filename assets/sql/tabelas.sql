-- TABELA servicos --

create table servicos(
    id int unsigned not null auto_increment primary key,
    id_usuario int,    
    id_tipo tinyint(2) not null,
    id_categoria tinyint(2) not null,
    data_operacao datetime not null,    
    descricao text,
    status tinyint(2)
)

-- TABELA tipo --

create table tipo(
    id int unsigned not null auto_increment primary key,
    nome varchar(100)
)

-- TABELA categoria --

create table categoria(
    id int unsigned not null auto_increment primary key,
    nome varchar(100)
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
    nome varchar(100) not null,
    email varchar(100) not null,
    empresa varchar(100) not null,
    senha varchar(32) not null,
    foto varchar(100)
)

-- TABELA atendimentos --

create table atendimentos(
    id int unsigned not null auto_increment primary key,
    id_usuario int,
    id_servico int,
    descricao text
)














