<?php

  session_start();

  require 'conexion.php';

  if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $records = $conn->prepare('SELECT id, email, password FROM users WHERE email = :email');
    $records->bindParam(':email', $_POST['email']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $message = '';

    if (count($results) > 0 && password_verify($_POST['password'], $results['password'])) {
      $_SESSION['user_id'] = $results['id'];
    } else {
      $message = 'Sorry, those credentials do not match';
    }
  }

?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Panel de administración</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>

<body>

  <?php if(!empty($message)): ?>
    <p> <?= $message ?></p>
  <?php endif; ?>

  <header>
    <nav class="navbar navbar-expand-lg bg-light">
      <div class="container">
        <a class="navbar-brand" href="#">Moodle PHP</a>
        <a class="nav-link" href=""> <?php echo $extraidoEstudiantes['name'] ." ". $extraidoEstudiantes['surname']?></a>
      </div>
    </nav>
  </header>

  <section class="container justify-content-center row">
    <div class="student-info col-8 mt-5 mb-5">
      <h2 class="student-info__title mb-3">Iniciar sesión</h2>
      <form class="row g-3"  action="login.php" method="POST">
        <div class="col-md-12">
          <label for="inputEmail4" class="form-label">Email</label>
          <input type="email" class="form-control" id="inputEmail4" placeholder="j.perez@uoc.edu">
        </div>
        <div class="col-md-12">
          <label for="inputPassword4" class="form-label">Contraseña</label>
          <input type="password" class="form-control" id="inputPassword4" placeholder="12345678">
        </div>
        <div class="col-12">
          <button type="submit"  class="btn btn-primary" href="home.php">Entrar</a></button><br>
          <p>¿Aún no tienes una cuenta? <a class="btn btn-primary" href="register.php">Registrarse</a><br>
          <p>Para entrar cómo administrador: <a class="btn btn-primary" href="login-admin.php">Click aquí</a><br>
          <a class="btn btn-primary" href="logout.php">Cerrar Sesión</a><br>
          
        </div>
      </form>
    </div>

  </section>
</body>

</html>

