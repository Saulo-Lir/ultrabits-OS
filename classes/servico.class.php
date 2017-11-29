<?php
require './conexao.php';

  class Servico{

      public function inserirOS($idUsuario,$idTipo,$idCategoria,$descricao,$status,$anexos){
          global $pdo;

          $sql = $pdo->prepare("INSERT INTO servicos SET id_usuario = :id_usuario, id_tipo = :id_tipo,
            id_categoria = :id_categoria, data_operacao = NOW(), descricao = :descricao, status = :status");

          $sql->bindValue(':id_usuario',$idUsuario);
          $sql->bindValue(':id_tipo',$idTipo);
          $sql->bindValue(':id_categoria',$idCategoria);
          $sql->bindValue(':descricao',$descricao);
          $sql->bindValue(':status',$status);
          $sql->execute();

          // Selecionar id do último serviço adicionado
          $sql = "SELECT id FROM servicos ORDER BY id DESC LIMIT 1";
          $sql = $pdo->query($sql);

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
                      $sql = $pdo->prepare($sql);
                      $sql->bindValue(':id_servico', $id);
                      $sql->bindValue(':nome', $nomeAnexo);
                      $sql->execute();
                  }
              }
          }
      }

      public function atualizaStatus($status, $id){
        global $pdo;

        $sql = "UPDATE servicos SET status = :status WHERE id = :id";
        $sql = $pdo->prepare($sql);
        $sql->bindValue(':status', $status);
        $sql->bindValue(':id', $id);
        $sql->execute();

      }

      public function getListaOS(){
          global $pdo;
          $array = array();

          $sql = "SELECT usuarios.nome as usuario, usuarios.email, usuarios.empresa,
          tipo.nome as tipo, categoria.nome as categoria, servicos.id, servicos.data_operacao,
          servicos.descricao, servicos.status FROM servicos
          INNER JOIN usuarios ON usuarios.id = servicos.id_usuario
          INNER JOIN tipo ON tipo.id = servicos.id_tipo
          INNER JOIN categoria ON categoria.id = servicos.id_categoria
          ORDER BY servicos.id DESC";

          $sql = $pdo->query($sql);

          if($sql->rowCount() > 0){
              $array = $sql->fetchAll();
          }
          return $array;
      }

      public function getOS($id){
          global $pdo;
          $array = array();

          $sql = $pdo->prepare("SELECT usuarios.nome as usuario, usuarios.email, usuarios.empresa,
          tipo.nome as tipo, categoria.nome as categoria, servicos.id, servicos.data_operacao,
          servicos.descricao, servicos.status FROM servicos
          INNER JOIN usuarios ON usuarios.id = servicos.id_usuario
          INNER JOIN tipo ON tipo.id = servicos.id_tipo
          INNER JOIN categoria ON categoria.id = servicos.id_categoria
          WHERE servicos.id = :id");

          $sql->bindValue(':id',$id);
          $sql->execute();

          if($sql->rowCount() > 0){
              $array = $sql->fetch();
              $array['anexos'] = array();

              $sql = $pdo->prepare("SELECT * FROM anexos WHERE id_servico = :id_servico");
              $sql->bindValue(':id_servico', $id);
              $sql->execute();

              if($sql->rowCount() > 0){
                $array['anexos'] = $sql->fetchAll();
              }
          }

          return $array;
      }

      public function getMinhasOS($idUsuario){
        global $pdo;
        $array = array();

        $sql = $pdo->prepare("SELECT servicos.id, servicos.descricao, servicos.status,
          servicos.data_operacao, tipo.nome as tipo, categoria.nome as categoria from servicos
          INNER JOIN tipo ON tipo.id = servicos.id_tipo
          INNER JOIN categoria ON categoria.id = servicos.id_categoria
          WHERE servicos.id_usuario = :id_usuario");

        $sql->bindValue(':id_usuario', $idUsuario);
        $sql->execute();

        if($sql->rowCount() > 0){
          $array = $sql->fetchAll();
        }

        return $array;
      }

      public function editaOS($empresa,$email,$tipo,$categoria,$descricao,$id){
          global $pdo;

          $sql = $pdo->prepare("UPDATE servicos SET empresa= :empresa, data_hora = NOW(), email= :email, tipo= :tipo,
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
          global $pdo;

          $sql = $pdo->prepare("DELETE FROM servicos WHERE id= :id");
          $sql->bindValue(':id',$id);
          $sql->execute();
      }

  }


?>
