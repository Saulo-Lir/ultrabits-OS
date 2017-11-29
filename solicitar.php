<?php
require 'cabecalho.php';
require 'classes/servico.class.php';
require 'classes/categoria.class.php';
require 'classes/tipo.class.php';
require 'classes/usuario.class.php';

if(empty($_SESSION['login'])){
?>
  <script type='text/javascript'>window.location.href='index.php';</script>
<?php
exit;
}

$u = new Usuario();
$usuario = $u->getUsuario($_SESSION['login']);

$c = new Categoria();
$categorias = $c->getCategorias();

$t = new Tipo();
$tipos = $t->getTipos();


if(isset($_POST['descricao']) && !empty($_POST['descricao'])){
    $idUsuario = $_SESSION['login'];
    $idTipo = addslashes($_POST['tipo']);
    $idCategoria = addslashes($_POST['categoria']);
    $descricao = addslashes($_POST['descricao']);
    $status = 1;

if(isset($_FILES['anexos'])){
  $anexos = $_FILES['anexos'];
}else {
  $anexos = array();
}
    $servico = new Servico();
    $servico->inserirOS($idUsuario,$idTipo,$idCategoria,$descricao,$status,$anexos);
?>
  <div class='alert alert-success'>Solicitação enviada com sucesso!</div>

<?php
}
?>
    <div class='container-fluid'>
        <div class='row'>

          <?php require 'menu.php';?>

          <div class='col-sm-9'>

            <div class='panel panel-default'>
              <div class='panel-heading'><h3>Dados do Solicitante</h3></div>
              <div class='panel-body'>

              <h4><strong>Usuário:</strong><?=' '.$usuario['nome']?></h4>
              <h4><strong>E-mail:</strong><?=' '.$usuario['email']?></h4>
              <h4><strong>Empresa:</strong><?=' '.$usuario['empresa']?></h4>

              </div>
            </div>

            <div class='panel panel-default'>
              <div class='panel-heading'><h3>Ordem de Serviço</h3></div>
              <div class='panel-body'>

              <form method="POST" enctype="multipart/form-data">

                  <div class='form-group'>
                      <label for='tipo'>Tipo</label>
                      <select name='tipo' id='tipo' class='form-control'>

                      <?php foreach($tipos as $tipo) { ?>
                          <option value='<?=$tipo['id']?>'><?=$tipo['nome']?></option>
                      <?php } ?>

                      </select>
                  </div>

                  <div class='form-group'>
                      <label for='categoria'>Categoria</label>
                      <select name='categoria' id='categoria' class='form-control'>

                      <?php foreach($categorias as $categoria){ ?>
                          <option value='<?=$categoria['id']?>'><?=$categoria['nome']?></option>
                      <?php } ?>

                      </select>
                  </div>

                  <div class='form-group'>
                      <label for='descricao'>Descrição</label>
                      <textarea name='descricao' id='descricao' rows='5' class='form-control'></textarea>
                  </div>

                  <div class='form-group'>
                    <label for='anexos'>Anexos</label>
                    <input type='file' name='anexos[]' multiple id='anexos' class='form-control' />
                  </div>

                  <div class='form-group'>
                    <input type='submit' value='Solicitar' class='btn btn-default' />
                  </div>
              </form>

            </div>
          </div>
        </div>
      </div>
    </div>

<?php
    require "rodape.php";
?>
