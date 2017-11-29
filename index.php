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
  if(isset($_POST['email']) && !empty($_POST['email'])){
    $email = addslashes($_POST['email']);
    $senha = addslashes(md5($_POST['senha']));

    $usuario = new Usuario();

    if($usuario->login($email, $senha)){

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
          <label for='email'>E-mail</label>
          <input type='email' name='email' id='email' class='form-control'/>
        <div>

        <div class='form-group'>
          <label for='senha'>Senha</label>
          <input type='password' name='senha' id='senha' class='form-control'/>
        </div>

        <div class='form-group'>
          <input type='submit' value='Entrar' class='btn btn-default' />
        </div>

      </form>

      <strong>E-mail: teste@gmail.com</strong>
      <br/>
      <strong>Senha: teste</strong>

    </div>

    </div>

<?php
  require 'rodape.php';
?>
