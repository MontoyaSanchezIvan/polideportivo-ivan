<?php
			// Comprobamos si hay una sesión iniciada o no
				echo "<h1>Alta de Instalaciones</h1>";

				// Creamos el formulario con los campos del libro
				echo "<form action = 'index.php' method = 'get'>
						Nombre:<input type='text' name='nombre'><br>
						Descripcion:<input type='text' name='descripcion'><br>
						Imagen:<input type='text' name='imagen'><br>
						Precio:<input type='text' name='precio'><br>
						<!--Número de páginas:<input type='text' name='numPaginas'><br>->";

				// Finalizamos el formulario
				echo "  <input type='hidden' name='action' value='insertarInstalacion'>
						<input type='submit'>
					</form>";
				echo "<p><a href='index.php'>Volver</a></p>";

	
