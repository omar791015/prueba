<?php

  session_start();

  if (isset($_SESSION['user_id'])) {
    header('Location: http://localhost/prueba');
  }
  require 'database.php';

  if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $records = $conn->prepare('SELECT userid, email, password FROM users WHERE email = :email');
    $records->bindParam(':email', $_POST['email']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $message = '';

    if (count($results) > 0 && password_verify($_POST['password'], $results['password'])) {
      $_SESSION['user_id'] = $results['userid'];
      header('Location: http://localhost/prueba');
    } else {
      $message = 'Disculpa estas credenciales no existen';
    }
  }

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Acceder</title>
    
    <link rel="stylesheet" href="assets/css/style.css">
  </head>
  <body>
    <?php require 'partials/header.php' ?>

    <?php if(!empty($message)): ?>
      <p> <?= $message ?></p>
    <?php endif; ?>

    <h1>Ingresar</h1>
    <span>o <a href="register.php">Registrate</a></span>

    <form action="signin.php" method="POST">
      <input name="email" type="text" placeholder="Inserta tu correo electronico">
      <input name="password" type="password" placeholder="Inserta tu contraseña">
      <input type="submit" value="Submit">
    </form>
  </body>
  <?php require 'partials/footer.php' ?>
</html>


