<?php
    session_start();
    $admin_id = $_SESSION['admin_id'];

    if (empty($admin_id)) {
        header("location: login-admin.php");
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Todos los alumnos</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        .wrapper {
            width: 600px;
            margin: 0 auto;
        }

        table tr td:last-child {
            width: 120px;
        }
    </style>
    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
</head>

<body>
<header>
        <nav class="navbar navbar-expand-lg bg-light">
            <div class="container">
                <a class="navbar-brand" href="home-admin.php">Moodle PHP</a>
                <div class="left_navbar d-flex gap-4">
                    <a class="nav-link" href="#"> <?php echo  '<i class="bi bi-person-circle" style="margin-right: 10px"></i><b>' . $_SESSION['admin_name'] . "</b>"; ?>
                        <?php if (!empty($_SESSION['admin_id'])) {
                            echo '<a class="nav-link" href="logout.php">Cerrar sesión</a>';
                        } else {
                             header("location: login-admin.php");
                        }; ?></a>
                </div>
            </div>
        </nav>
    </header>
        <div class="container">
            <div class="row">
                <div class="col-md-18">
                    <div class="mt-5 mb-3 clearfix">
                        <h2 class="pull-left">Todos los alumnos</h2>
                    </div>
                    <?php
                    // Include config file
                    require "config.php";

                    // Attempt select query execution
                    $sql = "SELECT * FROM students";
                    if ($result = mysqli_query($link, $sql)) {
                        if (mysqli_num_rows($result) > 0) {
                            echo '<table class="table table-bordered table-striped">';
                            echo "<thead>";
                            echo "<tr>";
                            echo "<th>#</th>";
                            echo "<th>Nombre de usuario</th>";
                            echo "<th>Nombre</th>";
                            echo "<th>Apellido</th>";
                            echo "<th>NIF</th>";
                            echo "<th>Teléfono</th>";
                            echo "<th>Email</th>";
                            echo "<th>Fecha de registro</th>";
                            echo "<th>Editar</th>";
                            echo "</tr>";
                            echo "</thead>";
                            echo "<tbody>";
                            while ($row = mysqli_fetch_array($result)) {
                                echo "<tr>";
                                echo "<td>" . $row['id'] . "</td>";
                                echo "<td>" . $row['username'] . "</td>";
                                echo "<td>" . $row['name'] . "</td>";
                                echo "<td>" . $row['surname'] . "</td>";
                                echo "<td>" . $row['nif'] . "</td>";
                                echo "<td>" . $row['telephone'] . "</td>";
                                echo "<td>" . $row['email'] . "</td>";
                                echo "<td>" . $row['date_registered'] . "</td>";
                                echo "<td>";
                                echo '<a href="modify-profile.php?id=' . $row['id'] . '" class="mr-3" title="Update alumno" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
                                echo '<a href="delete-student.php?id=' . $row['id'] . '" title="Delete alumno" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
                                echo "</td>";
                                echo "</tr>";
                            }
                            echo "</tbody>";
                            echo "</table>";
                            // Free result set
                            mysqli_free_result($result);
                        } else {
                            echo '<div class="alert alert-danger"><em>No se ha encontrado ningún alumno.</em></div>';
                        }
                    } else {
                        echo "Oops! Algo ha ido mal. Por favor, inténtelo de nuevo.";
                    }

                    // Close connection
                    mysqli_close($link);
                    ?>
                </div>
            </div>
    </div>
</body>

</html>