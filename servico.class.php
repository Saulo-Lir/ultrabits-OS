<?php
    class Servico{
        private $db;
        
        public function __construct(){
            
            try{
                $this->db = new PDO('mysql:dbname=ultrabits;host=localhost','root','');
                
            }catch(PDOException $ex){
                echo 'Erro de conexão: '.$ex->getMessage();
            }
        }
        // INSERT
        public function inserirOS($email,$empresa,$tipo, $categoria,$descricao){
            $sql = $this->db->prepare("INSERT INTO servicos SET email = :email, empresa = :empresa,
                    data_hora = NOW(), tipo = :tipo, categoria = :categoria, descricao = :descricao");
            
            $sql->bindValue(':email',$email);
            $sql->bindValue(':empresa',$empresa);
            $sql->bindValue(':tipo',$tipo);
            $sql->bindValue(':categoria',$categoria);
            $sql->bindValue(':descricao',$descricao);
            $sql->execute();   
        }
        
        public function inserirAnexos($idServico,$anexos){
            $sql = $this->db->prepare("INSERT INTO anexos SET id_servico = :idServico, nome = :anexos");
            $sql->bindValue(':idServico',$idServico);
            $sql->bindValue(':anexos',$anexos);
            $sql->execute();
        }
        
        public function selecionaOS(){
            $sql = $this->db->prepare("SELECT * FROM servicos ORDER BY id DESC");
            $sql->execute();
            
            if($sql->rowCount() > 0){
                $array = $sql->fetchAll();
            }
            return $array;
        }
        
        public function selecionaOsPeloId($id){
            $sql = $this->db->prepare("SELECT * FROM servicos WHERE id= :id");
            $sql->bindValue(':id',$id);
            $sql->execute();
            
            if($sql->rowCount() > 0){
                $array = $sql->fetch();
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