<?php
require 'cabecalho.php';
require 'classes/servico.class.php';
require 'classes/usuario.class.php';
require 'classes/atendimento.class.php';

// Verificação de segurança

  if(isset($_GET['id']) && !empty($_GET['id'])){
    $id = addslashes($_GET['id']);
  } else{
?>
    <script type='text/javascript'>window.location.href='lista-os.php';</script>
<?php
  }

$s = new Servico();
$a = new Atendimento();
$u = new Usuario();

$usuario = $u->getUsuario($_SESSION['login']);

// Processamento da atendimento

  if(isset($_POST['descricao']) && !empty($_POST['descricao'])){
    $descricao = addslashes($_POST['descricao']);
    $status = 2;

    if(isset($_FILES['anexos'])){
      $anexos = $_FILES['anexos'];
    }else {
      $anexos = array();
    }

    $s->atualizaStatus($status,$id);
    $a->addAtendimento($_SESSION['login'], $id, $descricao);

    // Enviar mensagem por Email

    //Parâmetros de envio
    $para = 'saulo.l.nascimento@hotmail.com';
    $assunto = 'Ordem de Serviço No.: '.$id;
    $corpo = 'Técnico Responsável: '.$usuario['nome'].'<br/>'.
             'Email: '.$usuario['email'].'<br/>'.
             'Empresa: '.$usuario['empresa'].'<br/><br/>'.
             '####  Descrição do Atendimento #### '.'<br/><br/>'.
             $descricao;

    $cabecalho = 'From: ultrabits@gmail.com'.'\r\n'.
                 'Reply-To: '.$usuario['email'].'\r\n'.
                 'X-Mailer: PHP/'.phpversion();

    // Enviando o email
    mail($para, $assunto, $corpo, $cabecalho);

?>
    <div class='alert alert-success'>Atendimento efetuado com sucesso!</div>

<?php
  }
?>

<div class='container-fluid'>
  <div class='row'>
    <div class='col-sm-5'>
      <div class='panel panel-default'>

        <div class='panel panel-default'>
          <div class='panel-heading'><h3>Dados do Atendente</h3></div>
          <div class='panel-body'>

            <h4><strong>Usuário:</strong><?=' '.$usuario['nome']?></h4>
            <h4><strong>E-mail:</strong><?=' '.$usuario['email']?></h4>
            <h4><strong>Empresa:</strong><?=' '.$usuario['empresa']?></h4>

          </div>
        </div>

        <div class='panel-heading'><h3>Atendimento</h3></div>
        <div class='panel-body'>

          <form method='POST' enctype='multipart/form-data'>

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

  <?php
    $servico = $s->getOS($id);
  ?>

    <div class='jumbotron'>
      <h3>Ordem de Serviço <strong>N°.:<?=' '.$id?></strong></h3>
      <br/>
      <h4>Solicitante:<strong><?=' '.$servico['usuario']?></strong></h4>
      <h4>Email:<strong><?=' '.$servico['email']?></strong></h4>
      <h4>Empresa:<strong><?=' '.$servico['empresa']?></strong></h4>
      <h4>Tipo:<strong><?=' '.$servico['tipo']?></strong></h4>
      <h4>Categoria:<strong><?=' '.$servico['categoria']?></strong></h4>
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

        <!-- Efeito fadeIn / fadeOut -->
        <div class='bgbox'></div> <!-- Background transparente -->

        <div class='fotobox'>
          <img src='' width='100%' />
        </div>

      </div>

      </div>
    </div>

<?php
    require 'rodape.php';
?>
