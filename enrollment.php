<?php 

$id_curso = $_GET['id_course'];
$id_student = $_GET['student_id'];


require_once "config.php";

$sql = "INSERT INTO enrollment (id_student, id_course, status) VALUES ($id_student, $id_curso, 1)";

$resultat = mysqli_query($link, $sql);

if (!$resultat) {
    echo "Error al insertar los datos. Inténtalo de nuevo.";
    header("location: home.php");
} else {
    header("location: home.php");
    exit();
}
mysqli_close($link);


?>