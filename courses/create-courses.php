<?php
// Include config file
require_once "../config.php";

// Define variables and initialize with empty values
$name = $description = $date_start =  $date_end = "";
$name_err = $description_err = $date_start_err =  $date_end_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validamos el nombre
    $input_name = trim($_POST["name"]);
    if (empty($input_name)) {
        $name_err = "Por favor, introduce un nombre";
    } elseif (!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
        $name_err = "Por favor introduce un nombre válido.";
    } else {
        $name = $input_name;
    }

    // Validamos la descripción
    $input_description = trim($_POST["description"]);
    if (empty($input_description)) {
        $description_err = "Porfavor, introduce la descripción.";
    } else {
        $description = $input_description;
    }

    // Validamos la fecha de inicio
    $input_date_start = trim($_POST["date_start"]);
    if (empty($input_date_start)) {
        $date_start_err = "Por favor, introduce una fecha de inicio.";
    } else {
        $date_start = $input_date_start;
    }

    // Validamos la fecha final
    $input_date_end = trim($_POST["date_end"]);
    if (empty($input_date_end)) {
        $date_end_err = "Por favor, introduce una fecha de fin.";
    } else if (strtotime($input_date_end) < strtotime($input_date_start)) {
        $date_end_err = "La fecha de fin no puede ser anterior a la de inicio.";
    } else {
        $date_end = $input_date_end;
    }


    if (empty($name_err) && empty($description_err) && empty($date_start_err) && empty($date_end_err)) {

        $sql = "INSERT INTO courses (name, description, date_start, date_end, active) VALUES ('$name', '$description', '$date_start', '$date_end', 0)";

        echo $sql;
        $resultat = mysqli_query($link, $sql);

        if (!$resultat) {
            echo "Error al insertar los datos. Inténtalo de nuevo.";
        } else {
            header("location: courses.php");
            exit();
        }
        mysqli_close($link);
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Crear Curso</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper {
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Crear curso</h2>
                    <p>Rellena los campos con la información del nuevo curso.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group">
                            <label>Nombre del curso</label>
                            <input type="text" name="name" class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $name; ?>">
                            <span class="invalid-feedback"><?php echo $name_err; ?></span>
                        </div>

                        <div class="form-group">
                            <label>Descripción</label>
                            <textarea name="description" class="form-control <?php echo (!empty($description_err)) ? 'is-invalid' : ''; ?>"><?php echo $description; ?></textarea>
                            <span class="invalid-feedback"><?php echo $description_err; ?></span>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>Fecha de inicio</label>
                                <input type="date" name="date_start" class="form-control <?php echo (!empty($date_start_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $date_start; ?>">
                                <span class="invalid-feedback"><?php echo $date_start_err; ?></span>
                            </div>

                            <div class="form-group col-md-6">
                                <label>Fecha de fin</label>
                                <input type="date" name="date_end" class="form-control <?php echo (!empty($date_end_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $date_end; ?>">
                                <span class="invalid-feedback"><?php echo $date_end_err; ?></span>
                            </div>
                        </div>

                        <input type="submit" class="btn btn-primary" value="Registrar curso">
                        <a href="index.php" class="btn btn-secondary ml-2">Cancelar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>