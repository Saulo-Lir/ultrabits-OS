<?php
require 'cabecalho.php';
require 'servico.class.php';

$servicos = new Servico();

$query = $servicos->selecionaOS();

?>
    <table class='tabela' border='1'>
        <thead>
            <tr>
                <th>DATA</th>
                <th>EMPRESA</th>
                <th>EMAIL</th>
                <th>TIPO</th>
                <th>CATEGORIA</th>
                <th>DESCRIÇÃO</th>
                <th>STATUS</th>
                <th>AÇÕES</th>
            </tr>
        </thead>
        <tbody>
    <?php foreach($query as $servico){  ?>          
            <tr>
                <td><?=$servico['data_hora']?></td>
                <td><?=$servico['empresa']?></td>
                <td><?=$servico['email']?></td>
                <td><?=$servico['tipo']?></td>
                <td><?=$servico['categoria']?></td>
                <td><?=$servico['descricao']?></td>
                <td>...</td>
                <td>
                    <a href='atendimento.php'>
                       Atender
                    </a>
                    
                    <a href='edita.php?id=<?=$servico['id']?>'>
                       Editar
                    </a>
                    
                    <a href='deleta.php?id=<?=$servico['id']?>'>
                       Excluir
                    </a>
                </td>
            </tr>
    <?php        
        }
    ?>            
        </tbody>
    </table>

<?php
require "rodape.php";
?>