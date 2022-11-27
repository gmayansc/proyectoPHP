<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
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
                        <h2 class="pull-left">Todos los cursos</h2>
                        <a href="create-courses.php" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Añadir nuevo curso</a>
                    </div>
                    <?php
                    // Include config file
                    require_once "../config.php";
                    
                    // Attempt select query execution
                    $sql = "SELECT * FROM courses";
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo '<table class="table table-bordered table-striped">';
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>#</th>";
                                        echo "<th>Curso</th>";
                                        echo "<th>Descripción</th>";
                                        echo "<th>Fecha Inicio</th>";
                                        echo "<th>Fecha Fin</th>";
                                        echo "<th>¿Activo?</th>";
                                        echo "<th>Editar</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $row['id_course'] . "</td>";
                                        echo "<td>" . $row['name'] . "</td>";
                                        echo "<td>" . $row['description'] . "</td>";
                                        echo "<td>" . $row['date_start'] . "</td>";
                                        echo "<td>" . $row['date_end'] . "</td>";
                                        if ($row['active'] == 1) {
                                            echo "<td> SÍ </td>";
                                        } else {
                                            echo "<td> NO </td>";
                                        }
                                        echo "<td>";
                                            echo '<a href="update-courses.php?id_course='. $row['id_course'] .'" class="mr-3" title="Update Record" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
                                            echo '<a href="delete-courses.php?id_course='. $row['id_course'] .'" title="Delete Record" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
                                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            // Free result set
                            mysqli_free_result($result);
                        } else{
                            echo '<div class="alert alert-danger"><em>No se ha encontrado ningún curso.</em></div>';
                        }
                    } else{
                        echo "Oops! Algo ha ido mal. Por favor, inténtelo de nuevo.";
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