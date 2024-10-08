<?php
include 'connect.php';

// Función para obtener la cantidad de invitados según el nombre seleccionado
function obtenerCantidadInvitados($conexion, $nombreSeleccionado)
{
    $consulta = "SELECT cant_inv_si FROM sus_adr WHERE nombre = '$nombreSeleccionado'";
    $resultado = mysqli_query($conexion, $consulta);
    if ($fila = mysqli_fetch_assoc($resultado)) {
        return $fila['cant_inv_si'];
    }
    return 0;
}

// Procesar el formulario cuando se envíe
$mensajeExito = ""; // Variable para almacenar el mensaje de éxito
if (isset($_POST['submit'])) {
    $nombreSeleccionado = $_POST['nombre'];
    $cantidadInvitadosSi = $_POST['cant_inv'];
    $telefono = $_POST['telefono'];

    // Actualizar la cantidad de invitados y el teléfono si existe un nombre seleccionado
    if (!empty($nombreSeleccionado)) {
            $mensajeExito = "¡Gracias por confirmar su asistencia!";
    }
}

// Obtener todos los datos de la tabla en un arreglo
$consulta = "SELECT nombre, cant_inv, cant_inv_si FROM sus_adr  ORDER BY nombre";
$resultado = mysqli_query($conexion, $consulta);
$datosTabla = array();
while ($fila = mysqli_fetch_assoc($resultado)) {
    $datosTabla[] = $fila;
}
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" type="image/x-icon" href="img/favicon.ico">
        <!-- Bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
        <!-- Font Awesome -->
        <script src="https://kit.fontawesome.com/95127a07f0.js" crossorigin="anonymous"></script>
        <!-- CSS -->
        <link rel="stylesheet" href="css/style.css">

        <!-- Fonts -->
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;700&display=swap');
        </style>
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&family=Dancing+Script:wght@400;700&display=swap');
        </style>

        <title>Invita.Top - Susana y Adrián</title>
        
        <script>
        // Arreglo para almacenar los datos de la tabla
        var datosTabla = <?php echo json_encode($datosTabla); ?>;

        function actualizarSelects() {
            var nombreSelect = document.getElementById('nombre');
            var cantInvSelect = document.getElementById('cant_inv');

            // Obtener el nombre seleccionado
            var nombreSeleccionado = nombreSelect.value;

            // Limpiar el select de cant_inv
            cantInvSelect.innerHTML = '';

            // Buscar los datos del nombre seleccionado en el arreglo
            var datosSeleccionados = datosTabla.find(function (dato) {
                return dato.nombre === nombreSeleccionado;
            });

            if (datosSeleccionados) {
                var cantInv = parseInt(datosSeleccionados.cant_inv);

                // Agregar las opciones al select de cant_inv
                for (var i = 0; i <= cantInv; i++) {
                    var option = document.createElement('option');
                    option.value = i;
                    option.text = i;
                    cantInvSelect.appendChild(option);
                }

                // Seleccionar la cantidad de invitados actual si está definida
                var cantInvSi = parseInt(datosSeleccionados.cant_inv_si);
                cantInvSelect.value = isNaN(cantInvSi) ? 0 : cantInvSi;
            }
        }
    </script>
    </head>
    <body id="ini" class="bg-pri txt-sec"  onload="actualizarSelects()">
    
        <div class="container-fluid m-0 p-0">
        
            <nav class="navbar navbar-expand-lg shadow w-100 menu  navbar-fixed-top position-fixed p-0" style="z-index:1000;">
                <div class="container-fluid">
                    <a class="navbar-brand cursiva txt-pri" href="#ini"><h1 class="m-0">Susana & Adrián</h1></a>
                    <button class="navbar-toggler border border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link" href="#menu-dia">Día</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#menu-itinerario">Itinerario</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#menu-cuando">Cuándo & Dónde</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#menu-info">Información</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#asistencia">Asistencia</a>
                            </li>
                            
                            <li class="nav-item">
                                <a class="nav-link" href="#menu-galeria">Galería</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <section class="bg-pri vh-100 vw-100 d-flex justify-content-center align-items-center bg1">
                <div class="text-center">
                    <h2>NOS CASAMOS</h2>
                    <h2 class="cursiva display-2 m-4">Susana & Adrián</h2>
                    <h3>01.09.23</h3>
                </div>
            </section>

            <section class="bg-white vw-100 text-center text-dark d-flex justify-content-center align-items-center p-5">
                <div class="container p-4">
                   <p class="fw-bold">Mensaje para los invitados:</p> 
                   <p>A los 1825 días de novios, hemos decidido juntar nuestras vidas, te conocemos y hemos convivido, aunque sea un momento, claramente aportaste algo a nuestra historia de amor y queremos que nos acompañes en el día en que todo vuelve a iniciar y perdurara hasta la eternidad… Nuestra Boda.</p> 

                   <p class="fw-bold">Pensamiento entre los novios:</p>
                   <p>Contaría cada estrella en el cielo junto a su reflejo en el agua del mar y los granos de arena de cada playa en el mundo solo para explicar el amor infinito que te tengo.</p>
                </div>
            </section>

            <section id="menu-dia" class="bg-pri vw-100 d-flex justify-content-center align-items-center bg2 py-5">
                <div class="text-center">
                    <h2 class="cursiva">Nuestro Día</h2>

                    <div id="dia" class="m-4"></div>
                    <div style="font-size: 24px;">Viernes, 01 de Septiembre de 2023</div>

                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <div class="card bg-transparent m-3" style="border:none;">
                                <span id="days" class="display-1 mt-4 cursiva txt-light"></span>
                                <div class="card-body pt-0">
                                    <h5 class="card-title">días</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="card bg-transparent m-3" style="border:none;">
                                <span id="hours" class="display-1 mt-4 cursiva txt-light"></span>
                                <div class="card-body pt-0">
                                    <h5 class="card-title">Horas</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="card bg-transparent m-3" style="border:none;">
                                <span id="minutes" class="display-1 mt-4 cursiva txt-light"></span>
                                <div class="card-body pt-0">
                                    <h5 class="card-title">Minutos</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="card bg-transparent m-3" style="border:none;">
                                <span id="seconds" class="display-1 mt-4 cursiva txt-light"></span>
                                <div class="card-body pt-0">
                                    <h5 class="card-title">Segundos</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section id="menu-itinerario" class="bg-white vw-100 text-center text-dark d-flex justify-content-center align-items-center p-3">

                <div class="container">

                    <h2 class="cursiva mt-5 txt-light">Itinerario</h2>
                    <div class="row">
                        <div class="col-4 p-4 d-flex align-items-center justify-content-center">
                            <i class="fas fa-church display-1 txt-pri"></i>
                        </div>
                        <div class="col-8 p-4">
                            <div class="d-inline-block rounded p-3 w-100 bg-sec">
                                <h3 class="cursiva mb-4 txt-pri">Ceremonia Religiosa</h3>
                                <p><b>19:00</b> Horas</p> 
                                <p><a href="https://goo.gl/maps/maz3U1v1xS3HbQ4w8" target="_blank"><i class="fas fa-map-pin"></i> Parroquia de San Jeronimo De Monterrey</a></p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4 p-4 d-flex align-items-center justify-content-center">
                            <i class="fas fa-glass-cheers display-1 txt-pri"></i>
                        </div>
                        <div class="col-8 p-4">
                            <div class="d-inline-block rounded p-3 w-100 bg-sec">
                                <h3 class="cursiva mb-4 txt-pri">Recepción</h3>
                                <p><b>20:30</b> Horas</p> 
                                <p><a href="https://goo.gl/maps/HYTrgtR2RFMmqhuv6" target="_blank"><i class="fas fa-map-pin"></i> LUX Eventos - Salón Panorámico</a></p>
                            </div>
                        </div>
                    </div>
                        
                </div>        

            </section>

            <!--CUANDO DONDE-->
            <section id="menu-cuando" class="bg-white vw-100 text-center text-dark d-flex justify-content-center align-items-center p-3">
                <div class="container">

                    <h2 class="cursiva mt-5 txt-light">¿Cuándo & Dónde?</h2>
                    <div class="container p-4">
                            A continuación encontrarás el horario y ubicación de los eventos de nuestra boda, así como un botón directo a Google Maps para que te sea más fácil llegar al lugar.
                    </div>
                        
                    <div class="row">
                        <div class="col-12 col-sm-6 col-lg-3 p-0 m-0 d-flex align-items-stretch">
                            <img src="img/iglesia.jpg" class="img-fluid w-100 img-galeria" alt="Parroquia de San Jeronimo De Monterrey">
                        </div>
                        <div class="col-12 col-sm-6 col-lg-3 p-0 m-0 d-flex align-items-stretch">
                            <div class="d-inline-block p-3 w-100 bg-sec">
                                <h3 class="cursiva mb-4 txt-pri">Iglesia</h3>
                                <div class="txt-pri">
                                    <i class="far fa-calendar-alt"></i>
                                    <BR>
                                    VIERNES <BR>
                                    01 DE SEPTIEMBRE <br>
                                    DE 2023 <br>
                                    <i class="far fa-clock"></i>
                                    <p><b>19:00</b> Horas</p> 
                                </div>
                                <p><a href="https://goo.gl/maps/maz3U1v1xS3HbQ4w8" target="_blank"><i class="fas fa-map-pin"></i> Parroquia de San Jeronimo De Monterrey</a></p>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-lg-3 p-0 m-0 d-flex align-items-stretch">
                            <img src="img/salon2.jpg" class="img-fluid w-100 img-galeria" alt="LUX Eventos - Salón Panorámico">
                        </div>
                        <div class="col-12 col-sm-6 col-lg-3 p-0 m-0 d-flex align-items-stretch">
                            <div class="d-inline-block p-3 w-100 bg-sec">
                                <h3 class="cursiva mb-4 txt-pri">Salón</h3>
                                <div class="txt-pri">
                                    <i class="far fa-calendar-alt"></i>
                                    <BR>
                                    VIERNES <BR>
                                    01 DE SEPTIEMBRE <br>
                                    DE 2023 <br>
                                    <i class="far fa-clock"></i>
                                    <p><b>20:30</b> Horas</p> 
                                </div>
                                <p><a href="https://goo.gl/maps/HYTrgtR2RFMmqhuv6" target="_blank"><i class="fas fa-map-pin"></i> LUX Eventos - Salón Panorámico</a></p>
                            </div>
                        </div>
                    </div>

                </div>   
            </section>

            <!--INFORMACION-->
            <section id="menu-info" class="bg-white vw-100 text-center text-dark d-flex justify-content-center align-items-center p-3">
                <div class="container">

                    <h2 class="cursiva my-4 txt-pri">Regalos</h2>
                    Agradeceríamos su generosidad al considerar nuestras opciones de regalo
                    <div class="container p-4">
                        
                        <img src="img/sobre2.jpg" alt="Sobre" width="140">
                        <br>
                        Sobre
                        <br>
                        o <br>
                        <a href="https://mesaderegalos.liverpool.com.mx/milistaderegalos/50948665" target="_blank"><i class="fas fa-link"></i> Ver Mesa de Regalos</a>
                    </div>

                    <h2 class="cursiva my-4 txt-pri">Código de Vestimenta</h2>
                    <div class="container p-4">
                        <img src="img/vestimenta.jpg" alt="Vestimenta" width=120>
                        <br>
                        Formal
                    </div>

                    <h2 class="cursiva my-4 txt-pri">Recomendación de los Novios</h2>
                    <div class="container p-4">
                        <img src="img/tenis.jpg" alt="Tenis" width=130>
                        <br>
                        (Todos Formal Tenis Blancos)
                    </div>
                </div>    
            </section>

            <!--ASISTENCIA-->
            <section id="asistencia" class="bg-white vw-100 text-center text-dark d-flex justify-content-center align-items-center p-3">
                <div class="container">

                    <h2 class="cursiva mt-4 txt-light">Asistencia</h2>
                    <p>Confirma tu Asistencia seleccionando tu nombre y la cantidad de asistentes</p>
                    <p>En esta ocasión, nuestra invitación no podemos extenderla a los niños. Gracias por su comprensión</p>
                    <form method="post" action="#asistencia">
                        <label for="nombre" class="m-2">Nombre:
                        <select class="form-select" name="nombre" id="nombre" onchange="actualizarSelects()">
                            <option value="">Seleccione un nombre</option>
                            <?php
                            // Cargar el select con los nombres y cantidades de invitados
                            foreach ($datosTabla as $filaNombre) {
                                $nombre = $filaNombre['nombre'];
                                echo "<option value=\"$nombre\"";
                                echo ">$nombre</option>";
                            }
                            ?>
                        </select></label>
                
                        <label for="cant_inv" class="m-2">Asistentes:
                        <select class="form-select" name="cant_inv" id="cant_inv">
                        </select></label>
                
                        <label for="telefono" class="m-2">Teléfono:
                        <input class="form-control" type="number" name="telefono" id="telefono" /></label>
                
                        <input class="btn btn-outline-primary m-2" type="submit" name="submit" value="Guardar" />
                    </form>
                
                    <!-- Mostrar el mensaje de éxito si existe -->
                    <?php
                    if (!empty($mensajeExito)) {
                        echo "<div class='alert alert-success m-2'>$mensajeExito</div>";
                    }
                    include connection-close.php;
                    ?>

                </div>    
            </section>

            <!--GALERIA-->
            <section id="menu-galeria" class="bg-white vw-100 text-center text-dark d-flex justify-content-center align-items-center p-3">
                <div class="container">

                    <h2 class="cursiva mt-4 txt-light">Galería</h2>
                    <div class="container p-4">
                        <div class="row">
                            <div class="col-12 col-sm-6 col-md-3 p-3 d-flex align-items-stretch">
                                <div style="background-image: url('img/img3.jpg'); height:200px;" class="img-fluid w-100 img-galeria" alt=""></div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-3 p-3 d-flex align-items-stretch">
                                <div style="background-image: url('img/img4.jpg'); height:200px;" class="img-fluid w-100 img-galeria" alt=""></div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-3 p-3 d-flex align-items-stretch">
                                <div style="background-image: url('img/img5.jpg'); height:200px;" class="img-fluid w-100 img-galeria" alt=""></div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-3 p-3 d-flex align-items-stretch">
                                <div style="background-image: url('img/img6.jpg'); height:200px;" class="img-fluid w-100 img-galeria" alt=""></div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-3 p-3 d-flex align-items-stretch">
                                <div style="background-image: url('img/img7.jpg'); height:200px;" class="img-fluid w-100 img-galeria" alt=""></div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-3 p-3 d-flex align-items-stretch">
                                <div style="background-image: url('img/img8.jpg'); height:200px;" class="img-fluid w-100 img-galeria" alt=""></div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-3 p-3 d-flex align-items-stretch">
                                <div style="background-image: url('img/img9.jpg'); height:200px;" class="img-fluid w-100 img-galeria" alt=""></div>
                            </div>
                        </div>
                    </div>

                </div>    
            </section>

        </div>       
       
    </body>
</html>


<script>

    // VARIABLES
const DATE_TARGET = new Date('09/01/2024 07:00 PM');
// DOM for render
const SPAN_DAYS = document.querySelector('span#days');
const SPAN_HOURS = document.querySelector('span#hours');
const SPAN_MINUTES = document.querySelector('span#minutes');
const SPAN_SECONDS = document.querySelector('span#seconds');
// Milliseconds for the calculations
const MILLISECONDS_OF_A_SECOND = 1000;
const MILLISECONDS_OF_A_MINUTE = MILLISECONDS_OF_A_SECOND * 60;
const MILLISECONDS_OF_A_HOUR = MILLISECONDS_OF_A_MINUTE * 60;
const MILLISECONDS_OF_A_DAY = MILLISECONDS_OF_A_HOUR * 24

// FUNCTIONS
function updateCountdown() {
    // Calcs
    const NOW = new Date()
    const DURATION = DATE_TARGET - NOW;
    const REMAINING_DAYS = Math.floor(DURATION / MILLISECONDS_OF_A_DAY);
    const REMAINING_HOURS = Math.floor((DURATION % MILLISECONDS_OF_A_DAY) / MILLISECONDS_OF_A_HOUR);
    const REMAINING_MINUTES = Math.floor((DURATION % MILLISECONDS_OF_A_HOUR) / MILLISECONDS_OF_A_MINUTE);
    const REMAINING_SECONDS = Math.floor((DURATION % MILLISECONDS_OF_A_MINUTE) / MILLISECONDS_OF_A_SECOND);
    // Thanks Pablo Monteserín (https://pablomonteserin.com/cuenta-regresiva/)

    // Render
    if (REMAINING_DAYS <= 0 && REMAINING_HOURS <= 0 && REMAINING_MINUTES <= 0 && REMAINING_SECONDS <= 0){
        SPAN_DAYS.textContent = 0;
        SPAN_HOURS.textContent = 0;
        SPAN_MINUTES.textContent = 0;
        SPAN_SECONDS.textContent = 0;
        return;
    }
    SPAN_DAYS.textContent = REMAINING_DAYS;
    SPAN_HOURS.textContent = REMAINING_HOURS;
    SPAN_MINUTES.textContent = REMAINING_MINUTES;
    SPAN_SECONDS.textContent = REMAINING_SECONDS;
}



// INIT
updateCountdown();
// Refresh every second
setInterval(updateCountdown, MILLISECONDS_OF_A_SECOND);

</script>