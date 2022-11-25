<?php
// Include config file
require_once "../config.php";

// Define variables and initialize with empty values
$name = $description = $date_start =  $date_end = $active = "";
$name_err = $description_err = $date_start_err =  $date_end_err = $active_err = "";

// Processing form data when form is submitted
if (isset($_POST["id_course"]) && !empty($_POST["id_course"])) {
    // Get hidden input value
    $id_course = $_POST["id_course"];

    // Validate name
    $input_name = trim($_POST["name"]);
    if (empty($input_name)) {
        $name_err = "Por favor, introduce un nombre.";
    } else {
        $name = $input_name;
    }

    // Validate descripcion
    $input_description = trim($_POST["description"]);
    if (empty($input_description)) {
        $description_err = "Por favor, introduce una descripción del curso.";
    } else {
        $description = $input_description;
    }

    // Validate date_start
    $input_date_start = trim($_POST["date_start"]);
    if (empty($input_date_start)) {
        $date_start_err = "Por favor, introduce una fecha de inicio.";
    } else {
        $date_start = $input_date_start;
    }

    // Validate date_end
    $input_date_end = trim($_POST["date_end"]);
    if (empty($input_date_end)) {
        $date_end_err = "Por favor, introduce una fecha de fin.";
    } else if (strtotime($input_date_end) < strtotime($input_date_start)) {
        $date_end_err = "La fecha de fin no puede ser anterior a la de inicio.";
    } else {
        $date_end = $input_date_end;
    }


    $_POST['active'] ? $active = "1" : $active = "0";



    // Check input errors before inserting in database
    if (empty($name_err) && empty($description_err) && empty($date_start_err) && empty($date_end_err)) {
        // Prepare an update statement
        $sql = "UPDATE courses SET name= '$name', description='$description', date_start = '$date_start', date_end = '$date_end', active = '$active' WHERE id_course= $id_course";
        $resultat = mysqli_query($link, $sql);
        if (!$resultat) {
            echo "Error al insertar los datos. Inténtalo de nuevo.";
        } else {
            header("location: courses.php");
            exit();
        }
        mysqli_close($link);
    }

    // Close connection
    mysqli_close($link);
} else {
    // Check existence of id parameter before processing further
    if (isset($_GET["id_course"]) && !empty(trim($_GET["id_course"]))) {
        // Get URL parameter
        $id_course =  trim($_GET["id_course"]);

        // Prepare a select statement
        $sql = "SELECT * FROM courses WHERE id_course = $id_course";


        $resultat = mysqli_query($link, $sql);

        if (mysqli_num_rows($resultat) == 1) {
            /* Fetch result row as an associative array. Since the result set
            contains only one row, we don't need to use while loop */
            $row = mysqli_fetch_array($resultat, MYSQLI_ASSOC);

            // Retrieve individual field value
            $name = $row["name"];
            $description = $row["description"];
            $date_start = $row["date_start"];
            $date_end = $row["date_end"];
            $active = $row["active"];
        } else {
            // URL doesn't contain valid id. Redirect to error page
            header("location: error.php");
            exit();
        }

        // Close connection
        mysqli_close($link);
    } else {
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Actualizar Curso</title>
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
                    <h2 class="mt-5">Actualizar curso</h2>
                    <p>Edita los datos de este formulario para actualizar la información del curso.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        <div class="form-group">
                            <label>Nombre del curso</label>
                            <input type="text" name="name" class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $name; ?>">
                            <span class="invalid-feedback"><?php echo $name_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Descripción del curso</label>
                            <textarea name="description" class="form-control <?php echo (!empty($description_err)) ? 'is-invalid' : ''; ?>"><?php echo $description; ?></textarea>
                            <span class="invalid-feedback"><?php echo $description_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Fecha inicio</label>
                            <input type="date" name="date_start" class="form-control <?php echo (!empty($date_start_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $date_start; ?>">
                            <span class="invalid-feedback"><?php echo $date_start_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Fecha fin</label>
                            <input type="date" name="date_end" class="form-control <?php echo (!empty($date_end_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $date_end; ?>">
                            <span class="invalid-feedback"><?php echo $date_end_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Activo</label>
                            <input type="checkbox" name="active" <?php echo (($active == 1)) ? 'checked' : ''; ?> class="form-control <?php echo (!empty($active_err)) ? 'is-invalid' : ''; ?>" value= "VALUEactive">
                            <span class="invalid-feedback"><?php echo $active_err; ?></span>
                        </div>
                        <input type="hidden" name="id_course" value="<?php echo $id_course; ?>" />
                        <input type="submit" class="btn btn-primary" value="Modificar">
                        <a href="courses.php" class="btn btn-secondary ml-2">Cancelar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>