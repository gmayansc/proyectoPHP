
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
                    <a class="nav-link" href="modify-profile.php?student_id=<?php echo 'test'?>"> <?php echo  '<i class="bi bi-person-circle" style="margin-right: 10px"></i><b>' . "_SESSION['student_name']" . " " . "_SESSION['student_surname']" . "</b>"; ?>
                        <?php if (!empty($_SESSION['student_name'])) {
                            echo '<a class="nav-link" href="logout.php">Cerrar sesión</a>';
                        } else {
                            echo '';
                        }; ?></a>
                </div>
            </div>
        </nav>
    </header>
    <section class="container mb-5">


        <div class="row mt-5 gap-3 justify-content-between">

            <div class="mis_datos col">
                <div class="student-info">
                    <h2 class="student-info__title mb-4"><i class="bi bi-person-circle" style="margin-right: 10px"></i>Mis datos:</h2>
                    <div><b>Nombre:</b> <?php echo "xtraidoEstudiantes['name']" ?> </div>
                    <div><b>Apellido:</b> <?php echo "xtraidoEstudiantes['surname']" ?> </div>
                    <div><b>Email:</b> <?php echo "xtraidoEstudiantes['email']" ?> </div>
                    <div><b>Nombre usuario:</b> <?php echo "xtraidoEstudiantes['username']" ?> </div>
                    <div><b>Teléfono:</b> <?php echo "xtraidoEstudiantes['telephone']" ?> </div>
                    <div><b>NIF: </b><?php echo "xtraidoEstudiantes['nif']" ?> </div>
                    <div><b>Fecha de registro:</b> <?php echo "xtraidoEstudiantes['date_registered']" ?> </div>
                    <div class="mt-2"><a href="modify-profile.php?student_id=<?php echo "student_id"?>"> <i role="button" class="bi bi-pencil-square"> <b> Editar perfil </b></i></a></div>
                </div>
            </div>


            <div class="mi_calendario col-4">
                <h2 class="mb-2">Calendario:</h2>

            </div>

        </div>


        <div class="row mt-5 gap-3 justify-content-between">

            <div class="mis_clases col">
                <h2 class="mb-2 text-white">Mis asignaturas:</h2>
                <table class="table rounded table-dark table-hover">
                    <tr>
                        <th>Día</th>
                        <th>Asignatura</th>
                        <th>Curso</th>
                        <th>Inicio</th>
                        <th>Profesor</th>
                        <th>Más</th>
                    </tr>
                    <?php
                    /*
                    while ($row = mysqli_fetch_array($resultadoClases)) {
                        echo "<tr>";
                        echo "<td>" . $row['Dia'] . "</td>";
                        echo "<td>" . $row['Asignatura'] . "</td>";
                        echo "<td>" . $row['Curso'] . "</td>";
                        echo "<td>" . $row['time_start'] . "</td>";
                        echo "<td>" . $row['Profesor'] . "</td>";
                        echo "<td><i class='bi bi-three-dots'></i>";
                        echo "</tr>";
                    }
                    mysqli_free_result($resultadoClases);
                    mysqli_close($conn);*/
                    ?>
                    </tr>
                </table>
            </div>
        </div>
        <div class="row mt-5 gap-3 justify-content-between">

            <div class="matricula_cursos col">
                <h2 class="mb-2">Cursos disponibles:</h2>
                <table class="table rounded table-light table-hover">
                    <tr>
                        <th>Título del curso</th>
                        <th>Matrícularme</th>
                    </tr>
                    <?php /*
                    while ($row = mysqli_fetch_array($resultadoCursos)) {
                        echo "<tr>";
                        echo "<td>" . $row['Curso'] . "</td>";
                        echo "<td> <a href='enrollment.php?student_id=".$student_id."&id_course=" . $row['id_curso'] . "'><i role='button' class='bi bi-plus-square-fill'> Añadir a mis cursos </i></a>";
                        echo "</tr>";
                    }
                    mysqli_free_result($resultadoCursos);
                    mysqli_close($conn);*/
                    ?>
                </table>
            </div>
        </div>

    </section>
</body>

</html>