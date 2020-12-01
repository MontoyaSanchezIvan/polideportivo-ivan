<?php
			// Comprobamos si hay una sesión iniciada o no
				echo "<h1>Alta de Usuarios</h1>";

				// Creamos el formulario con los campos del libro
				echo "<form action = 'index.php' method = 'get'>
						Email:<input type='text' name='email'><br>
						Contraseña:<input type='text' name='password'><br>
						Nombre:<input type='text' name='nombre'><br>
						Primer apellido:<input type='text' name='apellido1'><br>
                        Segundo apellido:<input type='text' name='apellido2'><br>
                        DNI:<input type='text' name='dni'><br>
                        Imagen<input type='text' name='imagen'><br>";

				// Finalizamos el formulario
				echo "  <input type='hidden' name='action' value='insertarUsuario'>
						<input type='submit'>
					</form>";
				echo "<p><a href='index.php'>Volver</a></p>";
