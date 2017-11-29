<?php

  try{
    global $pdo;

    $pdo = new PDO('mysql:dbname=ultrabits;host=localhost;charset=utf8','root','');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  }catch(PDOException $ex){
    echo 'Erro de conexão: '.$ex->getMessage();
    exit;
  }

?>
