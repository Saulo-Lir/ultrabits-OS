<?php
  require 'cabecalho.php';

  if(isset($_POST['email']) && !empty($_POST['email'])){
    $nome = addslashes($_POST['nome']);
    $email = addslashes($_POST['email']);
    $empresa = addslashes($_POST['empresa']);
    $senha = $_POST['senha'];

    if($usuario->cadastraUsuario($nome, $email, $empresa, $senha)){
?>
    <div class='alert alert-success'>
      Usuário cadastrado com sucesso!
    </div>

<?php
    }else {
?>
    <div class='alert alert-warning'>
      Este email já está cadastrado no sistema!
    </div>
<?php
    }
  }
?>

  <div class='container'>
    <div class='panel panel-default'>
      <div class='panel-heading'><h3>Cadastre-se</h3></div>
      <div class='panel-body'>

        <form method='POST'>

          <div class='form-group'>
              <label for='nome'>Nome</label>
              <input type='text' name='nome' id='nome' class='form-control' placeholder='Digite seu nome completo' required/>
          </div>

          <div class='form-group'>
              <label for='email'>E-Mail</label>
              <input type='email' name='email' id='email' class='form-control' required/>
          </div>

          <div class='form-group'>
              <label for='empresa'>Empresa</label>
              <input type='text' name='empresa' id='empresa' class='form-control' required/>
          </div>

          <div class='form-group'>
              <label for='senha'>Senha</label>
              <input type='password' name='senha' id='senha' class='form-control' required/>
          </div>

          <div class='form-group'>
              <input type='submit' value='Cadastrar' class='btn btn-default' />
          </div>

        </form>

      </div>
    </div>
  </div>

<?php
  require 'rodape.php';
?>
