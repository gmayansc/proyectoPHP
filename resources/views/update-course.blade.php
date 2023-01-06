
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Actualizar Curso</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper {
            width: 600px;
            margin: 0 auto;
        }
    </style>
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
                    <h2 class="mt-5">Actualizar curso</h2>
                    <p>Edita los datos de este formulario para actualizar la información del curso.</p>
                    <form action="update-course-submit" method="get">
                        <div class="form-group">
                            <label>Nombre del curso</label>
                            <input required type="text" name="name" class="form-control" value="{{$course->name}}">
                        </div>
                        <div class="form-group">
                            <label>Descripción del curso</label>
                            <textarea required name="description" class="form-control">{{$course->description}}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Fecha inicio</label>
                            <input required type="date" name="date_start" class="form-control" value="{{$course->date_start}}">
                        </div>
                        <div class="form-group">
                            <label>Fecha fin</label>
                            <input required type="date" name="date_end" class="form-control" value="{{$course->date_end}}">
                        </div>
                        <div class="form-group">
                            <label>Activo</label>
                            <input type="checkbox" name="active" <?php echo (($course->active == 1)) ? 'checked' : ''; ?> class="form-control" value="active">
                        </div>
                        <input required type="hidden" name="id_course" value="{{$course->id_course}}" />
                        <input required type="submit" class="btn btn-primary" value="Modificar">
                        <a href="/courses" class="btn btn-secondary ml-2">Cancelar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
