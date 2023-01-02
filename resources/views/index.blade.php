<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Moodel PHP - Iniciar sesión</title>
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
            <a class="nav-link active" aria-current="true" href="#">Como estudiante</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="login-admin">Como administrador</a>
          </li>
        </ul>
      </div>
      <div class="card-body d-flex justify-content-center">
        <div class="student-info col-8 ">
          <form class="row g-3 mb-3" action="/login-check" method="get">
            <div class="col-md-12">
              <label for="inputEmail4" class="form-label">Email</label>
              <input type="email" name="email" class="form-control" id="inputEmail4" required placeholder="j.perez@uoc.edu">
            </div>
            <div class="col-md-12">
              <label for="inputPassword4" class="form-label">Contraseña</label>
              <input type="password" name="password" class="form-control" id="inputPassword4" required placeholder="12345678">
            </div>
            <div class="col-12">
              <button type="submit" class="btn btn-primary">Entrar</a></button><br>
            </div>
          </form>
        @if ($invalid)
        <h2 style="color:red">Datos introducidos son incorrectos</h2>
        @endif
          

          ¿No tienes cuenta? <a href="register">Regístrate aquí.</a>
        </div>
      </div>
    </div>

  </div>






</body>

</html>