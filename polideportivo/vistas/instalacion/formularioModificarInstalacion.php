<?php
    $instalacion = $data['instalacion'][0];

    echo "<h1>Modificar Instalacion</h1>";
    echo "<form action = 'index.php' method = 'POST' enctype='multipart/form-data'>
            <input type='hidden' name='id' value='$instalacion->idInstalacion'>
            Nombre:<input type='text' name='nombre' value='$instalacion->nombre'><br>
            Descripcion:<input type='text' name='descripcion' value='$instalacion->descripcion'><br>
            Imagen:<input type='file' name='imagen' value='$instalacion->imagen'><br>
            <img src=".$instalacion->imagen." width='100' height='100'><br><br>
            Precio:<input type='text' name='precio' value='$instalacion->precio'>€ por hora<br>";
        echo "<input type='hidden' name='action' value='modificarInstalacion'>
            <input type='submit'>
        </form>";
    echo "<p><a href='index.php?action=modificarInstalacion'>Volver</a></p>";