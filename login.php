<?php
$servername = "localhost:8889";
$database = "producto 2";
$username = "root";
$password = "root";
// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
$tildes = $conn->query("SET NAMES 'utf8'"); //Para que se muestren las tildes
$result = mysqli_query($conn, "SELECT * FROM students WHERE 1");
mysqli_data_seek($result, 0);
$extraidoEstudiantes = mysqli_fetch_array($result);
mysqli_free_result($result);
mysqli_close($conn);

// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
$tildes = $conn->query("SET NAMES 'utf8'"); //Para que se muestren las tildes
$result = mysqli_query($conn, "SELECT * FROM schedule WHERE 1");
mysqli_data_seek($result, 0);
$extraidoHorarios = mysqli_fetch_array($result);
mysqli_free_result($result);
mysqli_close($conn);



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
        <a class="nav-link" href=""> <?php echo $extraidoEstudiantes['name'] . " " . $extraidoEstudiantes['surname'] ?></a>
      </div>
    </nav>
  </header>

  <section class="container justify-content-center row">
    <div class="student-info col-8 mt-5 mb-5">
      <h2 class="student-info__title mb-3">Iniciar sesión</h2>
      <form class="row g-3">
        <div class="col-md-12">
          <label for="inputEmail4" class="form-label">Email</label>
          <input type="email" class="form-control" id="inputEmail4" placeholder="j.perez@uoc.edu">
        </div>
        <div class="col-md-12">
          <label for="inputPassword4" class="form-label">Contraseña</label>
          <input type="password" class="form-control" id="inputPassword4" placeholder="12345678">
        </div>
        <div class="col-12">
          <button type="submit" class="btn btn-primary">Entrar</button>
        </div>
      </form>
    </div>

  </section>
</body>

</html>