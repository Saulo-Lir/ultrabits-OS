<?php
  session_start();
  require 'classes/usuario.class.php';

  $u = new Usuario();
  $usuario = $u->getUsuario($_SESSION['login']);
?>

<html>
    <head>
        <meta charset='UTF-8'/>
        <link rel='stylesheet' type='text/css' href='assets/css/bootstrap.min.css' />
        <link rel='stylesheet' type='text/css' href='assets/css/layout.css'/>
        <title>Ultrabits OS</title>
    </head>

    <body>
        <div class='navbar navbar-inverse'>
            <div class='container'>
                <div class='navbar-header'>
                    <a href='ultrabits.php'>
                        <img src='assets/imagens/logo.png' width='180'/>
                    </a>
                </div>

                <ul class='nav navbar-nav navbar-right'>
                  <li><a href='perfil-usuario.php'><?=$usuario['nome']?></a></li>
                  <li><a href='sair.php'>Sair</a></li>
                </ul>
            </div>
        </div>
