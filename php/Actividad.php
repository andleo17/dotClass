<?php
    require_once 'Conexion.php';

    class Actividad {

        public $usuario;
        public $clase;
        public $visita;
        public $marcador;
        public $aporte;
        public $comentario;
        public $fecha;

        public static function buscar($usuario) {
            $query = 'SELECT * FROM actividad_curso WHERE id = ?';
            $preparedStatement = Conexion ::conectarBD() -> prepare($query);
            $preparedStatement -> bindParam(1, $id);
            $preparedStatement -> execute();
            if ($actividad = $preparedStatement -> fetchObject()) {
                $actividad = self ::mapear($actividad);
                return $actividad;
            } else {
                return null;
            }
        }

        public static function listar() {
            $lista = [];
            $query = 'SELECT * FROM actividad_curso';
            $resultSet = Conexion ::conectarBD() -> query($query);
            while ($actividad = $resultSet -> fetchObject()) {
                $actividad = self :: mapear($actividad);
                array_push($lista, $actividad);
            }
            return $lista;
        }

        private function mapear ($resultSet) {
            $actividad = new Actividad();
            $actividad -> usuario = $resultSet -> usuario_id;
            $actividad -> clase = $resultSet -> clase_id;
            $actividad -> visita = $resultSet -> marcador_id;
            $actividad -> marcador = $resultSet -> marcador_id;
            $actividad -> aporte = $resultSet -> aporte_id;
            $actividad -> comentario = $resultSet -> comentario_id;
            $actividad -> fecha = $resultSet -> fecha;
            return $actividad;
        }

    }