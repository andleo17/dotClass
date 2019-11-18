<?php

    require_once 'Conexion.php';
    require_once 'Pais.php';
    require_once 'Usuario.php';

    Conocimiento ::ejecutar($_SERVER['REQUEST_URI']);

    class Conocimiento {
        public $id;
        public $nombre;
        public $gradoAcademico;
        public $lugarEstudio;
        public $año;
        public $pais;
        public $usuario;

        private function mapear ($resultSet) {
            $conocimiento = new ExperienciaLaboral();
            $conocimiento -> id = $resultSet -> id;
            $conocimiento -> nombre = $resultSet -> nombre;
            $conocimiento -> gradoAcademico = $resultSet -> gradoAcademico;
            $conocimiento -> lugarEstudio = $resultSet -> lugarEstudio;
            $conocimiento -> año = $resultSet -> año;
            $conocimiento -> pais = Pais ::buscar($resultSet -> pais_id);            
            $conocimiento -> usuario = Usuario ::buscar($resultSet -> usuario_id);
            return $conocimiento;
        }        

        public static function listarxUsuario ($Usuario) {
            $lista = [];
            $query = 'SELECT conocimiento.* FROM conocimiento INNER JOIN usuario ON usuario.id = experiencia_laboral.usuario_id WHERE usuario.nickname = $Usuario';
            $cnx = Conexion ::conectarBD();
            $resulset = $cnx -> prepare($query);
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
            $preparedStament -> bindParam(4, $this -> año);
            $preparedStament -> bindParam(5, $this -> pais -> id);
            $preparedStament -> bindParam(6, $this -> usuario -> id);
            $preparedStament -> execute();
        }

        public function actualizar (ExperienciaLaboral $experienciaLaboral) {
            $query = 'UPDATE conocimiento SET nombre = ?, grado_academico = ?, lugar_estudio = ?, anio = ?, pais_id =?, usuario_id = ? WHERE ?';
            $preparedStament = Conexion ::conectarBD() -> prepare($query);
            $preparedStament -> bindParam(1, $conocimiento -> nombre);
            $preparedStament -> bindParam(2, $conocimiento -> gradoAcademico);
            $preparedStament -> bindParam(3, $conocimiento -> lugarEstudio);
            $preparedStament -> bindParam(4, $conocimiento -> año);
            $preparedStament -> bindParam(5, $conocimiento -> pais -> id);
            $preparedStament -> bindParam(6, $conocimiento -> usuario -> id);
            $preparedStament -> bindParam(7, $this -> id);
            $preparedStament -> execute();
        }

        public static function eliminar (ExperienciaLaboral $conocimiento) {
            $query = 'DELETE FROM conocimiento WHERE id = ?';
            $preparedStament = Conexion ::conectarBD() -> prepare($query);
            $preparedStament -> bindParam(1, $conocimiento  -> id);
            $preparedStament -> execute();
        }



    }