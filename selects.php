<?php
// Datos de conexión a la base de datos
$host = 'localhost'; // Si está en el mismo servidor, generalmente se usa 'localhost'
$usuario = 'u741379875_admin'; // Usuario de la base de datos
$contrasena = 'pK#43T!5QV!r'; // Contraseña del usuario de la base de datos
$nombreBD = 'u741379875_sus_adr'; // Nombre de la base de datos

// Conexión a la base de datos
$conexion = mysqli_connect($host, $usuario, $contrasena, $nombreBD);

// Verificar si la conexión fue exitosa
if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

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
        $consulta = "UPDATE sus_adr SET cant_inv_si = $cantidadInvitadosSi, telefono = '$telefono' WHERE nombre = '$nombreSeleccionado'";
        if (mysqli_query($conexion, $consulta)) {
            $mensajeExito = "¡Grabado correctamente!";
        } else {
            $mensajeExito = "Error al grabar los datos: " . mysqli_error($conexion);
        }
    }
}

// Obtener todos los datos de la tabla en un arreglo
$consulta = "SELECT nombre, cant_inv, cant_inv_si FROM sus_adr";
$resultado = mysqli_query($conexion, $consulta);
$datosTabla = array();
while ($fila = mysqli_fetch_assoc($resultado)) {
    $datosTabla[] = $fila;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Formulario de Invitados</title>
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
<body onload="actualizarSelects()">
    <h1>Formulario de Invitados</h1>
    <form method="post" action="">
        <label for="nombre">Nombre:</label>
        <select name="nombre" id="nombre" onchange="actualizarSelects()">
            <option value="">Seleccione un nombre</option>
            <?php
            // Cargar el select con los nombres y cantidades de invitados
            foreach ($datosTabla as $filaNombre) {
                $nombre = $filaNombre['nombre'];
                echo "<option value=\"$nombre\"";
                echo ">$nombre</option>";
            }
            ?>
        </select>

        <label for="cant_inv">Cantidad de Invitados:</label>
        <select name="cant_inv" id="cant_inv">
        </select>

        <label for="telefono">Teléfono:</label>
        <input type="text" name="telefono" id="telefono" />

        <input type="submit" name="submit" value="Guardar" />
    </form>

    <!-- Mostrar el mensaje de éxito si existe -->
    <?php
    if (!empty($mensajeExito)) {
        echo "<p>$mensajeExito</p>";
    }
    ?>

</body>
</html>

<?php
// Cerrar la conexión cuando ya no la necesites
mysqli_close($conexion);
?>


