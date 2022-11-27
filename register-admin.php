<?php

require 'database.php';

$message = '';

if (!empty($_POST['email']) && !empty($_POST['password'])) {
  $sql = "INSERT INTO users_admin(username, name, email, password)
    values(:username, :name, :email, :password)";

  $sql = $conn->prepare($sql);

  $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

  $username = $_POST['username'];
  $name = $_POST['name'];
  $email = $_POST['email'];
  $pass = $_POST['password'];

  $sql->bindParam(':username', $username, PDO::PARAM_STR, 100);
  $sql->bindParam(':name', $name, PDO::PARAM_STR, 100);
  $sql->bindParam(':email', $email, PDO::PARAM_STR, 100);
  $sql->bindParam(':password', $password, PDO::PARAM_STR, 100);

  if ($sql->execute()) {
    $message = 'Administrador registrado correctamente!';
  } else {
    $message = 'ERROR: No ha sido posible completar el registro.';
  }
}

?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Panel de administración</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>

  <header>
    <nav class="navbar navbar-expand-lg bg-light">
      <div class="container">
        <a class="navbar-brand" href="index.php">Moodle PHP</a>
        <!-- <a class="nav-link" href=""> <?php echo $extraidoEstudiantes['name'] . " " . $extraidoEstudiantes['surname'] ?></a> -->
      </div>
    </nav>
  </header>

  <div class="container d-flex justify-content-center align-items-center flex-column " style="height:70vh">

    <h2 class="student-info__title mb-3 text-center">Regístrate aquí: </h2>
    <div class="card col-6">
      <div class="card-header">
        <ul class="nav nav-tabs card-header-tabs">
          <li class="nav-item">
            <a class="nav-link" href="register.php">Soy estudiante</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="true">Soy administrador</a>
          </li>
        </ul>
      </div>
      <div class="card-body d-flex justify-content-center">
        <div class="student-info col-10 ">
          <form class="row g-3 mb-3" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="col-md-6">
              <label for="inputEmail4" class="form-label">Nombre</label>
              <input type="text" class="form-control" name="name" id="inputEmail4" placeholder="Nombre">
            </div>
            <div class="col-md-6">
              <label for="inputEmail4" class="form-label">Nombre de usuario</label>
              <input type="text" class="form-control" name="username" id="inputEmail4" placeholder="Usuario">
            </div>
            <div class="col-md-6">
              <label for="inputEmail4" class="form-label">Email</label>
              <input type="email" class="form-control" name="email" id="inputEmail4" placeholder="Email">
            </div>
            <div class="col-md-6">
              <label for="inputPassword4" class="form-label">Contraseña</label>
              <input type="password" class="form-control" name="password" id="inputPassword4" placeholder="Password">
            </div>
            <div class="col-12">
              <input type="submit" class="btn mt-3 btn-primary" value="Registrarme como administrador"><br>
            </div>
          </form>
          <?php
          if (!empty($error_message)) {
            echo '<div class="alert alert-danger" role="alert">' .
              $error_message . '
            </div>';
          } else {
            echo !empty($success_message) ? '<div class="alert alert-success" role="alert">' . $success_message . '
            Por favor, <a href="index.php">inicia sesión.</a></div>' : '';
          }
          ?>

          ¿Ya eres admin? <a href="login-admin.php">Inicia sesión aquí.</a>
        </div>
      </div>
    </div>
</body>

</html>