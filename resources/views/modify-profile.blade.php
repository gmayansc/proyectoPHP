<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar nuevo estudiante</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg bg-light">
            <div class="container">
                <a class="navbar-brand" href="home">Moodle PHP</a>
                <a class="nav-link" href=""></a>
            </div>
        </nav>
    </header>

    <div class="container d-flex justify-content-center align-items-center flex-column " style="height:70vh">

        <h2 class="student-info__title mt-5 text-center">Hola, {{$student->name}}. Pudes modificar tus datos aquí: </h2>
        <div class="card col-6">
            <div class="card-body d-flex justify-content-center">
                <div class="student-info col-10 ">
                    <form class="row g-3 mb-3" action="/modify-profile-submit" method="get">
                        <h5 class="mt-5">Datos personales</h5>
                        <div class="col-md-4">
                            <label for="inputEmail4" class="form-label">Nombre</label>
                            <input type="text" class="form-control" name="name" placeholder="Juan" value="{{$student->name}}">
                        </div>
                        <div class="col-md-4">
                            <label for="inputEmail4" class="form-label">Apellido</label>
                            <input type="text" class="form-control" name="surname" placeholder="Pérez" value="{{$student->surname}}">
                        </div>
                        <div class="col-md-4">
                            <label for="inputEmail4" class="form-label">Nombre de usuario</label>
                            <input type="text" class="form-control" name="username" placeholder="@jperez94" value="{{$student->username}}">
                        </div>
                        <h5 class="mt-5">Tus datos de acceso</h5>
                        <div class="col-md-8">
                            <label for="inputEmail4" class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" placeholder="j.perez@uoc.edu" value="{{$student->email}}" disabled readonly="true">
                        </div>
                        <div class="col-md-4">
                            <label for="inputPassword4" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" name="password" placeholder="12345678" value="{{$student->pass}}">
                        </div>
                        <h5 class="mt-5">Otra información</h5>
                        <div class="col-4">
                            <label for="inputAddress" class="form-label">Teléfono</label>
                            <input type="text" class="form-control" name="telephone" placeholder="+34 600 123 444" value="{{$student->telephone}}">
                        </div>
                        <div class="col-4">
                            <label for="inputAddress2" class="form-label">NIF</label>
                            <input type="text" class="form-control" name="nif" placeholder="41888772X" value="{{$student->nif}}">
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="notifications">
                            <label class="form-check-label" for="flexCheckDefault">
                                Recibir notificaciones por email
                            </label>
                        </div>

                        <input type="hidden" name="student_id" value="{{$student->id_student}}" />
                        <div class="col-12">
                            <input type="submit" class="btn mt-3 btn-primary" value="Actualizar datos"><br>
                        </div>
                    </form>


                    <a href="/home">Cancelar</a>
                </div>
            </div>
        </div>
</body>