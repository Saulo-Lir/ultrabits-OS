<?php
  require 'cabecalho.php';
  require 'classes/servico.class.php';
  require 'classes/categoria.class.php';
  require 'classes/tipo.class.php';

  if(empty($_SESSION['login'])){
  ?>
    <script type='text/javascript'>window.location.href='index.php';</script>
  <?php
  exit;
  }

  if(isset($_GET['id']) && !empty($_GET['id'])){
      $id = addslashes($_GET['id']);

  }else{
      header('Location: minhas-os.php');
  }

  $s = new Servico();
  $servico = $s->getResumoOS($id);

  $c = new Categoria();
  $categorias = $c->getCategorias();

  $t = new Tipo();
  $tipos = $t->getTipos();


  if(isset($_POST['descricao']) && !empty($_POST['descricao'])){
    $tipo = addslashes($_POST['tipo']);
    $categoria = addslashes($_POST['categoria']);
    $descricao = addslashes($_POST['descricao']);

    if(isset($_FILES['anexos'])){
      $anexos = $_FILES['anexos'];
    }else{
      $anexos = array();
    }

    $s->editaOS($tipo, $categoria, $descricao, $id);
?>
    <div class='alert alert-success'>
      Ordem de Serviço atualizada com sucesso!
    </div>

<?php
  }

?>

<div class='container'>
  <div class='panel panel-default'>
    <div class='panel-heading'><h3>Editar OS</h3></div>
    <div class='panel-body'>

      <form method='POST'>

        <div class='form-group'>
            <label for='tipo'>Tipo</label>
            <select name='tipo' id='tipo' class='form-control'>

            <?php foreach($tipos as $tipo) { ?>
                <option value='<?=$tipo['id']?>' <?= ($tipo['id'] == $servico['tipo'])?'selected="selected"':''?>>
                  <?=$tipo['nome']?>
                </option>
            <?php } ?>

            </select>
        </div>

        <div class='form-group'>
            <label for='categoria'>Categoria</label>
            <select name='categoria' id='categoria' class='form-control'>

            <?php foreach($categorias as $categoria){ ?>
                <option value='<?=$categoria['id']?>' <?= ($categoria['id'] == $servico['categoria'])?'selected="selected"':'' ?>>
                  <?=$categoria['nome']?>
                </option>
            <?php } ?>

            </select>
        </div>

        <div class='form-group'>
            <label for='descricao'>Descrição</label>
            <textarea name='descricao' id='descricao' rows='5' class='form-control'>
              <?=$servico['descricao']?>
            </textarea>
        </div>

        <div class='form-group'>
          <label for='anexos'>Anexos</label>
          <input type='file' name='anexos[]' multiple id='anexos' class='form-control'>
          <br/><br/>
          <div class='panel-default'>
            <div class='panel-heading'><h3>Anexos</h3></div>
            <div class='panel-body'>

              <?php
                foreach($servico['anexos'] as $anexo){
              ?>
                <div class='estilo-anexos'>

                  <a href='javascript:;' class='galeria'>
                    <img src='assets/anexos/<?=$anexo['nome']?>' class='img-thumbnail'/>
                  </a>

                </div>
              <?php
                  }
              ?>

              <!-- Efeito fadeIn / fadeOut -->
              <div class='bgbox'></div> <!-- Background transparente -->

              <div class='fotobox'>
                <img src='' width='100%' />
              </div>

            </div>
          </div>
        </div>

        <div class='form-group'>
          <input type='submit' value='Atualizar Dados' class='btn btn-default'>
        </div>

      </form>

    </div>
  </div>
</div>

<?php
  require 'rodape.php';
?>
