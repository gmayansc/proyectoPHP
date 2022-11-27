<?php

session_start();

require 'conexion.php';
require 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  if (!empty($_POST['email']) && !empty($_POST['password'])) {

    $email = $_POST['email'];
    $pass = $_POST['password'];

    $sql = "SELECT id_user_admin, name, email, password FROM users_admin WHERE email = '$email'";


    $result = mysqli_query($link, $sql);

    if (!$result) {
      $error_message = "Error en la base de datos";
    } else {
      $row = mysqli_fetch_array($result);
      if( count($row)> 0  && $pass === $row['password']){
        $error_message = "TODO OK";
          $_SESSION['admin_id'] = $row['id_user_admin'];
          $_SESSION['admin_name'] = $row['name'];
          header("location: home-admin.php");
        
      } else {
        $error_message = "No existe ningún usuario con este email y/o contraseña.";

      }
    }

    mysqli_close($link);
  } else {

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
  <header>
    <nav class="navbar navbar-expand-lg bg-light">
      <div class="container">
        <a class="navbar-brand" href="#">Moodle PHP</a>
      </div>
    </nav>
  </header>
  <div class="container d-flex justify-content-center align-items-center flex-column " style="height:70vh">
 
    <h2 class="student-info__title mb-3 text-center">Iniciar sesión</h2>
    <div class="card col-6">
      <div class="card-header">
        <ul class="nav nav-tabs card-header-tabs">
          <li class="nav-item">
            <a class="nav-link" href="index.php">Como estudiante</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="true">Como administrador</a>
          </li>
        </ul>
      </div>
      <div class="card-body d-flex justify-content-center">
        <div class="student-info col-8 ">
          <form class="row g-3 mb-3" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="col-md-12">
              <label for="inputEmail4" class="form-label">Email</label>
              <input type="email" name="email" class="form-control"  required placeholder="j.perez@uoc.edu">
            </div>
            <div class="col-md-12">
              <label for="inputPassword4" class="form-label">Contraseña</label>
              <input type="password" name="password" class="form-control" required placeholder="12345678">
            </div>
            <div class="col-12">
              <button type="submit" class="btn btn-primary">Entrar</a></button><br>
            </div>
          </form>
          <?php
          if (!empty($error_message)) {
            echo '<div class="alert alert-danger" role="alert">' .
              $error_message . '
            </div>';
          }
          ?>

          ¿No tienes cuenta? <a href="register-admin.php">Regístrate aquí.</a>
        </div>
      </div>
    </div>

  </div>

</body>

</html>