<?php
    require 'classes/servico.class.php';

    if(isset($_GET['id']) && !empty($_GET['id'])){
        $id = addslashes($_GET['id']);

    }else{
        header('Location: minhas-os.php');
    }

    $servico = new Servico();

    $servico->deletaOS($id);

    header('Location: minhas-os.php');
?>
