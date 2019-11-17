<?php

    require_once 'Conexion.php';
    require_once 'Categoria.php';
    require_once 'Usuario.php';

    Curso ::ejecutar($_SERVER['REQUEST_URI']);

    class Curso {

        public $id;
        public $categoria;
        public $titulo;
        public $descripcion;
        public $logo;
        public $duracion;
        public $numeroSubscriptores;
        public $valoracion;
        public $fechaCreacion;
        public $fechaUltimaActualizacion;
        public $usuario;

        private function mapear ($resultSet) {
            $curso = new Curso();
            $curso -> id = $resultSet -> id;
            $curso -> categoria = Categoria ::buscar($resultSet -> categoria_id);
            $curso -> titulo = $resultSet -> titulo;
            $curso -> descripcion = $resultSet -> descripcion;
            $curso -> logo = $resultSet -> logo;
            $curso -> duracion = $resultSet -> duracion;
            $curso -> numeroSubscriptores = $resultSet -> numero_subscriptores;
            $curso -> valoracion = $resultSet -> valoracion;
            $curso -> fechaCreacion = $resultSet -> fecha_creacion;
            $curso -> fechaUltimaActualizacion = $resultSet -> fecha_ultima_actualizacion;
            $curso -> usuario = Usuario ::buscar($resultSet -> usuario_id);
            return $curso;
        }

        public static function listar () {
            $lista = [];
            $query = 'SELECT * FROM curso';
            $cnx = Conexion ::conectarBD();
            $resultSet = $cnx -> query($query);
            while ($curso = $resultSet -> fetchObject()) {
                $curso = self :: mapear($curso);
                array_push($lista, $curso);
            }
            return $lista;
        }

        public function registrar () {
            $query = 'INSERT INTO curso VALUES(DEFAULT,?,?,?,?,?,?,?,?,?,?)';
            $preparedStament = Conexion ::conectarBD() -> prepare($query);
            $preparedStament -> bindParam(1, $this -> categoria -> id);
            $preparedStament -> bindParam(2, $this -> titulo);
            $preparedStament -> bindParam(3, $this -> descripcion);
            $preparedStament -> bindParam(4, $this -> logo);
            $preparedStament -> bindParam(5, $this -> duracion);
            $preparedStament -> bindParam(6, $this -> numeroSubscriptores);
            $preparedStament -> bindParam(7, $this -> valoracion);
            $preparedStament -> bindParam(8, $this -> fechaCreacion);
            $preparedStament -> bindParam(9, $this -> fechaUltimaActualizacion);
            $preparedStament -> bindParam(10, $this -> usuario -> id);
            $preparedStament -> execute();
        }

        public function actualizar (Curso $curso) {
            $query = 'UPDATE curso SET categoria_id = ?, titulo = ?, descripcion = ?, logo = ?, duracion = ?, numero_subscriptores = ?, valoracion = ?, fecha_creacion = ?, fecha_ultima_actualizacion = ?, usuario_id = ? WHERE id = ? ';
            $preparedStament = Conexion ::conectarBD() -> prepare($query);
            $preparedStament -> bindParam(1, $curso -> categoria -> id);
            $preparedStament -> bindParam(2, $curso -> titulo);
            $preparedStament -> bindParam(3, $curso -> descripcion);
            $preparedStament -> bindParam(4, $curso -> logo);
            $preparedStament -> bindParam(5, $curso -> duracion);
            $preparedStament -> bindParam(6, $curso -> numeroSubscriptores);
            $preparedStament -> bindParam(7, $curso -> valoracion);
            $preparedStament -> bindParam(8, $curso -> fechaCreacion);
            $preparedStament -> bindParam(9, $curso -> fechaUltimaActualizacion);
            $preparedStament -> bindParam(10, $curso -> usuario -> id);
            $preparedStament -> bindParam(11, $this -> id);
            $preparedStament -> execute();
        }

        public static function eliminar (Curso $curso) {
            $query = 'DELETE FROM curso WHERE id = ?';
            $preparedStament = Conexion ::conectarBD() -> prepare($query);
            $preparedStament -> bindParam(1, $curso -> id);
            $preparedStament -> execute();
        }

        public static function ejecutar ($request) {
            $peticion = explode('/', $request);
            if (in_array(__CLASS__, $peticion)) {
                $peticion = end($peticion);
                switch ($peticion) {
                    case '':
                        echo json_encode(self ::listar());
                        break;

                    case 'crear':
                        echo '';
                        break;

                    default:
                        break;
                }
            }
        }

    }