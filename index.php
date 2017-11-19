<?php
  session_start();
  require 'classes/usuario.class.php';
?>

<html>
  <head>
      <meta charset='UTF-8'/>
      <link rel='stylesheet' type='text/css' href='assets/css/bootstrap.min.css' />
      <link rel='stylesheet' type='text/css' href='assets/css/layout.css'/>
      <title>Ultrabits OS</title>
  </head>

<?php
  if(isset($_POST['usuario']) && !empty($_POST['usuario'])){
    $usuario = addslashes($_POST['usuario']);
    $senha = addslashes(md5($_POST['senha']));

    $u = new Usuario();

    if($u->login($usuario, $senha)){

      header('Location: ultrabits.php');
      exit;
    }else {
?>
    <div class='alert alert-danger'>
      Usuário Ou Senha Inválidos!
    </div>
<?php
    }
  }
?>

  <body>
    <div class='container'>
      <h3>Login</h3>

      <div class='jumbotron'>

      <form method='POST'>

        <div class='form-group'>
          <label for='usuario'>Usuário</label>
          <input type='text' name='usuario' id='usuario' class='form-control'/>
        <div>

        <div class='form-group'>
          <label for='senha'>Senha</label>
          <input type='password' name='senha' id='senha' class='form-control'/>
        </div>

        <div class='form-group'>
          <input type='submit' value='Entrar' class='btn btn-default' />
        </div>

      </form>

      <strong>Usuário: teste</strong>
      <br/>
      <strong>Senha: teste</strong>

    </div>

    </div>

<?php
  require 'rodape.php';
?>
