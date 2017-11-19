<?php
require 'classes/servico.class.php';

if(isset($_POST['empresa']) && !empty($_POST['empresa'])){
    $empresa = addslashes($_POST['empresa']);
    $email = addslashes($_POST['email']);
    $tipo = addslashes($_POST['tipo']);
    $categoria = addslashes($_POST['categoria']);
    $descricao = addslashes($_POST['descricao']);
    $id = addslashes($_POST['id']);
    
    $os = new Servico();
    $os->editaOS($empresa,$email,$tipo,$categoria,$descricao,$id);
    
    header('Location: acompanhar.php');
    
}else{
    header('Location: acompanhar.php');
}

?>