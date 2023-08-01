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

        <title>Invita.Top - Lista de Invitados - Susana y Adrián</title>
    </head>
    <body id="ini" class="bg-pri txt-sec">
    
        <div class="container m-0 p-4">
            
            <h1 class="txt-pri">Lista de Invitados</h1>

            <?php
            include 'connect.php';
            
            // Consulta para obtener todos los datos de la tabla "sus_adr"
            $consulta = "SELECT * FROM sus_adr ORDER BY nombre";
            
            // Ejecutar la consulta
            $resultado = mysqli_query($conexion, $consulta);
            
            // Verificar si hay resultados
            if (mysqli_num_rows($resultado) > 0) {
                echo "<table class='table'>";
                echo "<tr>";
                echo "<th>Clave</th>";
                echo "<th>Nombre</th>";
                echo "<th>Cantidad de Invitados</th>";
                echo "<th>Cantidad de Invitados (si)</th>";
                echo "<th>Teléfono</th>";
                echo "</tr>";
            
                // Recorrer y mostrar los datos obtenidos
                while ($fila = mysqli_fetch_assoc($resultado)) {
                    echo "<tr>";
                    echo "<td>" . $fila["clave"] . "</td>";
                    echo "<td>" . $fila["nombre"] . "</td>";
                    echo "<td>" . $fila["cant_inv"] . "</td>";
                    echo "<td>" . $fila["cant_inv_si"] . "</td>";
                    echo "<td>" . $fila["telefono"] . "</td>";
                    echo "</tr>";
                }
            
                echo "</table>";
            } else {
                echo "No se encontraron registros en la tabla.";
            }
            
            // Cerrar la conexión cuando ya no la necesites
            include 'connection-close.php'
            ?>
            
        </div>       
       
    </body>
</html>
