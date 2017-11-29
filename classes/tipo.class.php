<?php
require './conexao.php';

  class Tipo{

    public function getTipos(){
      global $pdo;
      $array = array();

      $sql = "SELECT * FROM tipo";
      $sql = $pdo->query($sql);

      if($sql->rowCount() > 0){
        $array = $sql->fetchAll();
      }

      return $array;
    }

  }

?>
