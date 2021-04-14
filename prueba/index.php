<?php
  session_start();

  require 'database.php';

  if (isset($_SESSION['user_id'])) {
    $records = $conn->prepare('SELECT userid, email, password FROM users WHERE userid = :userid');
    $records->bindParam(':userid', $_SESSION['user_id']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $user = null;

    if (count($results) > 0) {
      $user = $results;
    }
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Omar Rojas Rodriguez</title>
    <link rel="stylesheet" href="assets/css/style.css">
  </head>
  <body>
    <?php require 'partials/header.php' ?>

    <?php if(!empty($user)): ?>
      <br> Bienvenido. <?= $user['email']; ?>
      <br>Ha iniciado sesión correctamente
      <a href="change-password.php">
        Logout
      </a>
    <?php else: ?>
      <h1>Por favor Ingresa o Registrate</h1>

      <a href="signin.php">Ingresar</a> or
      <a href="register.php">Registrarme</a>
    <?php endif; ?>
      
  </body>
  <br><br>
  <?php require 'partials/footer.php' ?>
</html>
