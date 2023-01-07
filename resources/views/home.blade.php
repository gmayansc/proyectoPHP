<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio - Estudiantes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css">

    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.0.0/index.global.min.js'></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            var calendarEl = document.getElementById('calendar');

            var enrollments = @json($enrollments);

            enrollments.forEach(function(enrollment) {
                enrollment.horaInicio = enrollment.time_start;
                delete enrollment.time_start;
                enrollment.profesor = enrollment.Profesor;
                delete enrollment.Profesor;
                enrollment.start = enrollment.Dia;
                delete enrollment.Dia;
                enrollment.title = enrollment.Asignatura;
                delete enrollment
            });


            var calendar = new FullCalendar.Calendar(calendarEl, {
                locale: 'es',
                initialView: 'dayGridMonth',
                initialDate: '2022-12-12',
                headerToolbar: {
                    center: 'dayGridMonth,timeGridWeek'
                }, // buttons for switching between views
                events: enrollments
            });
            calendar.render();
        });
    </script>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg bg-light">
            <div class="container">
                <a class="navbar-brand" href="">Moodle PHP</a>
                <div class="left_navbar d-flex gap-4">
                    <a class="nav-link" href="modify-profile"><i class="bi bi-person-circle" style="margin-right: 10px"></i><b> {{ $student->name }} {{ $student->surname }} </b>
                        <?php if ($student->name) {
                            echo '<a class="nav-link" href="/logout">Cerrar sesión</a>';
                        } else {
                            echo '';
                        }; ?></a>
                </div>
            </div>
        </nav>
    </header>
    <section class="container mb-5">


        <div class="row mt-5 gap-3 justify-content-between">

            <div class="mis_datos col">
                <div class="student-info">
                    <h2 class="student-info__title mb-4"><i class="bi bi-person-circle" style="margin-right: 10px"></i>Mis datos:</h2>
                    <div><b>Nombre:</b> {{$student->name}} </div>
                    <div><b>Apellido:</b> {{$student->surname}} </div>
                    <div><b>Email:</b> {{$student->email}} </div>
                    <div><b>Nombre usuario:</b> {{$student->username}} </div>
                    <div><b>Teléfono:</b> {{$student->telephone}} </div>
                    <div><b>NIF: </b> {{$student->nif}} </div>
                    <div><b>Fecha de registro:</b> {{$student->date_registered}} </div>
                    <div><b>Notificaciones:</b> NO </div>
                    <div class="mt-2"><a href="modify-profile"> <i role="button" class="bi bi-pencil-square"> <b> Editar perfil </b></i></a></div>
                </div>
                <div class="student-info mt-3">
                    <h2 class="student-info__title mb-4"><i class="bi bi-journal-bookmark" style="margin-right: 10px"></i>Mis notas:</h2>
                    <table class="table">
                        <thead>
                            <th>Examen</th>
                            <th>Asignatura</th>
                            <th>Nota</th>
                        </thead>
                        <tbody>
                            @foreach ($exams as $exam)
                            <tr>
                                <td>{{ $exam->name }}</td>
                                <td>{{ $exam->classe->name }}</td>
                                <td>{{ $exam->mark }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <table class="table">
                        <thead>
                            <th>Trabajo</th>
                            <th>Asignatura</th>
                            <th>Nota</th>
                        </thead>
                        <tbody>
                            @foreach ($works as $work)
                            <tr>
                                <td>{{ $work->name }}</td>
                                <td>{{ $work->classe->name }}</td>
                                <td>{{ $work->mark }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <!-- <div class="mt-2"><a href="modify-profile"> <i role="button" class="bi bi-eye"> <b> Ver todas </b></i></a></div> -->

                </div>
            </div>


            <div class="mi_calendario col-8">
                <h2 class="mb-2">Calendario:</h2>
                <div id="calendar"></div>
            </div>

        </div>



        <div class="row mt-5 gap-3 justify-content-between">

            <div class="mis_clases col">
                <h2 class="mb-2 text-white">Mis asignaturas:</h2>
                <table class="table rounded table-dark table-hover">
                    <tr>
                        <th>Día</th>
                        <th>Asignatura</th>
                        <th>Curso</th>
                        <th>Inicio</th>
                        <th>Profesor</th>
                    </tr>

                    @foreach ($enrollments as $enrollment)
                    <tr>
                        <td>{{ $enrollment->Dia}}</td>
                        <td>{{ $enrollment->Asignatura }}</td>
                        <td>{{ $enrollment->Curso}}</td>
                        <td>{{ $enrollment->time_start }}</td>
                        <td>{{ $enrollment->Profesor }}</td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
        <div class="row mt-5 gap-3 justify-content-between">

            <div class="matricula_cursos col">
                <h2 class="mb-2">Cursos disponibles:</h2>
                <table class="table rounded table-light table-hover">
                    <tr>
                        <th>Título del curso</th>
                        <th>Matrícularme</th>
                    </tr>
                    @foreach ($courses as $course)
                    <tr>
                        <td>{{ $course->name }}</td>
                        <td>

                            <form method='POST' action='/enrollment'>
                                @csrf
                                <input type='hidden' value='{{ $student->id_student }}' name='id_student' />
                                <input type='hidden' value='{{ $course->id_course }}' name='id_course' />
                                <button type='submit'><span class="fa fa-pencil"> + </span></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>

    </section>
</body>

</html>
