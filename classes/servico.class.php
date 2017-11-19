<?php

  class Servico{
      private $db;

      public function __construct(){

          try{
              $this->db = new PDO('mysql:dbname=ultrabits;host=localhost;charset=utf8','root','');
              $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

          }catch(PDOException $ex){
              echo 'Erro de conexão: '.$ex->getMessage();
          }
      }

      public function inserirOS($email,$empresa,$tipo,$categoria,$descricao,$status,$anexos){

          $sql = $this->db->prepare("INSERT INTO servicos SET email = :email, empresa = :empresa,
                  data_operacao = NOW(), tipo = :tipo, categoria = :categoria, descricao = :descricao, status = :status");

          $sql->bindValue(':email',$email);
          $sql->bindValue(':empresa',$empresa);
          $sql->bindValue(':tipo',$tipo);
          $sql->bindValue(':categoria',$categoria);
          $sql->bindValue(':descricao',$descricao);
          $sql->bindValue(':status',$status);
          $sql->execute();

          // Selecionar id do último serviço adicionado
          $sql = "SELECT id FROM servicos ORDER BY id DESC LIMIT 1";
          $sql = $this->db->query($sql);

          $array = array();

          if($sql->rowCount() > 0){
            $array = $sql->fetch();
          }

          $id = $array['id'];

          // Inserir anexos
          if(count($anexos) > 0){
              for($i=0;$i<count($anexos['tmp_name']);$i++){
                  $tipo = $anexos['type'][$i];

                  if(in_array($tipo, array('image/jpeg','image/png'))){
                      $nomeAnexo = md5(time().rand(0, 9999)).'.jpg';
                      move_uploaded_file($anexos['tmp_name'][$i],'assets/anexos/'.$nomeAnexo);

                      /* Redimensionar as fotos e salvar no repositório local */

                      list($width_orig, $height_orig) = getimagesize('assets/anexos/'.$nomeAnexo);
                      $ratio = $width_orig / $height_orig;

                      $width = 500;
                      $height = 500;

                      if($width / $height > $ratio){
                        $width = $height * $ratio;
                      }else {
                        $height = $width / $ratio;
                      }

                      $img = imagecreatetruecolor($width, $height);

                      if($tipo == 'image/jpeg'){
                        $origi = imagecreatefromjpeg('assets/anexos/'.$nomeAnexo);
                      }elseif($tipo == 'image/png'){
                        $origi = imagecreatefrompng('assets/anexos/'.$nomeAnexo);
                      }

                      imagecopyresampled($img, $origi, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);
                      imagejpeg($img, 'assets/anexos/'.$nomeAnexo, 80);

                      /* Redimensionar as fotos e salvar no repositório local */

                      $sql = "INSERT INTO anexos SET id_servico = :id_servico, nome = :nome";
                      $sql = $this->db->prepare($sql);
                      $sql->bindValue(':id_servico', $id);
                      $sql->bindValue(':nome', $nomeAnexo);
                      $sql->execute();
                  }
              }
          }
      }

      public function getListaOS(){
          $array = array();

          $sql = $this->db->prepare("SELECT * FROM servicos ORDER BY id DESC");
          $sql->execute();

          if($sql->rowCount() > 0){
              $array = $sql->fetchAll();
          }
          return $array;
      }

      public function getOS($id){
          $array = array();

          $sql = $this->db->prepare("SELECT * FROM servicos WHERE id= :id");
          $sql->bindValue(':id',$id);
          $sql->execute();

          if($sql->rowCount() > 0){
              $array = $sql->fetch();
              $array['anexos'] = array();

              $sql = $this->db->prepare("SELECT * FROM anexos WHERE id_servico = :id_servico");
              $sql->bindValue(':id_servico', $id);
              $sql->execute();

              if($sql->rowCount() > 0){
                $array['anexos'] = $sql->fetchAll();
              }
          }

          return $array;
      }

      public function editaOS($empresa,$email,$tipo,$categoria,$descricao,$id){
          $sql = $this->db->prepare("UPDATE servicos SET empresa= :empresa, data_hora = NOW(), email= :email, tipo= :tipo,
                                    categoria= :categoria, descricao= :descricao WHERE id= :id");

          $sql->bindValue(':empresa',$empresa);
          $sql->bindValue(':email',$email);
          $sql->bindValue(':tipo',$tipo);
          $sql->bindValue(':categoria',$categoria);
          $sql->bindValue(':descricao',$descricao);
          $sql->bindValue(':id',$id);
          $sql->execute();

      }

      public function deletaOS($id){
          $sql = $this->db->prepare("DELETE FROM servicos WHERE id= :id");
          $sql->bindValue(':id',$id);
          $sql->execute();
      }

  }


?>
