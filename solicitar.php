<?php
require 'cabecalho.php';
require 'classes/servico.class.php';

if(isset($_POST['email']) && !empty($_POST['email'])){
    $email = addslashes($_POST['email']);
    $empresa = addslashes($_POST['empresa']);
    $tipo = addslashes($_POST['tipo']);
    $categoria = addslashes($_POST['categoria']);
    $descricao = addslashes($_POST['descricao']);
    $status = 1;

if(isset($_FILES['anexos'])){
  $anexos = $_FILES['anexos'];
}else {
  $anexos = array();
}
    $servico = new Servico();
    $servico->inserirOS($email,$empresa,$tipo,$categoria,$descricao,$status,$anexos);
?>
  <div class='alert alert-success'>Solicitação enviada com sucesso!</div>

<?php
}

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

                <h2>Ordem de Serviço</h2>
                <br/>

                <form method="POST" enctype="multipart/form-data">
                    <div class='form-group'>
                        <label for='email'>E-Mail</label>
                        <input type='email' name='email' id='email' class='form-control' required/>
                    </div>

                    <div class='form-group'>
                        <label for='empresa'>Empresa</label>
                        <input type='text' name='empresa' id='empresa' class='form-control' required/>
                    </div>

                    <div class='form-group'>
                        <label for='tipo'>Tipo</label>
                        <select name='tipo' id='tipo' class='form-control'>
                            <option value='1'>Acesso Remoto</option>
                            <option value='2'>Presencial</option>
                        </select>
                    </div>

                    <div class='form-group'>
                        <label for='categoria'>Categoria</label>
                        <select name='categoria' id='categoria' class='form-control'>
                            <option value='1'>Manutenção de Computadores</option>
                            <option value='2'>Configuração</option>
                            <option value='3'>Instalação de Software</option>
                            <option value='4'>Roteadores / Modens / Switches</option>
                            <option value='5'>Formatação</option>
                            <option value='6'>Remoção de Vírus</option>
                            <option value='7'>Upgrade</option>
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

<?php
    require "rodape.php";
?>
