<?php
    include_once("DB.php");

    class Usuario {
        private $db;
        
        /**
         * Constructor. Establece la conexión con la BD y la guarda
         * en una variable de la clase
         */
        public function __construct() {
            $this->db = new DB();
        }

       
        /**
         * Busca un usuario por nombre de usuario y password
         * @param usuario El nombre del usuario
         * @param password La contraseña del usuario
         * @return True si existe un usuario con ese nombre y contraseña, false en caso contrario
         */
        public function buscarUsuario($usuario,$password) {

            $usuario = $this->db->consulta("SELECT idUsuario, email, imagen, tipo FROM usuarios WHERE email = '$usuario' AND password = '$password'");
            if ($usuario) {
                return $usuario;
            } else {
                return null;
            }

        }

        public function get($id)
        {
            $result = $this->db->consulta("SELECT * FROM usuarios
                                                WHERE usuarios.idUsuario = '$id'");
            return $result;
        }


        public function getAll()
        {
            $arrayResult = array();
            $result = $this->db->consulta("SELECT * FROM usuarios
                                                /*INNER JOIN escriben ON libros.idLibro = escriben.idLibro
                                                INNER JOIN personas ON escriben.idPersona = personas.idPersona*/
                                                ORDER BY usuarios.idUsuario");
    
            return $result;
        }

        public function insert(){
            
            $email = $_REQUEST["email"];
            $password = $_REQUEST["password"];
            $nombre = $_REQUEST["nombre"];
            $apellido1 = $_REQUEST["apellido1"];
            $apellido2 = $_REQUEST["apellido2"];
            $dni = $_REQUEST["dni"];
            $imagen = $_REQUEST["imagen"];
    
            $result = $this->db->manipulacion("INSERT INTO usuarios (email,password,nombre,apellido1,apellido2,dni,imagen,tipo) 
                            VALUES ('$email','$password', '$nombre', '$apellido1', '$apellido2', '$dni','$imagen','user')");
            return $result;
        }
    

        public function update() {
           // $reesult = -> $this->db->manipulacion("UPDATE usuarios (");
        }

        public function delete($id)
        {
            $r = $this->db->manipulacion("DELETE FROM usuarios WHERE idUsuario = '$id'");
            return $r;
        }

        public function existeNombre($nombreUsuario) {
            $result = $this->db->consulta("SELECT * FROM usuarios WHERE nombre = '$nombreUsuario'");
            if ($result != null)
                return 1;
            else  
                return 0;

        }

    }