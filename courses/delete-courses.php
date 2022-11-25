<?php
// Process delete operation after confirmation
if(isset($_POST["id_course"]) && !empty($_POST["id_course"])){
    // Include config file
    require_once "../config.php";
    

    $id_course = trim($_POST["id_course"]);

    // Prepare a delete statement
    $sql = "DELETE FROM courses WHERE id_course = $id_course";

    mysqli_query($link, $sql);
    
    // Close connection
    mysqli_close($link);
    header("location: courses.php");
    
} else{
    // Check existence of id_course parameter
    if(empty(trim($_GET["id_course"]))){
        // URL doesn't contain id_course parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Borrar Curso</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper{
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
                    <h2 class="mt-5 mb-3">Borrar curso</h2>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="alert alert-danger">
                            <input type="hidden" name="id_course" value="<?php echo trim($_GET["id_course"]); ?>"/>
                            <p>¿Seguro que quieres borrar el curso?</p>
                            <p>
                                <input type="submit" value="Sí" class="btn btn-danger">
                                <a href="courses.php" class="btn btn-secondary">No</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>