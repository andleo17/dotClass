<?php

    require_once 'Conexion.php';
    require_once 'Categoria.php';
    require_once 'Usuario.php';
    require_once 'Seccion.php';
    require_once 'Examen.php';
    require_once 'Util.php';

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
            $curso -> descripcion = nl2br($resultSet -> descripcion);
            $curso -> logo = $resultSet -> logo;
            $curso -> duracion = Util::convertirTiempo($resultSet -> duracion);
            $curso -> numeroSubscriptores = Util::convertirCantidades($resultSet -> numero_subscriptores);
            $curso -> valoracion = $resultSet -> valoracion;
            $curso -> fechaCreacion = $resultSet -> fecha_creacion;
            $curso -> fechaUltimaActualizacion = $resultSet -> fecha_ultima_actualizacion;
            $curso -> usuario = Usuario ::buscar($resultSet -> usuario_id);
            return $curso;
        }

        public static function buscar ($id) {
            $query = 'SELECT * FROM curso WHERE id = ?';
            $preparedStatement = Conexion ::conectarBD() -> prepare($query);
            $preparedStatement -> bindParam(1, $id);
            $preparedStatement -> execute();
            if ($curso = $preparedStatement -> fetchObject()) {
                $curso = self ::mapear($curso);
                return $curso;
            } else {
                return null;
            }
        }

        public static function listarCategoria($id) {
            $lista = [];
            $query = 'SELECT * FROM curso WHERE categoria_id = ?';
            $resultSet = Conexion ::conectarBD() -> prepare($query);
            $resultSet -> bindParam(1, $id);
            $resultSet -> execute();
            while ($curso = $resultSet -> fetchObject()) {
                $curso = self :: mapear($curso);
                array_push($lista, $curso);
            }
            return $lista;
        }

        public static function buscarContenido ($id) {
            return Seccion ::buscar($id);
        }

        public static function buscarExamen ($id) {
            return Examen ::buscar($id);
        }

        public static function listar () {
            $lista = [];
            $query = 'SELECT * FROM curso';
            $resultSet = Conexion ::conectarBD() -> query($query);
            while ($curso = $resultSet -> fetchObject()) {
                $curso = self :: mapear($curso);
                array_push($lista, $curso);
            }
            return $lista;
        }

        public static function listarPrerequisitos ($id) {
            $lista = [];
            $query = 'SELECT curso_prerrequisito_id FROM prerrequisito WHERE curso_id = ?';
            $preparedStatement = Conexion ::conectarBD() -> prepare($query);
            $preparedStatement -> bindParam(1, $id);
            $preparedStatement -> execute();
            while ($curso = $preparedStatement -> fetchObject()) {
                $curso = self :: buscar($curso -> curso_prerrequisito_id);
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