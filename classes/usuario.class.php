<?php
require './conexao.php';

class Usuario{

    public function login($email, $senha){
      global $pdo;

      $sql = $pdo->prepare("SELECT id FROM usuarios WHERE email = :email AND senha = :senha");
      $sql->bindValue(':email', $email);
      $sql->bindValue(':senha', $senha);
      $sql->execute();

      if($sql->rowCount() > 0){
        $id = $sql->fetch();
        $_SESSION['login'] = $id['id'];

        return true;
      }else {
        return false;
      }

    }

    public function cadastraUsuario($nome, $email, $empresa, $senha){
      global $pdo;

      $sql = "SELECT id FROM usuarios WHERE email = :email";
      $sql = $pdo->prepare($sql);
      $sql->bindValue(':email', $email);
      $sql->execute();

      if($sql->rowCount() == 0){
        $sql = "INSERT INTO usuarios SET nome = :nome, email = :email,
                empresa = :empresa, senha = :senha";
        $sql = $pdo->prepare($sql);
        $sql->bindValue(':nome', $nome);
        $sql->bindValue(':email', $email);
        $sql->bindValue(':empresa', $empresa);
        $sql->bindValue(':senha', md5($senha));
        $sql->execute();

        return true;

      }else {
        return false;
      }

    }

    public function getUsuario($id){
      global $pdo;
      $array = array();

      $sql = "SELECT * FROM usuarios WHERE id = :id";
      $sql = $pdo->prepare($sql);
      $sql->bindValue(':id', $id);
      $sql->execute();

      if($sql->rowCount() > 0){
        $array = $sql->fetch();
      }

      return $array;
    }

    public function atualizaPerfil($nome, $email, $empresa, $senha, $id){
      global $pdo;

      $sql = "UPDATE usuarios SET nome = :nome, email = :email,
              empresa = :empresa, senha = :senha WHERE id = :id";
      $sql = $pdo->prepare($sql);
      $sql->bindValue(':nome', $nome);
      $sql->bindValue(':email', $email);
      $sql->bindValue(':empresa', $empresa);
      $sql->bindValue(':senha', md5($senha));
      $sql->execute();
    }

  }
?>
