
<!-- MAIN BOX -->
<!--<div id="main-box">-->

    <?php
        // Definimos nuestra zona horaria
        date_default_timezone_set("Europe/Madrid");

        // incluimos el archivo de funciones
        include 'funciones.php';

        // incluimos el archivo de configuracion
        include 'config.php';

        // Verificamos si se ha enviado el campo con name from
        if (isset($_POST['from'])) 
        {
            // Si se ha enviado verificamos que no vengan vacios
            if ($_POST['from']!="" AND $_POST['to']!="") 
            {

                // Recibimos el fecha de inicio y la fecha final desde el form

                $inicio = _formatear($_POST['from']);
                // y la formateamos con la funcion _formatear

                $final  = _formatear($_POST['to']);

                // Recibimos el fecha de inicio y la fecha final desde el form

                $inicio_normal = $_POST['from'];

                // y la formateamos con la funcion _formatear
                $final_normal  = $_POST['to'];

                // Recibimos los demas datos desde el form
                $titulo = evaluar($_POST['title']);

                // y con la funcion evaluar
                $body   = evaluar($_POST['event']);

                // reemplazamos los caracteres no permitidos
                $clase  = evaluar($_POST['class']);

                // insertamos el evento
                $query="INSERT INTO eventos VALUES(null,'$titulo','$body','','$clase','$inicio','$final','$inicio_normal','$final_normal')";

                // Ejecutamos nuestra sentencia sql
                $conexion->query($query); 

                // Obtenemos el ultimo id insetado
                $im=$conexion->query("SELECT MAX(id) AS id FROM eventos");
                $row = $im->fetch_row();  
                $id = trim($row[0]);

                // para generar el link del evento
                $link = "$base_url"."descripcion_evento.php?id=$id";

                // y actualizamos su link
                $query="UPDATE eventos SET url = '$link' WHERE id = $id";

                // Ejecutamos nuestra sentencia sql
                $conexion->query($query); 

                // redireccionamos a nuestro calendario
                header("Location:$base_url"); 
            }
        }
    ?>

    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="utf-8">
        <title>Calendario</title>
        <link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">    
        <link rel="stylesheet" href="<?=$base_url?>css/calendar.css">
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
        <script type="text/javascript" src="<?=$base_url?>js/es-ES.js"></script>
        <script src="<?=$base_url?>js/jquery.min.js"></script>
        <script src="<?=$base_url?>js/moment.js"></script>
        <script src="<?=$base_url?>js/bootstrap.min.js"></script>
        <script src="<?=$base_url?>js/bootstrap-datetimepicker.js"></script>
        <link rel="stylesheet" href="<?=$base_url?>css/bootstrap-datetimepicker.min.css" />
    <script src="<?=$base_url?>js/bootstrap-datetimepicker.es.js"></script>
    <link rel="stylesheet" type="text/css" href="../assets/css/styles.css">
    </head>

    <body style="background: white;">

        <div class="container">
            <div class="row">
                <div class="page-header"><h2></h2></div>
                    <div class="pull-left form-inline"><br>
                        <div class="btn-group">
                            <button class="btn btn-primary" data-calendar-nav="prev"><< Anterior</button>
                            <button class="btn" data-calendar-nav="today">Hoy</button>
                            <button class="btn btn-primary" data-calendar-nav="next">Siguiente >></button>
                        </div>
                        <div class="btn-group">
                            <button class="btn btn-warning" data-calendar-view="year">Año</button>
                            <button class="btn btn-warning active" data-calendar-view="month">Mes</button>
                            <button class="btn btn-warning" data-calendar-view="week">Semana</button>
                            <button class="btn btn-warning" data-calendar-view="day">Dia</button>
                        </div>
                    </div>
                    <div class="pull-right form-inline"><br>
                        <button class="btn btn-info" data-toggle='modal' data-target='#add_evento'>Modificar perfil</button>
                    </div>
                </div><hr>

                <div class="row">
                        <div id="calendar"></div> <!-- Aqui se mostrara nuestro calendario -->
                        <br><br>
                </div>

                <!--ventana modal para el calendario-->
                <div class="modal fade" id="events-modal">
                    <div class="modal-dialog">
                            <div class="modal-content">
                                    <div class="modal-body" style="height: 400px">
                                        <p>One fine body&hellip;</p>
                                    </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                </div>
                            </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
            </div>

            <script src="<?=$base_url?>js/underscore-min.js"></script>
            <script src="<?=$base_url?>js/calendar.js"></script>
            <script type="text/javascript">
                (function($){
                        //creamos la fecha actual
                        var date = new Date();
                        var yyyy = date.getFullYear().toString();
                        var mm = (date.getMonth()+1).toString().length == 1 ? "0"+(date.getMonth()+1).toString() : (date.getMonth()+1).toString();
                        var dd  = (date.getDate()).toString().length == 1 ? "0"+(date.getDate()).toString() : (date.getDate()).toString();

                        //establecemos los valores del calendario
                        var options = {

                            // definimos que los eventos se mostraran en ventana modal
                                modal: '#events-modal', 

                                // dentro de un iframe
                                modal_type:'iframe',    

                                //obtenemos los eventos de la base de datos
                                events_source: '<?=$base_url?>obtener_eventos.php', 

                                // mostramos el calendario en el mes
                                view: 'month',             

                                // y dia actual
                                day: yyyy+"-"+mm+"-"+dd,   


                                // definimos el idioma por defecto
                                language: 'es-ES', 

                                //Template de nuestro calendario
                                tmpl_path: '<?=$base_url?>tmpls/', 
                                tmpl_cache: false,


                                // Hora de inicio
                                time_start: '08:00', 

                                // y Hora final de cada dia
                                time_end: '22:00',   

                                // intervalo de tiempo entre las hora, en este caso son 30 minutos
                                time_split: '30',    

                                // Definimos un ancho del 100% a nuestro calendario
                                width: '100%', 

                                onAfterEventsLoad: function(events)
                                {
                                        if(!events)
                                        {
                                                return;
                                        }
                                        var list = $('#eventlist');
                                        list.html('');

                                        $.each(events, function(key, val)
                                        {
                                                $(document.createElement('li'))
                                                        .html('<a href="' + val.url + '">' + val.title + '</a>')
                                                        .appendTo(list);
                                        });
                                },
                                onAfterViewLoad: function(view)
                                {
                                        $('.page-header h2').text(this.getTitle());
                                        $('.btn-group button').removeClass('active');
                                        $('button[data-calendar-view="' + view + '"]').addClass('active');
                                },
                                classes: {
                                        months: {
                                                general: 'label'
                                        }
                                }
                        };

                        // id del div donde se mostrara el calendario
                        var calendar = $('#calendar').calendar(options); 

                        $('.btn-group button[data-calendar-nav]').each(function()
                        {
                                var $this = $(this);
                                $this.click(function()
                                {
                                        calendar.navigate($this.data('calendar-nav'));
                                });
                        });

                        $('.btn-group button[data-calendar-view]').each(function()
                        {
                                var $this = $(this);
                                $this.click(function()
                                {
                                        calendar.view($this.data('calendar-view'));
                                });
                        });

                        $('#first_day').change(function()
                        {
                                var value = $(this).val();
                                value = value.length ? parseInt(value) : null;
                                calendar.setOptions({first_day: value});
                                calendar.view();
                        });
                }(jQuery));
            </script>

            <!-- Mostrar errores formulario -->
            <?php if(isset($_SESSION['completado'])): // Si existe...?>
                <div class="alerta alerta-exito">
                    <?= $_SESSION['completado']; ?>
                </div>
            <?php elseif(isset($_SESSION['errores']['general'])): ?>
                <div class="alerta alerta-error">
                    <?= $_SESSION['errores'] ['general']; ?>
                </div>            
            <?php endif; ?>            
            
            <!-- Formulario editar datos estudiante -->
            <div class="modal fade" id="add_evento" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel">Modifica tus datos</h4>
                        </div>
                        <div class="modal-body">

                            <!-- Formulario -->    
                            <form action="update-user.php" method="POST">
                                <label for="email">Email</label>
                                <input type="email" name="email" value="<?=$_SESSION['student']['email'];?>"/>
                                <?php echo isset($_SESSION['errores']) ? showError($_SESSION['errores'],'email') :'';?>  
                                
                                <label for="name">Nombre</label>
                                <input type="text" name="name" value="<?=$_SESSION['student']['name'];?>"/>
                                <?php echo isset($_SESSION['errores']) ? showError($_SESSION['errores'],'name') :'';?>

                                <label for="surname">Apellidos</label>
                                <input type="text" name="surname" value="<?=$_SESSION['student']['surname'];?>"/>
                                <?php echo isset($_SESSION['errores']) ? showError($_SESSION['errores'],'surname') :'';?>          
                            
                                <?php deleteErrors(); ?>
                        
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Cancelar</button>
                                    <button type="submit" class="btn btn-success" name="submit"><i class="fa fa-check"></i> Guardar</button>
                                </div>
                            </form>                                
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    </html>              
</div>

