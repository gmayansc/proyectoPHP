<?php
session_start();
$id_student = $_SESSION['student_id'];

if (empty($id_student)) {
    header("location: home.php");
}

// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$name = $surname = $username = $email = $telephone = $nif = $password = "";

// Processing form data when form is submitted
if (isset($_POST["student_id"]) && !empty($_POST["student_id"])) {

    // Get hidden input value
    $id_student = $_POST["student_id"];

    $name = $_POST["name"];
    $surname = $_POST["surname"];
    $username = $_POST["username"];
    $password = $_POST["pass"];
    $telephone = $_POST["telephone"];
    $email = $_POST["email"];
    $nif = $_POST["nif"];

    // Check input errors before inserting in database
    if (empty($name_err)) {
        // Prepare an update statement
        $sql = "UPDATE students SET name= '$name', 
        surname = '$surname', username='$username', telephone = '$telephone', nif='$nif', pass='$password'
        WHERE id= $id_student";
        $resultat = mysqli_query($link, $sql);
        if (!$resultat) {
            echo "Error al insertar los datos. Inténtalo de nuevo.";
        } else {
            header("location: home.php");
            exit();
        }
        mysqli_close($link);
    }

    // Close connection
    mysqli_close($link);
} else {
    // Check existence of id parameter before processing further
    if (isset($_GET["student_id"]) && !empty(trim($_GET["student_id"]))) {
        // Get URL parameter

        // Prepare a select statement
        $sql = "SELECT * FROM students WHERE id = $id_student";
      

        $resultat = mysqli_query($link, $sql);

        if (mysqli_num_rows($resultat) == 1) {
            /* Fetch result row as an associative array. Since the result set
            contains only one row, we don't need to use while loop */
            $row = mysqli_fetch_array($resultat, MYSQLI_ASSOC);

            // Retrieve individual field value
            $name = $row["name"];
            $surname = $row["surname"];
            $username = $row["username"];
            $password = $row["pass"];
            $telephone = $row["telephone"];
            $email = $row["email"];
            $nif = $row["nif"];

        } else {
            // URL doesn't contain valid id. Redirect to error page
            // header("location: error.php");
            // exit();
            echo "error id";
        }

        mysqli_close($link);
    } else {
        // URL doesn't contain id parameter. Redirect to error page
        echo "ASDASD";
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registrar nuevo estudiante</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>

<body>
  <header>
    <nav class="navbar navbar-expand-lg bg-light">
      <div class="container">
        <a class="navbar-brand" href="index.php">Moodle PHP</a>
        <!-- <a class="nav-link" href=""> <?php echo $extraidoEstudiantes['name'] . " " . $extraidoEstudiantes['surname'] ?></a> -->
      </div>
    </nav>
  </header>

  <div class="container d-flex justify-content-center align-items-center flex-column " style="height:70vh">

    <h2 class="student-info__title mt-5 text-center">Hola, <?php echo $extraidoEstudiantes['name'] ?>. Pudes modificar tus datos aquí: </h2>
    <div class="card col-6">
      <div class="card-body d-flex justify-content-center">
        <div class="student-info col-10 ">
          <form class="row g-3 mb-3" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <h5 class="mt-5">Datos personales</h5>
            <div class="col-md-4">
              <label for="inputEmail4" class="form-label">Nombre</label>
              <input type="text" class="form-control" name="name" placeholder="Juan" value="<?php echo $name?>">
            </div>
            <div class="col-md-4">
              <label for="inputEmail4" class="form-label">Apellido</label>
              <input type="text" class="form-control" name="surname" placeholder="Pérez" value="<?php echo $surname?>">
            </div>
            <div class="col-md-4">
              <label for="inputEmail4" class="form-label">Nombre de usuario</label>
              <input type="text" class="form-control" name="username" placeholder="@jperez94" value="<?php echo $username?>">
            </div>
            <h5 class="mt-5">Tus datos de acceso</h5>
            <div class="col-md-8">
              <label for="inputEmail4" class="form-label">Email</label>
              <input type="email" class="form-control" name="email" placeholder="j.perez@uoc.edu" value="<?php echo $email?>">
            </div>
            <div class="col-md-4">
              <label for="inputPassword4" class="form-label">Contraseña</label>
              <input type="password" class="form-control" name="password"  placeholder="12345678" value="<?php echo $password?>">
            </div>
            <h5 class="mt-5">Otra información</h5>
            <div class="col-4">
              <label for="inputAddress" class="form-label">Teléfono</label>
              <input type="text" class="form-control" name="telephone" placeholder="+34 600 123 444" value="<?php echo $telephone?>">
            </div>
            <div class="col-4">
              <label for="inputAddress2" class="form-label">NIF</label>
              <input type="text" class="form-control" name="nif" placeholder="41888772X" value="<?php echo $nif?>">
            </div>
            <input type="hidden" name="student_id" value="<?php echo $id_student; ?>" />
            <div class="col-12">
              <input type="submit" class="btn mt-3 btn-primary" value="Actualizar datos"><br>
            </div>
          </form>
          <?php
          if (!empty($error_message)) {
            echo '<div class="alert alert-danger" role="alert">' .
              $error_message . '
            </div>';
          } else {
            echo !empty($success_message) ? '<div class="alert alert-success" role="alert">' . $success_message . '
            Por favor, <a href="home.php">inicia sesión.</a></div>' : '';
          }
          ?>

          <a href="home.php">Cancelar</a>
        </div>
      </div>
    </div>
</body>