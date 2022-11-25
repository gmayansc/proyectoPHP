<?php
// Include config file
require_once "../config.php";

// Define variables and initialize with empty values
$name = $description = $date_start =  $date_end = "";
$name_err = $description_err = $date_start_err =  $date_end_err = "";



// Attempt select query execution
$sql_teachers = "SELECT name, id_teacher FROM teachers";
$result_teachers = mysqli_query($link, $sql_teachers);

$sql_courses = "SELECT name, id_course FROM courses";
$result_courses = mysqli_query($link, $sql_courses);



// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validamos el nombre
    $input_name = trim($_POST["name"]);
    if (empty($input_name)) {
        $name_err = "Por favor, introduce un nombre";
    } else {
        $name = $input_name;
    }

    // Validamos la Color
    $input_color = trim($_POST["color"]);
    if (empty($input_color)) {
        $color_err = "Porfavor, introduce un color.";
    } else {
        $color = $input_color;
    }

    // Validamos la curso
    $input_course = trim($_POST["course"]);
    if (empty($input_course)) {
        $course_err = "Porfavor, introduce un course.";
    } else {
        $course = $input_course;
    }

    // Validamos la descripción
    $input_teacher = trim($_POST["teacher"]);
    if (empty($input_teacher)) {
        $teacher_err = "Porfavor, introduce un teacher.";
    } else {
        $teacher = $input_teacher;
    }

    // Validamos la fecha de inicio
    $input_date = trim($_POST["date"]);
    if (empty($input_date)) {
        $date_err = "Por favor, introduce un día.";
    } else {
        $date = $input_date;
    }

    // Validamos la fecha de inicio
    $input_time_start = trim($_POST["time_start"]);
    if (empty($input_time_start)) {
        $time_start_err = "Por favor, introduce una hora de inicio.";
    } else {
        $time_start = $input_time_start;
    }

    // Validamos la hora final
    $input_time_end = trim($_POST["time_end"]);
    if (empty($input_time_end)) {
        $time_end_err = "Por favor, introduce una hora de fin.";
    } else if (strtotime($input_time_end) < strtotime($input_time_start)) {
        $time_end_err = "La hora de fin no puede ser anterior a la de inicio.";
    } else {
        $time_end = $input_time_end;
    }


    if (empty($name_err) && empty($color_err) && empty($time_start_err) && empty($time_end_err) && empty($date_err) && empty($course_err) && empty($teacher_err)) {

        $sql = "BEGIN;
        INSERT INTO class ( name, id_teacher, id_schedule, id_course, color) VALUES ('$name', $teacher, 0, $course, '$color');
        INSERT INTO schedule ( id_class, time_start, time_end, day) VALUES ( INSERT_LAST_ID() , '$time_start', '$time_end', '$date');
        COMMIT";
        mysqli_query($link, $sql);

        echo $sql;

        // if (!$resultat) {
        //     echo "Error al insertar los datos. Inténtalo de nuevo.";
        // } else {
        //     header("location: classes.php");
        //     exit();
        // }
        mysqli_close($link);
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Crear nueva clase</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper {
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg bg-light">
            <div class="container">
                <a class="navbar-brand" href="#">Moodle PHP</a>
            </div>
        </nav>
    </header>

    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Crear clase</h2>
                    <p>Rellena los campos con la información de la nueva clase.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

                        <h3 class="mt-4">Información básica</h3>
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label>Nombre de la clase</label>
                                <input type="text" name="name" class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $name; ?>">
                                <span class="invalid-feedback"><?php echo $name_err; ?></span>
                            </div>

                            <div class="form-group col-md-4">
                                <label>Color identificativo</label>
                                <input type="color" name="color" class="form-control <?php echo (!empty($color_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $color; ?>">
                                <span class="invalid-feedback"><?php echo $color_err; ?></span>
                            </div>

                        </div>

                        <h3 class="mt-4">Seleccionar curso y profesor</h3>

                        <div class="form-group">
                            <label>Seleccione un curso</label>
                            <select name="course" id="course">
                                <?php
                                if (mysqli_num_rows($result_courses) > 0) {
                                    while ($row = mysqli_fetch_array($result_courses)) {
                                        echo '<option value="' . $row['id_course'] . '">' . $row['name'] . ' </option>';
                                    }
                                    mysqli_free_result($result_courses);
                                }
                                ?>

                            </select>
                            <span class="invalid-feedback"><?php echo $course_err; ?></span>
                        </div>

                        <div class="form-group">
                            <label>Seleccione un profesor</label>
                            <select name="teacher" id="teacher">
                                <?php
                                if (mysqli_num_rows($result_teachers) > 0) {
                                    while ($row = mysqli_fetch_array($result_teachers)) {
                                        echo '<option value="' . $row['id_teacher'] . '">' . $row['name'] . ' </option>';
                                    }
                                    mysqli_free_result($result_teachers);
                                }
                                ?>

                            </select>
                            <span class="invalid-feedback"><?php echo $teacher_err; ?></span>
                        </div>

                        <h3 class="mt-4">Seleccione un horario </h3>
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label>Día de la clase</label>
                                <input type="date" name="date" class="form-control <?php echo (!empty($date_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $date; ?>">
                                <span class="invalid-feedback"><?php echo $date_err; ?></span>
                            </div>

                            <div class="form-group col-md-4">
                                <label>Hora de inicio</label>
                                <input type="time" name="time_start" step="2" class="form-control <?php echo (!empty($time_start_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $time_start; ?>">
                                <span class="invalid-feedback"><?php echo $time_start_err; ?></span>
                            </div>

                            <div class="form-group col-md-4">
                                <label>Hora de fin</label>
                                <input type="time" name="time_end" step="2"  class="form-control <?php echo (!empty($time_end_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $time_end; ?>">
                                <span class="invalid-feedback"><?php echo $time_end_err; ?></span>
                            </div>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Añadir nueva clase">
                        <a href="index.php" class="btn btn-secondary ml-2">Cancelar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>