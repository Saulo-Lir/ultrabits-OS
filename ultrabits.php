<?php
    require 'cabecalho.php';

    if(empty($_SESSION['login'])){
?>
      <script type='text/javascript'>window.location.href='index.php';</script>
<?php
    exit;
    }
?>
    <div class='container-fluid'>
        <div class='row'>

            <?php require 'menu.php';?>

            <div class='col-sm-9'>
                <div class='jumbotron'>
                    <img src='assets/imagens/logo.png' width='900'/>
                </div>
            </div>
        </div>
    </div>
<?php
    require 'rodape.php';
?>
