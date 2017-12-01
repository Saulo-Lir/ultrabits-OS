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

if(isset($_GET['ordem']) && !empty($_GET['ordem'])){
  $ordem = addslashes($_GET['ordem']);
  $servicos = $s->getOrdenaOS($ordem);

}else {
  $servicos = $s->getListaOS();
}

?>

<div class='container-fluid'>
        <div class='row'>

            <?php require 'menu.php';?>

            <div class='col-sm-10'>
            <div class='panel panel-default'>
              <div class='panel-heading'><h3>Ordens de Serviço</h3></div>
              <div class='panel-body'>

              <form>
                <div class='form-group'>
                  <label for='filtro'>Filtro</label>
                  <select name='ordem' id='filtro' class='form-control' onchange='this.form.submit()'> <!-- onchange = Ao ser mudado o item, envia o formulário -->
                    <option></option>
                    <option value='1' >SOLICITANTE</option>
                    <option value='2' >EMPRESA</option>
                    <option value='3' >TIPO</option>
                    <option value='4' >CATEGORIA</option>
                    <option value='5' >DATA</option>
                  </select>
              </div>
              </form>
<?php
  if(!empty($servicos)){
?>
                <table class='table table-hover'>
        <thead>
            <tr>
                <th>SOLICITANTE</th>
                <th>EMAIL</th>
                <th>EMPRESA</th>
                <th>TIPO</th>
                <th>CATEGORIA</th>
                <th>DATA</th>
                <th>STATUS</th>
                <th>AÇÕES</th>
            </tr>
        </thead>
        <tbody>

    <?php
      foreach($servicos as $servico){
    ?>
            <tr>
                <td><?=$servico['usuario']?></td>
                <td><?=$servico['email']?></td>
                <td><?=$servico['empresa']?></td>
                <td><?=$servico['tipo']?></td>
                <td><?=$servico['categoria']?></td>
                <td><?=date('d/m/Y \à\s H:i:s', strtotime($servico['data_operacao']))?></td> <!-- Data formatada no padrão brasileiro -->
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
                    <a href='atende-os.php?id=<?=$servico['id']?>' class='btn btn-default'>Atender</a>
                </td>
            </tr>
    <?php
        }
    ?>
        </tbody>
    </table>

<?php
  }else {
?>
    <div class='jumbotron'>
      <h3>Ainda não existem solicitações cadastradas :( </h3>
    </div>

<?php
  }
?>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
    require "rodape.php";
?>
