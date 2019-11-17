<?php

    require_once 'Conexion.php';

    class Ciudad {

        public $id;
        public $nombre;

        private function mapear ($resultSet) {
            $ciudad = new Ciudad();
            $ciudad -> id = $resultSet -> id;
            $ciudad -> nombre = $resultSet -> nombre;
            return $ciudad;
        }
        
        public static function listar () {
            $lista = [];
            $query = 'SELECT * FROM ciudad';
            $cnx = Conexion ::conectarBD();
            $resulset = $cnx -> query($query);
            while ($ciudad = $resulset -> fetchObject()) {
                $ciudad = self ::mapear($ciudad);
                array_push($lista, $ciudad);
            }
            return $lista;
        }

        public static function buscar ($id) {
            $query = 'SELECT * FROM ciudad WHERE id = ?';
            $cnx = Conexion ::conectarBD();
            $preparedStatement = $cnx -> prepare($query);
            $preparedStatement -> bindParam(1, $id);
            $preparedStatement -> execute();
            if ($ciudad = $preparedStatement -> fetchObject()) {
                $ciudad = self ::mapear($ciudad);
                return $ciudad;
            } else {
                return null;
            }
        }

        

    }