<?php
    require 'cabecalho.php';
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
                <div class='jumbotron'>
                    <img src='assets/imagens/logo.png' width='900'/>
                </div>
            </div>
        </div>
    </div>
<?php
    require 'rodape.php';
?>
