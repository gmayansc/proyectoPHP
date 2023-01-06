<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
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
                        <h2 class="pull-left">Clases</h2>
                    </div>

                    <div class="accordion" id="accordionPanelsStayOpenExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                                    Todas las clases
                                </button>
                            </h2>
                            <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingOne">
                                <div class="accordion-body">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Nombre</th>
                                                <th>Profesor</th>
                                                <th>Dia</th>
                                                <th>Hora inicio</th>
                                                <th>Hora Fin</th>
                                                <th>Color</th>
                                                <th>Editar</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($classes as $classe)
                                            <tr>
                                                <td>{{$classe->id_class}}</td>
                                                <td>{{$classe->name}}</td>
                                                <td>{{$classe->teacher->name}}</td>
                                                <td>{{$classe->schedule->day}}</td>
                                                <td>{{$classe->schedule->time_start}}</td>
                                                <td>{{$classe->schedule->time_end}}</td>
                                                <td>
                                                    <div style="height: 30px; width:100%; background-color: {{$classe->color}}; border-radius:2px;">
                                                </td>
                                                <td>
                                                    <form method='POST' action='/delete-classes'>
                                                        @csrf
                                                        <input type='hidden' value='{{ $classe->id }}' name='id' />
                                                        <button type='submit'><span class="fa fa-trash"></span>BORRAR</button>
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
                                    + Añadir nueva clase
                                </button>
                            </h2>
                            <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingTwo">
                                <div class="accordion-body">
                                    <h2>Crear nueva clase</h2>
                                    <form class="col-5 m-auto" method='get' action='/create-classes'>
                                        @csrf
                                        <div>
                                            <span>Escoja el profesor</span>
                                            <select required class='form-control mb-2' placeholder='Nombre del profesor' name='id_teacher'>
                                                @foreach ($teachers as $teacher)
                                                <option value="{{ $teacher->id_teacher }}">{{ $teacher->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div>
                                            <span>Escoja el curso</span>
                                            <select required class='form-control mb-2' placeholder='Nombre del curso' name='id_course'>
                                                @foreach ($courses as $course)
                                                <option value="{{ $course->id_course }}">{{ $course->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div>
                                            <span>Nombre de la clase</span>
                                            <input required class='form-control mb-2' placeholder='Nombre de la clase' name='name' />
                                        </div>
                                        <div>
                                            <span>Color de la clase</span>
                                            <input required class='form-control mb-2' placeholder='Color de la clase' type='color' name='color' />
                                        </div>
                                        <div>
                                            <span>Día de la clase</span>
                                            <input required class='form-control mb-2' placeholder='Fecha de inicio' type='date' name='day' />

                                        </div>
                                        <div>
                                            <label for="date_start">Hora de inicio</label>
                                            <input required class='form-control mb-2' placeholder='Hora de inicio' type='time' name='time_start' />
                                        </div>
                                        <div>
                                            <label for="date_end">Hora de fin</label>
                                            <input required class='form-control mb-2' placeholder='Hora de fin' type='time' name='time_end' />
                                        </div>
                                        <div class="text-center">
                                            <button class="btn btn-primary align-center col-4" type='submit'>Añadir clase</button>
                                        </div>
                                </div>
                            </div>
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