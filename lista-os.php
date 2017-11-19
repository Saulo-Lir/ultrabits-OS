<?php
require 'cabecalho.php';
require 'classes/servico.class.php';

$servicos = new Servico();

$query = $servicos->getListaOS();

?>

<div class='container-fluid'>
        <div class='row'>
            <div class='col-sm-3'>
              <div class='panel panel-default'>
                <div class='panel-heading'><h3>Menu</h3></div>
                <div class='panel-body'>

                  <div class='botao' onclick="window.location.href='solicitar.php';">
                      Abrir OS
                  </div>

                  <div class='botao' onclick="window.location.href='lista-os.php';">
                      Listar
                  </div>

                  <div class='botao' onclick="window.location.href='';">
                      Minhas OS
                  </div>

                </div>
              </div>
            </div>

            <div class='col-sm-9'>

                <table class='table table-hover'>
        <thead>
            <tr>
                <th>DATA</th>
                <th>EMPRESA</th>
                <th>EMAIL</th>
                <th>TIPO</th>
                <th>CATEGORIA</th>
                <th>STATUS</th>
                <th>AÇÕES</th>
            </tr>
        </thead>
        <tbody>

    <?php

    $tipo = array(
      '1' => 'Remoto',
      '2' => 'Presencial'
    );

    $categoria = array(
      '1' => 'Manutenção de Computadores',
      '2' => 'Configuração',
      '3' => 'Instalação de Software',
      '4' => 'Roteadores / Modens / Switches',
      '5' => 'Formatação',
      '6' => 'Remoção de Vírus',
      '7' => 'Upgrade'
    );

      foreach($query as $servico){
        $t = $servico['tipo'];
        $c = $servico['categoria'];
    ?>
            <tr>
                <td><?=date('d/m/Y \à\s H:i:s', strtotime($servico['data_operacao']))?></td> <!-- Data formatada no padrão brasileiro -->
                <td><?=$servico['empresa']?></td>
                <td><?=$servico['email']?></td>
                <td><?= $tipo[$t] ?></td>
                <td><?= $categoria[$c] ?></td>
                <td class="<?= ($servico['status'] == 1)?'alert alert-danger':'alert alert-success'; ?>">
                  <?php
                    if($servico['status'] == 1){
                      echo 'PENDENTE';
                    }elseif($servico['status'] == 2) {
                      echo 'RESOLVIDO';
                    }
                  ?>
                </td>
                <td>
                    <a href='atendimento.php?id=<?=$servico['id']?>' class='btn btn-default'>Atender</a>
                </td>
            </tr>
    <?php
        }
    ?>
        </tbody>
    </table>

            </div>
        </div>
    </div>

<?php
    require "rodape.php";
?>
