<?php
require './conexao.php';

  class Categoria{

    public function getCategorias(){
      global $pdo;
      $array = array();

      $sql = "SELECT * FROM categoria";
      $sql = $pdo->query($sql);

      if($sql->rowCount() > 0){
        $array = $sql->fetchAll();
      }

      return $array;
    }

  }

?>
