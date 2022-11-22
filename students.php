<?php
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
$result = mysqli_query($conn, "SELECT * FROM schedule WHERE 1");
mysqli_data_seek($result, 0);
$extraidoHorarios = mysqli_fetch_array($result);
mysqli_free_result($result);
mysqli_close($conn);



?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de administración</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg bg-light">
            <div class="container">
                <a class="navbar-brand" href="#">Moodle PHP</a>
                <a class="nav-link" href=""> <?php echo $extraidoEstudiantes['name'] . " " . $extraidoEstudiantes['surname'] ?></a>
            </div>
        </nav>
    </header>

    <section class="container">
        <div class="student-info mt-5 mb-5">
            <h2 class="student-info__title">Detalles del administrador</h2>
            <div>Nombre: <?php echo $extraidoEstudiantes['name'] ?> </div>
            <div>Apellido: <?php echo $extraidoEstudiantes['surname'] ?> </div>
            <div>Email: <?php echo $extraidoEstudiantes['email'] ?> </div>
            <div>Nombre usuario: <?php echo $extraidoEstudiantes['username'] ?> </div>
            <div>Teléfono: <?php echo $extraidoEstudiantes['phone'] ?> </div>
            <div>NIF: <?php echo $extraidoEstudiantes['nif'] ?> </div>
            <div>Fecha de registro: <?php echo $extraidoEstudiantes['date_registered'] ?> </div>
        </div>

        <div class="student-schedule mt-5 mb-5">
            <h2 class="student-schedule__title">Listado de alumnos</h2>
            <table style="border: 1px solid">
                <tr>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>NIF</th>
                    <th>Teléfono</th>
                    <th>Nombre de usuario</th>
                    <th>Acciones</th>
                </tr>
                <?php
                // Create connection
                $conn = mysqli_connect($servername, $username, $password, $database);
                // Check connection
                if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                }
                $tildes = $conn->query("SET NAMES 'utf8'"); //Para que se muestren las tildes
                $query = "SELECT * FROM students";
                $result = mysqli_query($conn, $query);
                mysqli_close($conn);





                if ($result) {

                    /* fetch associative array */
                    while ($row = $result->fetch_assoc()) {
                        echo '<tr> 
                    <td>' . $row["name"] . '</td> 
                    <td>' . $row["surname"] . '</td> 
                    <td>' . $row["nif"] . '</td> 
                    <td>' . $row["telephone"] . '</td> 
                    <td>' . $row["username"] . '</td> 
                    <td> EDIT </td>
                </tr>';
                    }

                    /* free result set */
                    $result->free();
                }
                ?>
                </table>
        </div>



    </section>
</body>

</html>