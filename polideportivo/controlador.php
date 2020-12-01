<?php
include_once("vista.php");
include_once("modelos/seguridad.php");
include_once("modelos/usuario.php");
include_once("modelos/instalacion.php");


class Controlador
{

	private $vista, $usuario,$seguridad,$instalacion;

	/**
	 * Constructor. Crea las variables de los modelos y la vista
	 */
	public function __construct()
	{
		$this->vista = new Vista();
		$this->usuario = new Usuario();
		$this->seguridad = new Seguridad();
		$this->instalacion = new Instalacion();
		
	}


	/*********************************************** INCIO SESION *****************************************/


	/**
	 * Muestra el formulario de login
	 */
	public function mostrarFormularioLogin(){
		$this->vista->mostrar("usuario/formularioLogin");
	}

	/**
	 * Procesa el formulario de login e inicia la sesión
	 */
	public function procesarLogin(){
		$usr = $_REQUEST["usr"];
		$pass = $_REQUEST["pass"];

		$usuario = $this->usuario->buscarUsuario($usr, $pass);
		
		if ($usuario) {
			$this->seguridad->abrirSesion($usuario);
			$this->mostrarListaUsuarios(); /*CAMBIAR A vistaCalendario CUANDO SE IMPLEMENTEN USUARIOS */
		} else {
			// Error al iniciar la sesión
			$data['msjError'] = "Nombre de usuario o contraseña incorrectos";
			$this->vista->mostrar("usuario/formularioLogin", $data);
		}
	}

	/**
	 * Cierra la sesión
	 */
	public function cerrarSesion(){
		$this->seguridad->cerrarSesion();
		$data['msjInfo'] = "Sesión cerrada correctamente";
		$this->vista->mostrar("usuario/formularioLogin", $data);
	}


	/************************************************CRUD USUARIOS************************************************ */

	public function formularioInsertarUsuario(){

			$this->vista->mostrar('usuario/formularioInsertarUsuario', $data);

	}


	public function insertarUsuario(){

		if ($this->seguridad->haySesionIniciada()) {
			// Vamos a procesar el formulario de alta de libros
			// Primero, recuperamos todos los datos del formulario
			// Ahora insertamos el libro en la BD
			$result = $this->usuario->insert();

			if ($result == 1) {

				$data['msjInfo'] = "Libro insertado con éxito";
			} else {
				// Si la inserción del libro ha fallado, mostramos mensaje de error
				$data['msjError'] = "Ha ocurrido un error al insertar el libro. Por favor, inténtelo más tarde.";
			}
			// Terminamos mostrando la lista de libros actualizada
			$data['listaUsuarios'] = $this->usuario->getAll();
			$this->vista->mostrar("usuario/listaUsuarios", $data);
		} else {
			$this->seguridad->errorAccesoNoPermitido();
		}
	}


	
	public function mostrarListaUsuarios(){
		$data['listaUsuarios'] = $this->usuario->getAll();
		$this->vista->mostrar("usuario/listaUsuarios", $data);
	}


	
	public function borrarUsuario(){
		if ($this->seguridad->haySesionIniciada()) {
			// Recuperamos el id del libro
			$idUsuario = $_REQUEST["idUsuario"];
			// Eliminamos el libro de la BD
			$result = $this->usuario->delete($idUsuario);
			if ($result == 1) {
				$data['msjInfo'] = "Usuario borrado con éxito";
				//$data['msjError'] = "Ha ocurrido un error al borrar el Usuario. Por favor, inténtelo de nuevo";
			} 
			// Mostramos la lista de libros actualizada
			$data['listaUsuarios'] = $this->usuario->getAll();
			$this->vista->mostrar("usuario/listaUsuarios", $data);
		} else {
			$this->seguridad->errorAccesoNoPermitido();
		}
	}

	/*public function borrarUsuarioAjax(){
		if ($this->seguridad->haySesionIniciada()) {
			// Recuperamos el id del libro
			$idUsuario = $_REQUEST["idUsuario"];
			// Eliminamos el libro de la BD
			$result = $this->usuario->delete($idUsuario);
			if ($result == 0) {
				// Error al borrar. Enviamos el código -1 al JS
				echo "-1";
			}
			else {
				// Borrado con éxito. Enviamos el id del libro a JS
				echo $idUsuario;
			}
		} else {
			echo "-1";
		}
	}*/

	public function modificarUsuario(){
		$id = $_REQUEST['idUsuario'];
		$email = $_REQUEST['email'];
		$password = $_REQUEST['password'];
		$nombre = $_REQUEST['nombre'];
		$apellido1 = $_REQUEST['apellido1'];
		$apellido2 = $_REQUEST['apellido2'];
		$dni = $_REQUEST['dni'];
		$imagen = $_REQUEST['imagen'];
		$tipo = $_REQUEST['tipo'];
		

	}






/************************************************* INSTALACIONES **********************************************************/



/**
* Muestra una lista con todos los libros
*/
public function mostrarListaInstalaciones(){

	$data['listaInstalaciones'] = $this->instalacion->getAll();
	$this->vista->mostrar("instalacion/listaInstalaciones", $data);
}


public function formularioInsertarInstalaciones(){

	$this->vista->mostrar('instalacion/formularioInsertarInstalacion');

}


public function insertarInstalacion(){

if ($this->seguridad->haySesionIniciada()) {
	
	$result = $this->instalacion->insert();

	if ($result == 1) {

		$data['msjInfo'] = "Instalacion insertada con éxito";
	} else {
		// Si la inserción del libro ha fallado, mostramos mensaje de error
		$data['msjError'] = "Ha ocurrido un error al insertar la instalacion. Por favor, inténtelo más tarde.";
	}
	// Terminamos mostrando la lista de libros actualizada
	$data['listaInstalaciones'] = $this->instalacion->getAll();
	$this->vista->mostrar("instalacion/listaInstalaciones", $data);
} else {
	$this->seguridad->errorAccesoNoPermitido();
}
}


public function borrarInstalaciones(){

	if ($this->seguridad->haySesionIniciada()) {
			// Recuperamos el id del libro
			$idInstalacion = $_REQUEST["idInstalacion"];
			// Eliminamos el libro de la BD
			$result = $this->instalacion->delete($idInstalacion);
			if ($result == 0) {
				$data['msjError'] = "Ha ocurrido un error al borrar la instalacion. Por favor, inténtelo de nuevo";
			} else {
				$data['msjInfo'] = "Instalacion borrada con éxito";
			}
			// Mostramos la lista de libros actualizada
			$data['listaInstalaciones'] = $this->instalacion->getAll();
			$this->vista->mostrar("instalacion/listaInstalaciones", $data);
		} else {
			$this->seguridad->errorAccesoNoPermitido();
		}
	}


public function borrarInstalacionAjax(){
	if ($this->seguridad->haySesionIniciada()) {
		
		$idInstalacion = $_REQUEST["idInstalacion"];
		
		$result = $this->instalacion->delete($idInstalacion);
			if ($result == 0) {
				// Error al borrar. Enviamos el código -1 al JS
				echo "-1";
			}else {
				// Borrado con éxito. Enviamos el id del libro a JS
				echo $idInstalacion;
			}
		} else {
		echo "-1";
		}
	}


public function formularioModificarInstalacion(){

	if ($this->seguridad->haySesionIniciada()) {
		// Recuperamos el libro con id = $idLibro y lo preparamos para pasárselo a la vista
		$idInstalacion = $_REQUEST["idInstalacion"];
		$data['instalacion'] = $this->instalacion->get($idInstalacion);
		
		$this->vista->mostrar('instalacion/formularioModificarInstalacion', $data);
	} else {
		$this->seguridad->errorAccesoNoPermitido();
	}
}



public function modificarInstalacion(){
	if ($this->seguridad->haySesionIniciada()) {

		$result = $this->instalacion->update();

		if ($result == 1) {
			// Si la modificación del libro ha funcionado, continuamos actualizando la tabla "escriben".
			$idInstalacion = $_REQUEST["idInstalacion"];
			
		} else {
			// Si la modificación del libro ha fallado, mostramos mensaje de error
			$data['msjError'] = "Ha ocurrido un error al modificar la instalacion. Por favor, inténtelo más tarde.";
		}
		$data['listaInstalaciones'] = $this->instalacion->getAll();
		$this->vista->mostrar("instalacion/listaInstalaciones", $data);
	} else {
		$this->seguridad->errorAccesoNoPermitido();
	}
}



	public function comprobarNombreUsuario() {
		$nombreUsuario = $_REQUEST["nombreUsuario"];
		$result = $this->usuario->existeNombre($nombreUsuario);
		echo $result;
	}
}
