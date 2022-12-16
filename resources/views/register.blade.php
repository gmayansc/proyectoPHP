<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar nuevo estudiante</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>

<?php if (isset($_SESSION['completado'])) : ?>
    <div class="alerta alerta-exito">
        <?= $_SESSION['completado']; ?>
    </div>
<?php elseif (isset($_SESSION['errores']['general'])) : ?>
    <div class="alerta alerta-error">
        <?= $_SESSION['errores']['general']; ?>
    </div>
<?php endif; ?>

<body>
    <header>
        <nav class="navbar navbar-expand-lg bg-light">
            <div class="container">
                <a class="navbar-brand" href="/">Moodle PHP</a>
                <!-- <a class="nav-link" href=""> echo $extraidoEstudiantes['name'] . " " . $extraidoEstudiantes['surname'] ?></a> -->
            </div>
        </nav>
    </header>

    <div class="container d-flex  mt-5 justify-content-center align-items-center flex-column " style="height:70vh">

        <h2 class="student-info__title mb-3 text-center">Regístrate aquí: </h2>
        <div class="card col-6">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="true" href="#">Soy estudiante</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="register-admin">Soy administrador</a>
                    </li>
                </ul>
            </div>
            <div class="card-body d-flex justify-content-center">
                <div class="student-info col-10 ">
                    <form class="row g-3 mb-3" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <h5 class="mt-5">Datos personales</h5>
                        <div class="col-md-4">
                            <label for="inputEmail4" class="form-label">Nombre</label>
                            <input type="text" class="form-control" name="name" placeholder="Juan">
                        </div>
                        <div class="col-md-4">
                            <label for="inputEmail4" class="form-label">Apellido</label>
                            <input type="text" class="form-control" name="surname" placeholder="Pérez">
                        </div>
                        <div class="col-md-4">
                            <label for="inputEmail4" class="form-label">Nombre de usuario</label>
                            <input type="text" class="form-control" name="username" placeholder="@jperez94">
                        </div>
                        <h5 class="mt-5">Tus datos de acceso</h5>
                        <div class="col-md-8">
                            <label for="inputEmail4" class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" placeholder="j.perez@uoc.edu">
                        </div>
                        <div class="col-md-4">
                            <label for="inputPassword4" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" name="password" placeholder="12345678">
                        </div>
                        <h5 class="mt-5">Otra información</h5>
                        <div class="col-4">
                            <label for="inputAddress" class="form-label">Teléfono</label>
                            <input type="text" class="form-control" name="telephone" placeholder="+34 600 123 444">
                        </div>
                        <div class="col-4">
                            <label for="inputAddress2" class="form-label">NIF</label>
                            <input type="text" class="form-control" name="nif" placeholder="41888772X">
                        </div>
                        <div class="col-12">
                            <input type="submit" class="btn mt-3 btn-primary" value="Registrarme como estudiante"><br>
                        </div>
                    </form>
                    <?php
                    if (!empty($error_message)) {
                        echo '<div class="alert alert-danger" role="alert">' .
                            $error_message . '
            </div>';
                    } else {
                        echo !empty($success_message) ? '<div class="alert alert-success" role="alert">' . $success_message . '
            Por favor, <a href="/">inicia sesión.</a></div>' : '';
                    }
                    ?>

                    ¿Ya tienes cuenta? <a href="/">Inicia sesión aquí.</a>
                </div>
            </div>
        </div>
</body>

</html>