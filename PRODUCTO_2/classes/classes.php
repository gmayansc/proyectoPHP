<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Clases MoodlePHP</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
        table tr td:last-child{
            width: 120px;
        }
    </style>
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
</head>
<body>
<header>
        <nav class="navbar navbar-expand-lg bg-light">
            <div class="container">
                <a class="navbar-brand" href="../home-admin.php">Moodle PHP</a>
            </div>
        </nav>
    </header>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="mt-5 mb-3 clearfix">
                        <h2 class="pull-left">Todas las clases</h2>
                        <a href="create-classes.php" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Añadir nueva clase</a>
                    </div>
                    <?php
                    // Include config file
                    require_once "../config.php";
                    
                    // Attempt select query execution
                    $sql = "SELECT *, teachers.name AS nombre_profe,
                    courses.name AS course_name, class.name AS class_name FROM teachers
                    INNER JOIN class ON teachers.id_teacher = class.id_teacher
                    INNER JOIN courses ON class.id_course = courses.id_course
                    INNER JOIN schedule ON class.id_schedule = schedule.id_schedule;";
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo '<table class="table table-bordered table-striped">';
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>#</th>";
                                        echo "<th>Asignatura</th>";
                                        echo "<th>Profesor</th>";
                                        echo "<th>Curso</th>";
                                        echo "<th>Dia</th>";
                                        echo "<th>Hora inicio</th>";
                                        echo "<th>Hora fin</th>";
                                        echo "<th>Color</th>";
                                        echo "<th>Acciones</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $row['id_class'] . "</td>";
                                        echo "<td>" . $row['class_name'] . "</td>";
                                        echo "<td>" . $row['nombre_profe'] . "</td>";
                                        echo "<td>" . $row['course_name'] . "</td>";
                                        echo "<td>" . $row['day'] . "</td>";
                                        echo "<td>" . $row['time_start'] . "</td>";
                                        echo "<td>" . $row['time_end'] . "</td>";
                                        echo "<td><div style='height: 30px; width:100%; background-color:".$row['color']."; border-radius: 2px;'></td>";
                                        echo "<td>";
                                            // echo '<a href="update-classes.php?id_class='. $row['id_class'] .'" class="mr-3" title="Update Record" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
                                            echo '<a href="delete-classes.php?id_class='. $row['id_class'] .'" title="Delete Record" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
                                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            // Free result set
                            mysqli_free_result($result);
                        } else{
                            echo '<div class="alert alert-danger"><em>No se ha encontrado ninguna clase.</em></div>';
                        }
                    } else{
                        echo '<div class="alert alert-danger"><em>Oops! Algo ha ido mal. Por favor, inténtelo de nuevo.</em></div>';
                    }
 
                    // Close connection
                    mysqli_close($link);
                    ?>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>