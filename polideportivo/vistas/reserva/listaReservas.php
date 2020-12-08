<?php
    echo "<h1>Gestion de Usuarios</h1>";
    echo"<h2>Menú de opciones: Usuarios | Instalaciones | Reservas</h2>";
    // Mostramos info del usuario logueado (si hay alguno)
    if ($this->seguridad->haySesionIniciada()) {
        echo "<p class ='nombre_usuario'>Hola, " . $this->seguridad->get("nombreUsuario") . "</p>";
        //echo "<p align='right'><img width='50' src='" . $this->seguridad->get("fotografiaUsuario") . "'></p>";
    }
    // Mostramos mensaje de error o de información (si hay alguno)
    if (isset($data['msjError'])) {
        echo "<p style='color:red' id='msjError'>" . $data['msjError'] . "</p>";
    } else {
        echo "<p style='color:red' id='msjError'></p>";
    }
    if (isset($data['msjInfo'])) {
        echo "<p style='color:blue' id='msjInfo'>" . $data['msjInfo'] . "</p>";
    } else {
        echo "<p style='color:blue' id='msjInfo'></p>";
    }

    // Enlace a "Iniciar sesión" o "Cerrar sesión"
    if (isset($_SESSION["idUsuario"])) {
        echo "<p><a href='index.php?action=cerrarSesion'>Cerrar sesión</a></p>";
    } else {
        echo "<p><a href='index.php?action=mostrarFormularioLogin'>Iniciar sesión</a></p>";
    }
    
    echo "<p><a href='index.php?action=mostrarListaUsuarios'>Lista Ususarios</a></p>";
    echo "<p><a href='index.php?action=mostrarListaInstalaciones'>Lista Instalaciones</a></p>";
     
   
    
