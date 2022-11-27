<?php
session_start();
$student_id = $_SESSION['student_id'];

if (empty($student_id)) {
    header("location: index.php");
}

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
$current_classesSQL = "SELECT schedule.time_start, teachers.name as Profesor, schedule.day as Dia,
courses.name as Curso, students.name as Alumno, class.name as Asignatura FROM enrollment
INNER JOIN courses ON courses.id_course = enrollment.id_course
INNER JOIN class ON enrollment.id_course = class.id_course
INNER JOIN teachers ON class.id_teacher = teachers.id_teacher
INNER JOIN schedule ON class.id_schedule = schedule.id_schedule
INNER JOIN students ON enrollment.id_student = students.id
WHERE enrollment.id_student = $student_id;";
$resultadoClases = mysqli_query($conn, $current_classesSQL);
mysqli_data_seek($resultadoClases, 0);


$current_cursosSQL = "SELECT courses.name as Curso FROM courses";
$resultadoCursos = mysqli_query($conn, $current_cursosSQL);
mysqli_data_seek($resultadoCursos, 0);




?>

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
                    <a class="nav-link" href="edit-profile.php"> <?php echo  '<i class="bi bi-person-circle" style="margin-right: 10px"></i><b>' . $_SESSION['student_name'] . " " . $_SESSION['student_surname'] . "</b>"; ?>
                        <?php if (!empty($_SESSION['student_name'])) {
                            echo '<a class="nav-link" href="logout.php">Cerrar sesión</a>';
                        } else {
                            echo '';
                        }; ?></a>
                </div>
            </div>
        </nav>
    </header>
    <section class="container">


        <div class="row mt-5 gap-3 justify-content-between">

            <div class="mis_datos col">
                <div class="student-info">
                    <h2 class="student-info__title"><i class="bi bi-person-circle" style="margin-right: 10px"></i>Mis datos:</h2>
                    <div><b>Nombre:</b> <?php echo $extraidoEstudiantes['name'] ?> </div>
                    <div><b>Apellido:</b> <?php echo $extraidoEstudiantes['surname'] ?> </div>
                    <div><b>Email:</b> <?php echo $extraidoEstudiantes['email'] ?> </div>
                    <div><b>Nombre usuario:</b> <?php echo $extraidoEstudiantes['username'] ?> </div>
                    <div><b>Teléfono:</b> <?php echo $extraidoEstudiantes['telephone'] ?> </div>
                    <div><b>NIF: </b><?php echo $extraidoEstudiantes['nif'] ?> </div>
                    <div><b>Fecha de registro:</b> <?php echo $extraidoEstudiantes['date_registered'] ?> </div>
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
                    mysqli_close($conn);
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
                    <?php
                    while ($row = mysqli_fetch_array($resultadoCursos)) {
                        echo "<tr>";
                        echo "<td>" . $row['Curso'] . "</td>";
                        echo "<td> <i role='button' class='bi bi-plus-square-fill'> Añadir a mis cursos </i>";
                        echo "</tr>";
                    }
                    mysqli_free_result($resultadoCursos);
                    mysqli_close($conn);
                    ?>
                </table>
            </div>
        </div>

    </section>
</body>

</html>