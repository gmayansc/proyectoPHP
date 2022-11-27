<?php
session_start();
$student_id = $_SESSION['admin_id'];

if (empty($student_id)) {
    header("location: login-admin.php");
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
                    <a class="nav-link" href="edit-profile.php"> <?php echo  '<i class="bi bi-person-circle" style="margin-right: 10px"></i><b>' . $_SESSION['admin_name'] . "</b>"; ?>
                        <?php if (!empty($_SESSION['student_name'])) {
                            echo '<a class="nav-link" href="logout.php">Cerrar sesión</a>';
                        } else {
                            echo '';
                        }; ?></a>
                </div>
            </div>
        </nav>
    </header>
    <section class="container administrator-panel">


        <div class="row mt-5 gap-3 justify-content-between">

            <div class="col">
                <div class="row">
                    <a href="register-professor.php"><div role="button" class="add_card large blue d-flex justify-content-center align-items-center col">
                        <h3 class="text-white">Agregar profesor</h3>
                    </div></a>
                </div>

                <div class="row mt-2 gap-3">
                <a href="students.php"><div role="button" class="add_card green d-flex justify-content-center align-items-center col">
                        <h5 class="text-white"><i class="bi bi-file-person-fill"></i> Ver alumnos</h5>
                    </div></a>
                    <a href="teachers.php"><div role="button" class="add_card  orange d-flex justify-content-center align-items-center col">
                        <h5 class="text-white"><i class="bi bi-person-vcard-fill"></i> Todos los profesores</h5>
                    </div></a>
                </div>


            </div>
            <div class="col">
                <div class="row">
                <a href="courses/courses.php"><div role="button" class="add_card large blue d-flex justify-content-center align-items-center col">
                        <h3 class="text-white">Ver todos los cursos</h3>
                    </div></a>
                </div>

                <div class="row mt-2 gap-3">
                <a href="courses/create-courses.php"><div role="button" class="add_card green d-flex justify-content-center align-items-center col">
                        <h5 class="text-white"><i class="bi bi-bookmark-plus"></i>  Añadir un curso</h5>
                    </div></a>
                    <a href="courses/courses.php"><div role="button" class="add_card  orange d-flex justify-content-center align-items-center col">
                        <h5 class="text-white"><i class="bi bi-bookmark-dash"></i>  Eliminar un curso</h5>
                    </div></a>
                </div>


            </div>

            <div class="col">
                <div class="row">
                <a href="classes/classes.php"><div role="button" class="add_card large blue d-flex justify-content-center align-items-center col">
                        <h3 class="text-white">Ver todas las clases</h3>
                    </div></a>
                </div>

                <div class="row mt-2 gap-3">
                <a href="classes/create-classes.php"><div role="button" class="add_card green d-flex justify-content-center align-items-center col">
                        <h5 class="text-white"><i class="bi bi-file-earmark-plus-fill"></i> Añadir una clase</h5>
                    </div></a>
                    <a href="classes/classes.php"><div role="button" class="add_card  orange d-flex justify-content-center align-items-center col">
                        <h5 class="text-white"><i class="bi bi-file-earmark-x-fill"></i> Eliminar una clase</h5>
                    </div></a>
                </div>

            </div>

        </div>


    </section>
</body>

</html>