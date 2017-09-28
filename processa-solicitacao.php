<?php
    require 'servico.class.php';

if(isset($_POST['email']) && !empty($_POST['email'])){
    $email = addslashes($_POST['email']);
    $empresa = addslashes($_POST['empresa']);
    $tipo = addslashes($_POST['tipo']);
    $categoria = addslashes($_POST['categoria']); // Verificar como receber valores do select
    $descricao = addslashes($_POST['descricao']);   
    
    // Receber os anexos
    
    if(count($_FILES['anexos']['tmp_name']) > 0){ //Se a contagem de arquivos detro do array $_FILES for
                                                  //maior que zero, então pelo menos 1 arquivo foi enviado

        for($i=0;$i<count($_FILES['anexos']['tmp_name']);$i++){
            $nomeAnexo = md5(time());
            
            move_uploaded_file($_FILES['anexos']['tmp_name'][$i],'anexos/'.$nomeAnexo);
            // Envia os anexos para a pasta 'anexos/' com seus novos nomes
            // $nomeAnexo agora é um array contendo todos os nomes dos anexos
        }
    }
    
    $servico = new Servico();
    
    $servico->inserirOS($email,$empresa,$tipo,$categoria,$descricao);
    
    $query = $servico->selecionaOS(); //Armazena todos os serviços ordenados pelo último
    
    //Pegar o id do último serviço para adicionar como chave estrangeira na tabela anexos
       
    $idServico = array_shift($query); // Pega o primeiro elemento do array
    
    $servico->inserirAnexos($idServico['id'],$nomeAnexo); // Pesquisar como inserir em chave estrangeira
    
    echo 'Solicitação Enviada!';
    
}


?>
