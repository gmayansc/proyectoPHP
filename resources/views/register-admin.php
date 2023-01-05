
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
        <a class="navbar-brand" href="/">Moodle PHP</a>
        <!-- <a class="nav-link" href="">  echo $extraidoEstudiantes['name'] . " " . $extraidoEstudiantes['surname'] ?></a> -->
      </div>
    </nav>
  </header>

  <div class="container d-flex justify-content-center align-items-center flex-column " style="height:70vh">

    <h2 class="student-info__title mb-3 text-center">Regístrate aquí: </h2>
    <div class="card col-6">
      <div class="card-header">
        <ul class="nav nav-tabs card-header-tabs">
          <li class="nav-item">
            <a class="nav-link" href="register">Soy estudiante</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="true">Soy administrador</a>
          </li>
        </ul>
      </div>
      <div class="card-body d-flex justify-content-center">
        <div class="student-info col-10 ">
          <form class="row g-3 mb-3" action="/register-admin-check" method="get">
            <div class="col-md-6">
              <label for="inputEmail4" class="form-label">Nombre</label>
              <input type="text" class="form-control" name="name" placeholder="Nombre">
            </div>
            <div class="col-md-6">
              <label for="inputEmail4" class="form-label">Nombre de usuario</label>
              <input type="text" class="form-control" name="username" placeholder="Usuario">
            </div>
            <div class="col-md-6">
              <label for="inputEmail4" class="form-label">Email</label>
              <input type="email" class="form-control" name="email" placeholder="Email">
            </div>
            <div class="col-md-6">
              <label for="inputPassword4" class="form-label">Contraseña</label>
              <input type="password" class="form-control" name="pass" placeholder="Password">
            </div>
            <div class="col-12">
              <input type="submit" class="btn mt-3 btn-primary" value="Registrarme como administrador"><br>
            </div>
          </form>

          ¿Ya eres admin? <a href="login-admin">Inicia sesión aquí.</a>
        </div>
      </div>
    </div>
</body>

</html>