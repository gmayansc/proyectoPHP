<?php

session_start();
$admin_id = $_SESSION['admin_id'];

if (empty($admin_id)) {
    header("location: teachers.php");
}

require 'database.php';

$message = '';

if (!empty($_POST['email'])) {
  $sql = "INSERT INTO teachers (name, surname, telephone, nif,  email)
    values(:name, :surname, :telephone, :nif,  :email)";

  $sql = $conn->prepare($sql);

  $name = $_POST['name'];
  $surname = $_POST['surname'];
  $email = $_POST['email'];
  $telephone = $_POST['telephone'];
  $nif = $_POST['nif'];

  $sql->bindParam(':surname', $surname, PDO::PARAM_STR, 100);
  $sql->bindParam(':name', $name, PDO::PARAM_STR, 100);
  $sql->bindParam(':email', $email, PDO::PARAM_STR, 100);
  $sql->bindParam(':telephone', $telephone, PDO::PARAM_STR, 100);
  $sql->bindParam(':nif', $nif, PDO::PARAM_STR, 100);

  if ($sql->execute()) {
    header("location: home-admin.php");
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
  <header>
    <nav class="navbar navbar-expand-lg bg-light">
      <div class="container">
        <a class="navbar-brand" href="home-admin.php">Moodle PHP</a>
        <div class="left_navbar d-flex gap-4">
                    <a class="nav-link" href="edit-profile.php"> <?php echo  '<i class="bi bi-person-circle" style="margin-right: 10px"></i><b>' . $_SESSION['admin_name'] . "</b>"; ?>
                        <?php if (!empty($_SESSION['admin_id'])) {
                            echo '<a class="nav-link" href="logout.php">Cerrar sesión</a>';
                        } else {
                            echo '';
                        }; ?></a>
                </div>
      </div>
    </nav>
  </header>

  <div class="container">

    <?php if (!empty($message)) : ?>
      <p> <?= $message ?></p>
    <?php endif; ?>

    <section class="container row">
      <div class="student-info col-9 mt-5 mb-5">
        <h2 class="student-info__title align-center mb-3">Registro de Profesores:</h2>
        <form class="row g-3" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
          <h4>Datos personales</h4>
          <div class="col-md-3">
            <label for="inputEmail4" class="form-label">Nombre</label>
            <input type="text" class="form-control" name="name" required placeholder="Nombre">
          </div>
          <div class="col-md-3">
            <label for="inputEmail4" class="form-label">Apellido</label>
            <input type="text" class="form-control" name="surname" required placeholder="Apellido">
          </div>
          <div class="col-md-3">
            <label for="inputEmail4" class="form-label">NIF</label>
            <input type="text" class="form-control" name="nif" placeholder="NIF">
          </div>

          <div class="col-md-3">
            <label for="inputEmail4" class="form-label">Teléfono</label>
            <input type="text" class="form-control" name="telephone" placeholder="Usuario">
          </div>

          <h4>Email de acceso</h4>
          <div class="col-md-8">
            <label for="inputEmail4" class="form-label">Email</label>
            <input type="email" class="form-control" name="email" id="inputEmail4" placeholder="Email">
          </div>
          <div class="col-12">
            <button type="submit" class="btn btn-primary">Registrar profesor</a></button><br>
          </div>
        </form>
      </div>

    </section>


  </div>
</body>

</html>