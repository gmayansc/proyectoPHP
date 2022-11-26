<?php

session_start();

require 'database.php';

if (!empty($_POST['email']) && !empty($_POST['password'])) {
  $records = $conn->prepare('SELECT id_teacher, email, password FROM users_admin WHERE email = :email');
  $records->bindParam(':email', $_POST['email']);
  $records->execute();
  $results = $records->fetch(PDO::FETCH_ASSOC);
  $message = '';

  if (count($results) > 0 && password_verify($_POST['password'], $results['password'])) {
    $_SESSION['teacher_id'] = $results['id_teacher'];
    header("location: indexAdmin.php");
  } else {
    $message = 'Usuario o Contraseña incorrecto';
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

  <div class="container">

    <section class="container justify-content-center row">
        <div class="student-info col-8 mt-5 mb-5">
            <h2 class="student-info__title mb-3">Iniciar sesión cómo Profesor:</h2>
            <form class="row g-3"  action="login.php" method="POST">
                <div class="col-md-12">
                <label for="inputEmail4" class="form-label">Email</label>
                <input type="email" class="form-control" id="inputEmail4" placeholder="Email">
                </div>
                <div class="col-md-12">
                    <label for="inputPassword4" class="form-label">Contraseña</label>
                    <input type="password" class="form-control" id="inputPassword4" placeholder="Password">
                </div>
                <div class="col-12">
                    <button type="submit"  class="btn btn-primary" href="home-professor.php">Entrar</a></button><br>
                    <p>¿Aún no tienes una cuenta? <a class="btn btn-primary" href="register-professor.php">Registrarse cómo Profesor</a><br>
                    <p>Iniciar Sesión cómo Estudiante:  <a class="btn btn-primary" href="login.php">Click Aquí</a><br>
                </div>
            </form>
        </div>

    </section>

      <?php if (!empty($message)) : ?>
        <p> <?= $message ?></p>
      <?php endif; ?>
    </section>

  </div>

</body>

</html>