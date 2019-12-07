<?php

    require_once 'Conexion.php';
    require_once 'Pais.php';
    require_once 'Usuario.php';

    class Conocimiento {

        public $id;
        public $nombre;
        public $gradoAcademico;
        public $lugarEstudio;
        public $anio;
        public $pais;
        public $usuario;

        private function mapear ($resultSet) {
            $conocimiento = new Conocimiento();
            $conocimiento -> id = $resultSet -> id;
            $conocimiento -> nombre = $resultSet -> nombre;
            $conocimiento -> gradoAcademico = $resultSet -> grado_academico;
            $conocimiento -> lugarEstudio = $resultSet -> lugar_estudio;
            $conocimiento -> anio = $resultSet -> anio;
            $conocimiento -> pais = Pais ::buscar($resultSet -> pais_id);            
            $conocimiento -> usuario = $resultSet -> usuario_id;
            return $conocimiento;
        }        

        public static function listar ($usuario) {
            $lista = [];
            $query = 'SELECT * FROM conocimiento WHERE usuario_id = ? ORDER BY id';
            $resultSet = Conexion ::conectarBD() -> prepare($query);
            $resultSet -> bindParam(1,$usuario);
            $resultSet -> execute();
            while ($conocimiento = $resultSet -> fetchObject()) {
                $conocimiento = self :: mapear($conocimiento);
                array_push($lista, $conocimiento);
            }
            return $lista;
        }

        public function registrar () {
            $query = 'INSERT INTO conocimiento VALUES(DEFAULT,?,?,?,?,?,?)';
            $preparedStament = Conexion ::conectarBD() -> prepare($query);
            $preparedStament -> bindParam(1, $this -> nombre);
            $preparedStament -> bindParam(2, $this -> gradoAcademico);
            $preparedStament -> bindParam(3, $this -> lugarEstudio);
            $preparedStament -> bindParam(4, $this -> anio);
            $preparedStament -> bindParam(5, $this -> pais);
            $preparedStament -> bindParam(6, $this -> usuario);
            $preparedStament -> execute();
        }

        public static function actualizar (Conocimiento $conocimiento) {
            $query = 'UPDATE conocimiento SET nombre = ?, grado_academico = ?, lugar_estudio = ?, anio = ?, pais_id =? WHERE id = ?';
            $preparedStament = Conexion ::conectarBD() -> prepare($query);
            $preparedStament -> bindParam(1, $conocimiento -> nombre);
            $preparedStament -> bindParam(2, $conocimiento -> gradoAcademico);
            $preparedStament -> bindParam(3, $conocimiento -> lugarEstudio);
            $preparedStament -> bindParam(4, $conocimiento -> anio);
            $preparedStament -> bindParam(5, $conocimiento -> pais);
            $preparedStament -> bindParam(6, $conocimiento -> id);
            $preparedStament -> execute();
        }

        public static function eliminar (Conocimiento $conocimiento) {
            $query = 'DELETE FROM conocimiento WHERE id = ?';
            $preparedStament = Conexion ::conectarBD() -> prepare($query);
            $preparedStament -> bindParam(1, $conocimiento  -> id);
            $preparedStament -> execute();
        }



    }