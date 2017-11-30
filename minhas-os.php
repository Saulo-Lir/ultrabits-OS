<?php
  require 'cabecalho.php';
  require 'classes/servico.class.php';

  if(empty($_SESSION['login'])){
  ?>
    <script type='text/javascript'>window.location.href='index.php';</script>
  <?php
  exit;
  }

  $s = new Servico();
  $servicos = $s->getMinhasOS($_SESSION['login']);

?>

<div class='container-fluid'>
  <div class='row'>

    <?php require 'menu.php'; ?>

    <div class='col-sm-10'>
      <div class='panel panel-default'>
        <div class='panel-heading'><h3>Minhas OS</h3></div>
        <div class='panel-body'>

          <table class='table table-hover'>
            <thead>
              <tr>
                <th>OS. N°</th>
                <th>TIPO</th>
                <th>CATEGORIA</th>
                <th>DATA</th>
                <th>STATUS</th>
                <th>AÇÕES</th>
              </tr>
            </thead>

            <tbody>

      <?php foreach($servicos as $servico){ ?>

              <tr>
                <td><?=$servico['id']?></td>
                <td><?=$servico['tipo']?></td>
                <td><?=$servico['categoria']?></td>
                <td><?=date('d/m/Y \à\s H:i:s', strtotime($servico['data_operacao']))?></td>
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
                  <a href='' class='btn btn-default'>Visualizar</a>
                  <a href='edita-os.php?id=<?=$servico['id']?>' class='btn btn-warning'>Editar</a>
                  <a href='deleta.php?id=<?=$servico['id']?>' class='btn btn-danger'>Excluir</a>
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
  </div>
</div>

<?php
  require 'rodape.php';
?>
