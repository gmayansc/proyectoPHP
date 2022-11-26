<?php


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
        <a class="navbar-brand" href="#">Moodle PHP</a>
      </div>
    </nav>
  </header>

  <div class="container">

    <section class="container justify-content-center row">
        <div class="student-info col-8 mt-5 mb-5">
            <h2 class="student-info__title mb-3">Bienvenido</h2>
            <form class="row g-3"  action="login.php" method="POST">
                <div class="col-md-12">
                <label for="inputEmail4" class="form-label">¿Cómo quieres entrar?</label><br><br>
                <a class="btn btn-primary" href="login-admin.php">Administrador</a><br><br>
                <a class="btn btn-primary" href="login.php">Estudiante</a><br><br>
                <a class="btn btn-primary" href="login-professor.php">Profesor</a><br><br>
                </div>
            </form>
        </div>
    </section>

  </div>




  

</body>

</html>