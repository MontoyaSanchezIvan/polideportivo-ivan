<?php
    include_once("DB.php");
    

    class Rerservas {
        private $db;
        
        /**
         * Constructor. Establece la conexión con la BD y la guarda
         * en una variable de la clase
         */
        public function __construct() {
            $this->db = new DB();
        }

        public function get($id) {
            
            $result = $this->db->consulta("SELECT * FROM reservas WHERE idReserva = '$id'");
           
            return $result;

        }

        public function getAll() {
           
            $result = $this->db->consulta("SELECT * FROM reservas");
            
            return $result;

        }

        public function insert() {

            $fecha = $_REQUEST["fecha"];
            $hora = $_REQUEST["hora"];
            $precio = $_REQUEST["precio"];
            $idInstalacion = $_REQUEST["tipoInstalacion"];
            
            $result = $this->db->manipulacion("INSERT INTO reservas (fecha,hora,precio,id_instalacion) VALUES ('$fecha', '$hora', '$precio',$idInstalacion)");  

            return $result;
        }

        public function update() {

            $id = $_REQUEST["id"];
            $fecha = $_REQUEST["fecha"];
            $hora = $_REQUEST["hora"];
            $precio = $_REQUEST["precio"];

            $result = $this->db->manipulacion("UPDATE reservas SET fecha = '$fecha', hora = '$hora', precio = '$precio' WHERE idReserva = '$id'");

            return $result;
        }

        public function delete($id) {
            $result = $this->db->manipulacion("DELETE FROM reservas WHERE idReserva = '$id'");
            return $result;
        }

        public function getLastId() {
            $result = $this->db->consulta("SELECT MAX(idReserva)  FROM reservas");
            $id = $result->ultimoId;
            return $id;
        }

        




    }    