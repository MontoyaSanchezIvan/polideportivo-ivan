<script>
	// **** Petición y respuesta AJAX con JS tradicional ****

	peticionAjax = new XMLHttpRequest();

	function borrarPorAjax(idLibro) {
		if (confirm("¿Está seguro de que desea borrar la instalacion?")) {
			idLibroGlobal = idLibro;
			peticionAjax.onreadystatechange = borradoLibroCompletado;
			peticionAjax.open("GET", "index.php?action=borrarLibroAjax&idLibro=" + idLibro, true);
			peticionAjax.send(null);
		}
	}

	function borradoLibroCompletado() {
		if (peticionAjax.readyState == 4) {
			if (peticionAjax.status == 200) {
				idLibro = peticionAjax.responseText;
				if (idLibro == -1) {
					document.getElementById('msjError').innerHTML = "Ha ocurrido un error al borrar la instalacion";
				} else {
					document.getElementById('msjInfo').innerHTML = "Instalacion borrado con éxito";
					document.getElementById('libro' + idLibro).remove();
				}
			}
		}
	}

		
</script>



<?php
echo "<h1>Gestion Instalaciones</h1>";
echo"<h2>Menú de opciones: Usuarios | Instalaciones | Reservas</h2>";
// Mostramos info del usuario logueado (si hay alguno)
if ($this->seguridad->haySesionIniciada()) {
	echo "<p class ='nombre_usuario'>Hola, " . $this->seguridad->get("nombreUsuario") . "</p>";
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
echo "<p><a href='index.php?action=mostrarListaReservas'>Lista Reservas</a></p>";

if (count($data['listaInstalaciones']) > 0) {

	// Ahora, la tabla con los datos de los libros
	echo "<table class='tabla'  cellspacing='3' cellpadding='5' border='0' bgcolor='#A4C4D0' text-algin='centre'>";
			echo" <thead>
				<tr>
					<td style='font-size:18px'>Nombre Instalacion</td>
					<td style='font-size:18px'>Descripcion Instalacion de la reserva</td>
					<td style='font-size:18px'>Imagen Instalacion</td>
					<td style='font-size:18px'>Precio Instalacion / hora</td>
				</tr>
			</thead>
			<tbody> "; 
	
				foreach ($data['listaInstalaciones'] as $instalacion) {
				echo "<tr id='libro" . $instalacion->idInstalacion . "'>";
					echo "<td>" . $instalacion->nombre . "</td>";
					echo "<td>" . $instalacion->descripcion . "</td>";
					echo "<td><img src='" . $instalacion->imagen . "'></td>";
					echo "<td>" . $instalacion->precio . "</td>";
					
					// Los botones "Modificar" y "Borrar" solo se muestran si hay una sesión iniciada
					if ($this->seguridad->haySesionIniciada()) {
				
						echo "<td><a href='index.php?action=formularioModificarInstalacion&idInstalacion=" . $instalacion->idInstalacion . "'>Modificar</a></td>";
						echo "<td><a href='index.php?action=borrarInstalacion&idInstalacion=" . $instalacion->idInstalacion . "'>Borrar Instalacion</a></td>";
								
					}
				echo "</tr>";
			echo"</tbody>";
	}
	echo "</table>";
} else {
	// La consulta no contiene registros
	echo "No se encontraron datos";
}


	echo "<p><a href='index.php?action=formularioInsertarInstalaciones'>Nueva Instalacion</a></p>";

