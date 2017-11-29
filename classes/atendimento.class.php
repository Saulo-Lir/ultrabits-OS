<?php
require 'conexao.php';

class Atendimento{

  public function addAtendimento($idUsuario, $idServico, $descricao){
    global $pdo;

    $sql = $pdo->prepare("INSERT INTO atendimentos SET id_usuario = :id_usuario,
    id_servico = :id_servico, descricao = :descricao");

    $sql->bindValue(':id_usuario', $idUsuario);
    $sql->bindValue(':id_servico', $idServico);
    $sql->bindValue(':descricao', $descricao);
    $sql->execute();
  }

}

?>
