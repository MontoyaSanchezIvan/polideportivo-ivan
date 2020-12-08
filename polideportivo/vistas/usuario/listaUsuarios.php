<script>
	// **** Petición y respuesta AJAX con JS tradicional ****

	peticionAjax = new XMLHttpRequest();

	function borrarPorAjax(idUsuario) {
		if (confirm("¿Está seguro de que desea borrar el Usuario?")) {
			idUsuarioGlobal = idUsuario;
			peticionAjax.onreadystatechange = borradoUsuarioCompletado;
			peticionAjax.open("GET", "index.php?action=borrarUsuarioAjax&idUsuario=" + idUsuario, true);
			peticionAjax.send(null);
		}
	}

	function borradoUsuarioCompletado() {
		if (peticionAjax.readyState == 4) {
			if (peticionAjax.status == 200) {
				idUsuario = peticionAjax.responseText;
				if (idUsuario == -1) {
					document.getElementById('msjError').innerHTML = "Ha ocurrido un error al borrar el usuario";
				} else {
					document.getElementById('msjInfo').innerHTML = "Usuario borrado con éxito";
					document.getElementById('usuario' + idUsuario).remove();
				}
			}
		}
	}

	// **** Petición y respuesta AJAX con jQuery ****

	$(document).ready(function() {
		$(".btnBorrar").click(function() {
			if (confirm("¿Está seguro de que desea borrar el usuario?")) {
				$.get("index.php?action=borrarUsuarioAjax&idUsuario=" + this.id, null, function(idUsuarioBorrado) {
					if (idUsuarioBorrado == -1) {
						$('#msjError').html("Ha ocurrido un error al borrar el usuario");
					} else {
						$('#msjInfo').html("Usuario borrado con éxito");
						$('#usuario' + idUsuarioBorrado).remove();
					}
				});
			}
		});
	});
</script>



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

/*// Primero, el formulario de búsqueda
echo "<form action='index.php'>
			<input type='hidden' name='action' value='buscarLibros'>
           	<input type='text' name='textoBusqueda'>
			<input type='submit' value='Buscar'>
			</form><br>";*/
echo"<div class=enlaces>";

	echo "<div class=enlaceInstalaciones
			<p><a href='index.php?action=mostrarListaInstalaciones' text-align: left;>Lista Instalaciones</a></p>
		</div>";

	echo "<div class=enlaceReservas>
			<p><a href='index.php?action=mostrarListaReservas' text-align: left;>Lista Reservas</a></p>
		</div>";
echo"</div>";

if (count($data['listaUsuarios']) > 0) {

	// Ahora, la tabla con los datos de los libros
	echo "<table class='tabla'  cellspacing='3' cellpadding='5' border='0' bgcolor='#A4C4D0' text-algin='centre' >";
	foreach ($data['listaUsuarios'] as $usuario) {
		echo "<tr id='usuario" . $usuario->idUsuario . "'>";
		echo "<td>" . $usuario->email . "</td>";
		echo "<td>" . $usuario->nombre . "</td>";
		echo "<td>" . $usuario->apellido1 . "</td>";
		echo "<td>" . $usuario->apellido2 . "</td>";
		echo "<td>" . $usuario->dni . "</td>";
		echo "<td><img src=' ". $usuario->imagen . "'></td>";
		echo "<td>" . $usuario->tipo . "</td>";
		// Los botones "Modificar" y "Borrar" solo se muestran si hay una sesión iniciada
		if ($this->seguridad->haySesionIniciada()) {

			
				echo "<td><a href='index.php?action=formularioModificarUsuario&idUsuario=" . $usuario->idUsuario . "'>Modificar</a></td>";
				echo "<td><a href='index.php?action=borrarUsuario&idUsuario=" . $usuario->idUsuario . "'>Borrar Usuario</a></td>";
			
		}
		echo "</tr>";
	}
	echo "</table>";
} else {
	// La consulta no contiene registros
	echo "No se encontraron datos";
}
// El botón "Nuevo libro" solo se muestra si hay una sesión iniciada
if (isset($_SESSION["idUsuario"])) {
	echo "<p><a href='index.php?action=formularioInsertarUsuario'>Nuevo</a></p>";
}
