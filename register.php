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

<?php if(isset($_SESSION['completado'])): ?>
            <div class="alerta alerta-exito">
                <?= $_SESSION['completado']; ?>
            </div>
            <?php elseif(isset($_SESSION['errores']['general'])): ?>
            <div class="alerta alerta-error">
                <?= $_SESSION['errores'] ['general']; ?>
            </div>            
        <?php endif; ?>      

<body>
  <header>
    <nav class="navbar navbar-expand-lg bg-light">
      <div class="container">
        <a class="navbar-brand" href="#">Moodle PHP</a>
        <!-- <a class="nav-link" href=""> <?php echo $extraidoEstudiantes['name'] . " " . $extraidoEstudiantes['surname'] ?></a> -->
      </div>
    </nav>
  </header>

  <section class="container">
    <div class="student-info mt-5 mb-5">
      <h2 class="student-info__title align-center mb-3">Registro de usuarios</h2>
      <form class="row g-3">
        <div class="col-md-4">
          <label for="inputEmail4" class="form-label">Nombre</label>
          <input type="text" class="form-control" name="nombre" id="inputEmail4" placeholder="Juan">
          <?php echo isset($_SESSION['errores']) ? showError($_SESSION['errores'], 'nombre') : ''; ?>
        </div>
        <div class="col-md-4">
          <label for="inputEmail4" class="form-label">Apellido</label>
          <input type="text" class="form-control" name="apellido" id="inputEmail4" placeholder="Pérez">
          <?php echo isset($_SESSION['errores']) ? showError($_SESSION['errores'], 'apellido') : ''; ?>
        </div>
        <div class="col-md-4">
          <label for="inputEmail4" class="form-label">Nombre de usuario</label>
          <input type="text" class="form-control" name="username" id="inputEmail4" placeholder="@jperez94">
          <?php echo isset($_SESSION['errores']) ? showError($_SESSION['errores'], 'username') : ''; ?>
        </div>
        <div class="col-md-8">
          <label for="inputEmail4" class="form-label">Email</label>
          <input type="email" class="form-control" name="email" id="inputEmail4" placeholder="j.perez@uoc.edu">
          <?php echo isset($_SESSION['errores']) ? showError($_SESSION['errores'], 'email') : ''; ?>
        </div>
        <div class="col-md-4">
          <label for="inputPassword4" class="form-label">Contraseña</label>
          <input type="password" class="form-control" name="password" id="inputPassword4" placeholder="12345678">
          <?php echo isset($_SESSION['errores']) ? showError($_SESSION['errores'], 'password') : ''; ?>
        </div>
        <div class="col-4">
          <label for="inputAddress" class="form-label">Teléfono</label>
          <input type="text" class="form-control" name="telefono" id="inputAddress" placeholder="+34 600 123 444">
          <?php echo isset($_SESSION['errores']) ? showError($_SESSION['errores'], 'telefono') : ''; ?>
        </div>
        <div class="col-4">
          <label for="inputAddress2" class="form-label">NIF</label>
          <input type="text" class="form-control" name="nif" id="inputAddress2" placeholder="41888772X">
          <?php echo isset($_SESSION['errores']) ? showError($_SESSION['errores'], 'nif') : ''; ?>
        </div>
        <div class="col-12">
          <<a class="btn btn-primary" href="login.php">Registrarse</a>>
        </div>
      </form>
      <?php deleteErrors(); ?>
    </div>

  </section>
</body>


<?php
if(isset($_POST['submit'])){

    // Conexión a la bbdd:
    require_once 'includes/conexion.php';

    // Iniciar sesión:
    if(!isset($_SESSION)){
        session_start();
    }

    // Recoger los valores del formulario de registro
    $username = isset($_POST['username']) ? mysqli_real_escape_string($db, $_POST['username']) : false;
    $nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($db, $_POST['nombre']) : false;
    $apellido = isset($_POST['apellido']) ? mysqli_real_escape_string($db, $_POST['apellido']) : false;
    $nif = isset($_POST['nif']) ? mysqli_real_escape_string($db, $_POST['nif']) : false;
    $telefono = isset($_POST['telefono']) ? mysqli_real_escape_string($db, $_POST['telefono']) : false;
    $email = isset($_POST['email']) ? mysqli_real_escape_string($db, trim($_POST['email'])) : false;
    $password = isset($_POST['password']) ? mysqli_real_escape_string($db, trim($_POST['password'])) : false;

    // Array de errores - Guarda posibles errores en el formulario
    $errores = array();

    // Validar los datos antes de guardarlos en la base de datos
    //Validar nombre de usuario
    if(!empty($username) && !is_numeric($username)){
        $username_validate = true;
    }else{
        $username_validate = false;
        $errores['username'] = "El nombre de usuario no es válido";
    }

    // Validar campo nombre
    if(!empty($nombre) && !is_numeric($nombre) && !preg_match("/[0-9]/", $nombre)){
        $nombre_validate = true;
    }else{
        $nombre_validate = false;
        $errores['nombre'] = "El nombre no es válido";
    }
    
    // Validar apellidos
    if(!empty($apellido) && !is_numeric($apellido) && !preg_match("/[0-9]/", $apellido)){
        $apellido_validate = true;
    }else{
        $apellido_validate = false;
        $errores['apellido'] = "El apellido no es válido";
    }

    // Validar nif
    if(!empty($nif) && !is_numeric($nif)){
        $nif_validate = true;
    }else{
        $nif_validate = false;
        $errores['nif'] = "El NIF no es válido";
    }

    // Validar teléfono
    if(!empty($telefono) && is_numeric($telefono)){
        $telefono_validate = true;
    }else{
        $telefono_validate = false;
        $errores['phone'] = "El teléfono no es válido";
    }

    // Validar email
    if(!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)){

        $mailRep = mysqli_query($db,"SELECT * from students WHERE email = '$email'"); 
        $mr = mysqli_num_rows($mailRep);
    
        if($mr == 1){
            $pasword_validate = false;
            $errores['email'] = "El Email introducido ya existe. Por favor, introduce uno distinto.";
        }else{
            $email_validate = true;
        }

    }else{
        $email_validate = false;
        $errores['email'] = "El email no es válido";
    }
    
    // Validar password
    if(!empty($password)){
        $pasword_validate = true;
    }else{
        $pasword_validate = false;
        $errores['password'] = "La contraseña es inválida";
    }

    $guardar_usuario = false;    
    if(count($errores) == 0){
        $guardar_usuario = true; 
        
        // Cifrar la contraseña:
        $password_segura = password_hash($password, PASSWORD_BCRYPT, ['cost' => 4]); // cost = número de veces que cifra la contraseña

        // Insertar usuario en la tabla usuarios de la bbdd: REVISAR!!! ¿CÓMO INSERTAR USUARIO EN LA TABLA CORRESPONDIENTE ESTUDIANTE / PROFESOR?
        $sql = "INSERT INTO students VALUES(null, '$username', '$password_segura', '$email', '$nombre', '$apellido', '$telefono', '$nif', CURDATE());";
        $guardar = mysqli_query($db, $sql);
                 
        if($guardar){
            $_SESSION['completado'] = "El registro se ha completado con éxito";
        }else{
            $_SESSION['errores'] ['general'] = "¡Fallo al guardar el usuario!";
        }
        
    }else{
        $_SESSION['errores'] = $errores;  
    }
}

