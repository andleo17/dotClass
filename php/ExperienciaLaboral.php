<?php

    require_once 'Conexion.php';
    require_once 'Pais.php';
    require_once 'Usuario.php';

    ExperienciaLaboral ::ejecutar($_SERVER['REQUEST_URI']);

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
            $experienciaLaboral-> fechaInicio = $resultSet -> fechaInicio;
            $experienciaLaboral-> fechaFin = $resultSet -> fechaFin;
            $experienciaLaboral-> pais = Pais ::buscar($resultSet -> pais_id);            
            $experienciaLaboral-> usuario = Usuario ::buscar($resultSet -> usuario_id);
            return $experienciaLaboral;
        }        

        public static function listarxUsuario ($Usuario) {
            $lista = [];
            $query = 'SELECT experiencia_laboral.* FROM experiencia_laboral INNER JOIN usuario ON usuario.id = experiencia_laboral.usuario_id WHERE usuario.nickname = $Usuario';
            $cnx = Conexion ::conectarBD();
            $resulset = $cnx -> prepare($query);
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
            $query = 'UPDATE experiencia_laboral SET nombre = ?, lugar = ?, fecha_inicio = ?, fecha_fin = ?, pais_id =?, usuario_id = ? WHERE ?';
            $preparedStament = Conexion ::conectarBD() -> prepare($query);
            $preparedStament -> bindParam(1, $experienciaLaboral -> nombre);
            $preparedStament -> bindParam(2, $experienciaLaboral -> lugar);
            $preparedStament -> bindParam(3, $experienciaLaboral -> fechaInicio);
            $preparedStament -> bindParam(4, $experienciaLaboral -> fechaFin);
            $preparedStament -> bindParam(5, $experienciaLaboral -> pais -> id);
            $preparedStament -> bindParam(6, $experienciaLaboral -> usuario -> id);
            $preparedStament -> bindParam(7, $this -> id);
            $preparedStament -> execute();
        }

        public static function eliminar (ExperienciaLaboral $experienciaLaboral) {
            $query = 'DELETE FROM experiencia_laboral WHERE id = ?';
            $preparedStament = Conexion ::conectarBD() -> prepare($query);
            $preparedStament -> bindParam(1, $experienciaLaboral  -> id);
            $preparedStament -> execute();
        }


    }