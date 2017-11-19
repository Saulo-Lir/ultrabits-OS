<?php
require 'cabecalho.php';
require 'classes/servico.class.php';

$s = new Servico();

  if(isset($_GET['id']) && !empty($_GET['id'])){
    $id = addslashes($_GET['id']);
  } else{
?>
    <script type='text/javascript'>window.location.href='acompanhar.php';</script>
<?php
  }

  $servico = $s->getOS($id);

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

  $t = $servico['tipo'];
  $c = $servico['categoria'];

?>

<div class='container-fluid'>
  <div class='row'>
    <div class='col-sm-5'>
      <div class='panel panel-default'>

        <div class='panel-heading'><h3>Atendimento</h3></div>
        <div class='panel-body'>

          <form method='POST' enctype='multipart/form-data'>
            <div class='form-group'>
              <label for='nome'>Nome</label>
              <input type='text' name='nome' id='nome' class='form-control' required/>
            </div>

            <div class='form-group'>
              <label for='empresa'>Empresa</label>
              <input type='text' name='empresa' id='empresa' class='form-control' required/>
            </div>

            <div class='form-group'>
              <label for='email'>Email</label>
              <input type='email' name='email' id='email' class='form-control' required/>
            </div>

            <div class='form-group'>
              <label for='tel'>Telefone</label>
              <input type='tel' name='tel' id='tel' class='form-control' required/>
            </div>

            <div class='form-group'>
              <label for='descricao'>Descrição do Atendimento</label>
              <textarea name='descricao' id='descricao' rows='5' class='form-control'></textarea>
            </div>

            <div class='form-group'>
              <label for='anexos'>Anexos</label>
              <input type='file' name='anexos[]' multiple id='anexos' class='form-control' />
            </div>

            <div class='form-group'>
              <input type='submit' value='Enviar' class='btn btn-default' />
            </div>

          </form>
        </div>

      </div>
  </div>

  <div class='col-sm-7'>

    <div class='jumbotron'>
      <h3>Ordem de Serviço <strong>N°.:<?=' '.$id?></strong></h3>
      <br/>
      <h4>Solicitante:<strong><?=' '.$servico['email']?></strong></h4>
      <h4>Empresa:<strong><?=' '.$servico['empresa']?></strong></h4>
      <h4>Categoria:<strong><?=' '.$categoria[$c]?></strong></h4>
      <h4>Tipo:<strong><?=' '.$tipo[$t]?></strong></h4>
      <h4>Solicitado em:<strong><?=' '.date('d/m/Y \à\s H:i:s', strtotime($servico['data_operacao']))?></strong></h4>
    </div>

    <div class='panel panel-default'>
      <div class='panel-heading'><h3>Descrição</h3></div>
      <div class='panel-body'>
        <h4><?=$servico['descricao']?></h4>
      </div>
    </div>

    <div class='panel panel-default'>
      <div class='panel-heading'><h3>Anexos</h3></div>
      <div class='panel-body'>
        <?php
          foreach($servico['anexos'] as $anexo){
        ?>
        <div class='estilo-anexos'>

          <a href='javascript:;' class='galeria'> <!-- javascript:; Não executa nada ao clicar no link -->
            <img src='assets/anexos/<?=$anexo['nome']?>' class='img-thumbnail'/>
          </a>

        </div>

        <?php
          }
        ?>

      </div>
    </div>



</div>

<!-- Efeito fadeIn / fadeOut -->
<div class='bgbox'></div> <!-- Background transparente -->

<div class='fotobox'>
  <img src='' width='100%' />
</div>

<?php
    require 'rodape.php';
?>
