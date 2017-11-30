<?php
  require 'cabecalho.php';
?>

<div class='container'>
  <div class='panel panel-default'>
    <div class='panel-heading'><h3>Perfil</h3></div>
  </div>
  <div class='panel-body'>
    <div class='row'>

      <div class='col-sm-3'>
        <div class='foto-perfil'>
          <img src='assets/imagens/user.png' class='img-thumbnail'/><br/>
          <a href='' class='btn btn-default'>Editar Foto</a>
        </div>
      </div>

      <div class='col-sm-9'>
        <h4>Nome:<strong><?=' '.$usuario['nome']?></strong></h4>
        <h4>E-mail:<strong><?=' '.$usuario['email']?></strong></h4>
        <h4>Empresa:<strong><?=' '.$usuario['empresa']?></strong></h4>
      </div>

    </div>
  </div>
</div>


<?php
  require 'rodape.php';
?>
