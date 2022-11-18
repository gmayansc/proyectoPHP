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
echo "Connected successfully";

$tildes = $conn->query("SET NAMES 'utf8'"); //Para que se muestren las tildes
$result = mysqli_query($conn, "SELECT * FROM students WHERE 1");
mysqli_data_seek ($result, 0);
$extraido= mysqli_fetch_array($result);
echo "- Nombre: ".$extraido['name']."<br/>";
echo "- Apellidos: ".$extraido['surname']."<br/>";
echo "- Dirección: ".$extraido['email']."<br/>";
echo "- Teléfono: ".$extraido['id']."<br/>";
mysqli_free_result($result);
mysqli_close($conn);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplicación Backend PHP</title>
</head>
<body>
    <h1>Aplicación backend</h1>
</body>
</html>
