-- TABELA servicos --

create table servicos(

    id int unsigned not null AUTO_INCREMENT primary key,
    email varchar(100) not null,
    empresa varchar(100) not null,
    data_hora date not null,    
    tipo varchar(20) not null,
    categoria varchar(100) not null,
    descricao text
)


-- TABELA anexos --

create table anexos(

    id_servico int not null,
    nome varchar(32) not null
)
