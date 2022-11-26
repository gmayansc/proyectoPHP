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

<body>

  <div class="container">

    <?php if (!empty($message)) : ?>
      <p> <?= $message ?></p>
    <?php endif; ?>

    <section class="container">
    <div class="student-info mt-5 mb-5">
      <h2 class="student-info__title align-center mb-3">Registro de Administrador:</h2>
      <form class="row g-3" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="col-md-4">
          <label for="inputEmail4" class="form-label">Nombre</label>
          <input type="text" class="form-control" name="name" id="inputEmail4" placeholder="Nombre">
        </div>
        <div class="col-md-4">
          <label for="inputEmail4" class="form-label">Nombre de usuario</label>
          <input type="text" class="form-control" name="username" id="inputEmail4" placeholder="Usuario">
        </div>
        <div class="col-md-8">
          <label for="inputEmail4" class="form-label">Email</label>
          <input type="email" class="form-control" name="email" id="inputEmail4" placeholder="Email">
        </div>
        <div class="col-md-4">
          <label for="inputPassword4" class="form-label">Contraseña</label>
          <input type="password" class="form-control" name="password" id="inputPassword4" placeholder="Password">
        </div>
        <div class="col-12">
          <input type="submit" value="Registrarme como administrador"><br><br>
          <a class="btn btn-primary" href="login-admin.php">Iniciar Sesión Adiministrador</a>
        </div>
      </form>
    </div>

  </section>


  </div>
</body>

</html>