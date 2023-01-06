<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio - Estudiantes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg bg-light">
            <div class="container">
                <a class="navbar-brand" href="">Moodle PHP</a>
                <div class="left_navbar d-flex gap-4">
                    <a class="nav-link" href="#"><i class="bi bi-person-circle" style="margin-right: 10px"></i><b>{{ $admin -> name }}</b>
                </a>
                </div>
            </div>
        </nav>
    </header>
    <section class="container administrator-panel">

    <section class="container administrator-panel">


        <div class="row mt-5 gap-3 justify-content-between">

            <div class="col">
                <div class="row gap-3">
                    <a class="col" href="courses">
                        <div role="button" class="add_card large blue d-flex align-items-center col">
                            <h3 class="text-white">Gestionar cursos</h3>
                        </div>
                    </a>
                    <a class="col" href="classes">
                        <div role="button" class="add_card large orange d-flex align-items-center col">
                            <h3 class="text-white">Gestionar clases</h3>
                        </div>
                    </a>
                    <a class="col" href="teachers">
                        <div role="button" class="add_card large green d-flex align-items-center col">
                            <h3 class="text-white">Gestionar profesores</h3>
                        </div>
                    </a>
                </div>
                <div class="row mt-3 gap-3">
                    <a class="col" href="students">
                        <div role="button" class="add_card large blue d-flex align-items-center col">
                            <h3 class="text-white">Ver alumnos</h3>
                        </div>
                    </a>
                    <a class="col" href="register-professor">
                        <div role="button" class="add_card large orange d-flex align-items-center col">
                            <h3 class="text-white">Añadir exámenes</h3>
                        </div>
                    </a>
                    <a class="col" href="register-professor">
                        <div role="button" class="add_card large green d-flex align-items-center col">
                            <h3 class="text-white">Creación de horarios</h3>
                        </div>
                    </a>
                </div>
            </div>
    </section>


</body>

</html>