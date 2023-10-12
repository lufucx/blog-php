<?php
session_start();
include_once("../lib/includes.php");
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <base href="<?php echo $url['1']?>">
  <title><?php echo gera_titulo("Sistema de Postagem", true, $con); ?></title>
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css">
  <link rel="stylesheet" href="css/style.css">
</head>

<body>
  <br>
  <div class="row">
    <?php if (isset($_SESSION['usuarioID'])) { ?>
      <div class="col-sm-3" id="menu-principal">
        <ul>
          <li class="title"><a>Publicações</a></li>
          <li class="sub"><a href="publicar">Publicar</a></li>
          <li class="sub"><a href="gerenciar-posts">Gerenciar Publicações</a></li>
          <li class="menu"><a href="perfil">Editar perfil</a></li>
          <li class="menu"><a href="sair">Sair</a></li>
        </ul>
      </div>
    <?php } ?>

    <div class="<?php echo (isset($_SESSION['usuarioID'])) ? 'col-sm-5 offset-md-2' : 'col-sm-6 offset-md-3'; ?>">
      <?php echo carrega_pagina($con, $data, true); ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>

</body>

</html>