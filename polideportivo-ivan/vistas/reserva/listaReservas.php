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

    
    if (count($data['listaReservas']) > 0) {
        
    echo "<table class='tabla'  cellspacing='3' cellpadding='5' border='0' bgcolor='#A4C4D0' text-algin='centre' >";
           echo" <thead>
                <tr>
                    <td style='font-size:18px'>Fecha de la reserva</td>
                    <td style='font-size:18px'>Hora de la reserva</td>
                    <td style='font-size:18px'>Precio de la reserva</td>
                    <td style='font-size:18px'>Creador de la reserva</td>
                </tr>
            </thead>
            <tbody> ";   
            foreach ($data['listaReservas'] as $reserva) {
                echo "<tr id='usuario" . $reserva->idReserva . "'>";
                echo "<td >" . $reserva->fecha . "</td>";
                echo "<td>" . $reserva->hora . "</td>";
                echo "<td>" . $reserva->precio . "</td>";
                echo "<td>" . $reserva->id_usuario . "</td>";        
                
                // Los botones "Modificar" y "Borrar" solo se muestran si hay una sesión iniciada
                if ($this->seguridad->haySesionIniciada()) {
                        echo "<td><a href='index.php?action=formularioModificarReserva&idReserva=" . $reserva->idReserva . "'>Modificar</a></td>";
                        echo "<td><a href='index.php?action=borrarReserva&idReserva=" . $reserva->idReserva . "'>Borrar Reserva</a></td>";
                }
                    echo "</tr>";
            echo"</tbody>";
	}
    echo "</table>";
    echo "<p><a href='index.php?action=formularioInsertarReserva'>Nuevo</a></p>";
    }
     
   
    
