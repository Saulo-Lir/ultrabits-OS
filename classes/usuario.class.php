<?php

class Usuario{
  private $db;

  public function __construct(){

    try{
        $this->db = new PDO('mysql:dbname=ultrabits;host=localhost;charset=utf8','root','');
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    }catch(PDOException $ex){
        echo 'Erro de conexão: '.$ex->getMessage();
    }
  }

    public function login($usuario, $senha){

      $sql = $this->db->prepare("SELECT id FROM usuarios WHERE email = :email AND senha = :senha");
      $sql->bindValue(':email', $usuario);
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
  }
?>
