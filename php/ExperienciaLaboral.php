<?php

    require_once 'Conexion.php';
    require_once 'Pais.php';
    require_once 'Usuario.php';

    class ExperienciaLaboral {
        public $id;
        public $nombre;
        public $lugar;
        public $fechaInicio;
        public $fechaFin;
        public $pais;
        public $usuario;

        private function mapear ($resultSet) {
            $experienciaLaboral= new ExperienciaLaboral();
            $experienciaLaboral-> id = $resultSet -> id;
            $experienciaLaboral-> nombre = $resultSet -> nombre;
            $experienciaLaboral-> lugar = $resultSet -> lugar;
            $experienciaLaboral-> fechaInicio = $resultSet -> fecha_inicio;
            $experienciaLaboral-> fechaFin = $resultSet -> fecha_fin;
            $experienciaLaboral-> pais = Pais ::buscar($resultSet -> pais_id);            
            $experienciaLaboral-> usuario = $resultSet -> usuario_id;
            return $experienciaLaboral;
        }        

        public static function listar ($usuario) {
            $lista = [];
            $query = 'SELECT * FROM experiencia_laboral WHERE usuario_id = ?';
            $resultSet = Conexion ::conectarBD() -> prepare($query);
            $resultSet -> bindParam(1, $usuario);
            $resultSet -> execute();
            while ($experienciaLaboral = $resultSet -> fetchObject()) {
                $experienciaLaboral = self :: mapear($experienciaLaboral);
                array_push($lista, $experienciaLaboral);
            }
            return $lista;
        }

        public function registrar () {
            $query = 'INSERT INTO experiencia_laboral VALUES(DEFAULT,?,?,?,?,?,?)';
            $preparedStament = Conexion ::conectarBD() -> prepare($query);
            $preparedStament -> bindParam(1, $this -> nombre);
            $preparedStament -> bindParam(2, $this -> lugar);
            $preparedStament -> bindParam(3, $this -> fechaInicio);
            $preparedStament -> bindParam(4, $this -> fechaFin);
            $preparedStament -> bindParam(5, $this -> pais -> id);
            $preparedStament -> bindParam(6, $this -> usuario -> id);
            $preparedStament -> execute();
        }

        public function actualizar (ExperienciaLaboral $experienciaLaboral) {
            $query = 'UPDATE experiencia_laboral SET nombre = ?, lugar = ?, fecha_inicio = ?, fecha_fin = ?, pais_id =? WHERE id = ?';
            $preparedStament = Conexion ::conectarBD() -> prepare($query);
            $preparedStament -> bindParam(1, $experienciaLaboral -> nombre);
            $preparedStament -> bindParam(2, $experienciaLaboral -> lugar);
            $preparedStament -> bindParam(3, $experienciaLaboral -> fechaInicio);
            $preparedStament -> bindParam(4, $experienciaLaboral -> fechaFin);
            $preparedStament -> bindParam(5, $experienciaLaboral -> pais -> id);
            $preparedStament -> bindParam(6, $this -> id);
            $preparedStament -> execute();
        }

        public static function eliminar (ExperienciaLaboral $experienciaLaboral) {
            $query = 'DELETE FROM experiencia_laboral WHERE id = ?';
            $preparedStament = Conexion ::conectarBD() -> prepare($query);
            $preparedStament -> bindParam(1, $experienciaLaboral  -> id);
            $preparedStament -> execute();
        }


    }