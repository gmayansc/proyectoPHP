<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
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
                        <h2 class="pull-left">Cursos</h2>
                    </div>

                    <div class="accordion" id="accordionPanelsStayOpenExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                                    Todos los cursos
                                </button>
                            </h2>
                            <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingOne">
                                <div class="accordion-body">

                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Curso</th>
                                                <th>Descripción</th>
                                                <th>Fecha Inicio</th>
                                                <th>Fecha Fin</th>
                                                <th>¿Activo?</th>
                                                <th>Editar</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($courses as $course)
                                            <tr>
                                                <td>{{$course->id}}</td>
                                                <td>{{$course->name}}</td>
                                                <td>{{$course->description}}</td>
                                                <td>{{$course->date_start}}</td>
                                                <td>{{$course->date_end}}</td>
                                                <?php if ($course->active == 1) {
                                                    echo "<td> SÍ </td>";
                                                } else {
                                                    echo "<td> NO </td>";
                                                } ?>
                                                <td>
                                                    <!-- <a href="update-courses.php?id={{$course->id}}" class="mr-3" title="Update Record" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>
                                                    <a href="delete-courses?id='. $row['id'] .'" title="Delete Record" data-toggle="tooltip"></a> -->

                                                    <form method='POST' action='/delete-courses'>
                                                        @csrf
                                                        <input type='hidden' value='{{ $course->id }}' name='id' />
                                                        <button type='submit'><span class="fa fa-trash"></span></button>
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
                                    + Añadir nuevo curso
                                </button>
                            </h2>
                            <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingTwo">
                                <div class="accordion-body">

                                    <form method='POST' class="col-5" action='/courses'>
                                        @csrf
                                        <div>
                                            <input class='form-control mb-2' placeholder='Nombre del curso' name='name' />
                                        </div>
                                        <div>
                                            <input class='form-control mb-2' placeholder='Descripción del curso' name='description' />
                                        </div>
                                        <div>
                                            <label for="date_start">Fecha de inicio</label>
                                            <input class='form-control mb-2' placeholder='Fecha de inicio' type='date' name='date_start' />
                                        </div>
                                        <div>
                                            <label for="date_end">Fecha de fin</label>
                                            <input class='form-control mb-2' placeholder='Fecha de fin' type='date' name='date_end' />
                                        </div>
                                        <div>
                                            <select class='form-control mb-2' name='active'>
                                                <option value='1'>Activo</option>
                                                <option value='0'>Inactivo</option>
                                            </select>
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