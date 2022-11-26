
<?php

require 'database.php';

$message = '';

if (!empty($_POST['email']) && !empty($_POST['pass'])) {
  $sql = "INSERT INTO students(username, pass, email, name, surname, telephone, nif, date_registered)
    values(:username, :pass, :email, :name, :surname, :telephone, :nif, :date_registered)";

  $sql = $conn->prepare($sql);

  $password = password_hash($_POST['pass'], PASSWORD_BCRYPT);

  $name = $_POST['name'];
  $surname = $_POST['surname'];
  $username = $_POST['username'];
  $email = $_POST['email'];
  $pass = $_POST['pass'];
  $telephone = $_POST['telephone'];
  $nif = $_POST['nif'];
  $date_registered = '2022-01-01 00:00:00';

  $sql->bindParam(':name', $name, PDO::PARAM_STR, 100);
  $sql->bindParam(':username', $username, PDO::PARAM_STR, 100);
  $sql->bindParam(':pass', $password, PDO::PARAM_STR, 100);
  $sql->bindParam(':email', $email, PDO::PARAM_STR, 100);
  $sql->bindParam(':surname', $surname, PDO::PARAM_STR, 100);
  $sql->bindParam(':telephone', $telephone, PDO::PARAM_STR, 100);
  $sql->bindParam(':nif', $nif, PDO::PARAM_STR, 100);
  $sql->bindParam(':date_registered', $date_registered, PDO::PARAM_STR, 100);

  if ($sql->execute()) {
    $message = '¡Usuario registrado correctamente!';
  } else {
    $message = 'ERROR: No ha sido posible completar el registro.';
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

<?php if(isset($_SESSION['completado'])): ?>
            <div class="alerta alerta-exito">
                <?= $_SESSION['completado']; ?>
            </div>
            <?php elseif(isset($_SESSION['errores']['general'])): ?>
            <div class="alerta alerta-error">
                <?= $_SESSION['errores'] ['general']; ?>
            </div>            
        <?php endif; ?>      

<body>
  <header>
    <nav class="navbar navbar-expand-lg bg-light">
      <div class="container">
        <a class="navbar-brand" href="#">Moodle PHP</a>
        <!-- <a class="nav-link" href=""> <?php echo $extraidoEstudiantes['name'] . " " . $extraidoEstudiantes['surname'] ?></a> -->
      </div>
    </nav>
  </header>

  <?php if (!empty($message)) : ?>
      <p> <?= $message ?></p>
    <?php endif; ?>

  <section class="container">
    <div class="student-info mt-5 mb-5">
      <h2 class="student-info__title align-center mb-3">Registro de usuarios</h2>
      <form class="row g-3" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="col-md-4">
          <label for="inputEmail4" class="form-label">Nombre</label>
          <input type="text" class="form-control" name="name" id="inputEmail4" placeholder="Juan">
        </div>
        <div class="col-md-4">
          <label for="inputEmail4" class="form-label">Apellido</label>
          <input type="text" class="form-control" name="surname" id="inputEmail4" placeholder="Pérez">
        </div>
        <div class="col-md-4">
          <label for="inputEmail4" class="form-label">Nombre de usuario</label>
          <input type="text" class="form-control" name="username" id="inputEmail4" placeholder="@jperez94">
        </div>
        <div class="col-md-8">
          <label for="inputEmail4" class="form-label">Email</label>
          <input type="email" class="form-control" name="email" id="inputEmail4" placeholder="j.perez@uoc.edu">
        </div>
        <div class="col-md-4">
          <label for="inputPassword4" class="form-label">Contraseña</label>
          <input type="password" class="form-control" name="password" id="inputPassword4" placeholder="12345678">
        </div>
        <div class="col-4">
          <label for="inputAddress" class="form-label">Teléfono</label>
          <input type="text" class="form-control" name="telephone" id="inputAddress" placeholder="+34 600 123 444">
        </div>
        <div class="col-4">
          <label for="inputAddress2" class="form-label">NIF</label>
          <input type="text" class="form-control" name="nif" id="inputAddress2" placeholder="41888772X">
        </div>
        <div class="col-12">
        <input type="submit" value="Registrarme cómo estudiante"><br>
          <a class="btn btn-primary" href="login.php">Iniciar Sesión Estudiante</a>
        </div>
      </form>
    </div>

  </section>
</body>




