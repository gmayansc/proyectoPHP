<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
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
                <a class="navbar-brand" href="../home-admin.php">Moodle PHP</a>
            </div>
        </nav>
    </header>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="mt-5 mb-3 clearfix">
                        <h2 class="pull-left">Todos los cursos</h2>
                        <a href="create-courses.php" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Añadir nuevo curso</a>
                    </div>


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
                                <td>{{$course->id_course}}</td>
                                <td>{{$course->name}}</td>
                                <td>{{$course->description}}</td>
                                <td>{{$course->date_start}}</td>
                                <td>{{$course->date_end}}</td>
                                <?php if ($course->active == 1) {
                                            echo "<td> SÍ </td>";
                                        } else {
                                            echo "<td> NO </td>";
                                        }?>
                                <td><a href="update-courses.php?id_course={{$course->id_course}}" class="mr-3" title="Update Record" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>
                                    <a href="delete-courses.php?id_course='. $row['id_course'] .'" title="Delete Record" data-toggle="tooltip"><span class="fa fa-trash"></span></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>