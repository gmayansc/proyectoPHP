<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Todos los profesores</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

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
                <a class="navbar-brand" href="../home-admin">Moodle PHP</a>
            </div>
        </nav>
    </header>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-10 m-auto">
                    <div class="mt-5 mb-3 clearfix">
                        <h2 class="pull-left">Profesores</h2>
                    </div>

                    <div class="accordion" id="accordionPanelsStayOpenExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                                    Todos los Profesores
                                </button>
                            </h2>
                            <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingOne">
                                <div class="accordion-body">

                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Nombre</th>
                                                <th>Apellido</th>
                                                <th>Email</th>
                                                <th>Teléfono</th>
                                                <th>NIF</th>
                                                <th>Editar</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($teachers as $teacher)
                                            <tr>
                                                <td>{{$teacher->id_teacher}}</td>
                                                <td>{{$teacher->name}}</td>
                                                <td>{{$teacher->surname}}</td>
                                                <td>{{$teacher->email}}</td>
                                                <td>{{$teacher->telephone}}</td>
                                                <td>{{$teacher->nif}}</td>
                                                <td>
                                                    <form method='POST' action='/update-teacher'>
                                                        @csrf
                                                        <input type='hidden' value='{{ $teacher->id_teacher }}' name='id' />
                                                        <button type='submit' disabled><span class="fa fa-pencil">Update</span></button>
                                                    </form>
                                                    <form method='POST' action='/delete-teachers'>
                                                        @csrf
                                                        <input type='hidden' value='{{ $teacher->id_teacher }}' name='id' />
                                                        <button type='submit'><span class="fa fa-trash">Borrar</span></button>
                                                    </form>

                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>


                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
                                    + Añadir nuevo Profesor
                                </button>
                            </h2>
                            <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingTwo">
                                <div class="accordion-body">

                                    <form method='POST' class="col-5" action='/teachers'>
                                        @csrf
                                        <div>
                                            <input class='form-control mb-2' placeholder='Nombre del Profesor' name='name' />
                                        </div>
                                        <div>
                                            <input class='form-control mb-2' placeholder='Apellido del Profesor' name='surname' />
                                        </div>
                                        <div>
                                            <input class='form-control mb-2' placeholder='Email' name='email' />
                                        </div>
                                        <div>
                                            <input class='form-control mb-2' placeholder='Teléfono' name='telephone' />
                                        </div>
                                        <div>
                                            <input class='form-control mb-2' placeholder='NIF' name='nif' />
                                        </div>
                                        
                                        <button class="btn btn-primary" type='submit'>Añadir</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>