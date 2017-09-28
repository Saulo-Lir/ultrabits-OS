<?php
    require 'servico.class.php';

    if(isset($_GET['id']) && !empty($_GET['id'])){
        $id = addslashes($_GET['id']);
    
    }else{
        header('Location: acompanhar.php');
    }

    $os = new Servico();
    
    $os->deletaOS($id);
    
    header('Location: acompanhar.php');

?>
