<?php

    require_once 'Conexion.php';
    require_once 'Categoria.php';
    require_once 'Usuario.php';

    $peticion = $_SERVER['REQUEST_URI'];
    $peticion = explode('/', $peticion);

    if ($peticion[count($peticion) - 2] == 'Curso.php') {
        $peticion = end($peticion);

        switch ($peticion) {
            case '':
                echo json_encode(Curso ::listar());
                break;

            case 'crear':
                break;

            default:
                break;
        }
    }

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

        public function insertar (){
            $query = 'INSERT INTO curso VALUES(DEFAULT,?,?,?,?,?,?,?,?,?,?)';
            $preparedStament = Conexion::conectarBD() -> prepare($query);
            $preparedStament -> bindParam(1, $this -> categoria -> id);
            $preparedStament -> bindParam(2, $this -> titulo);
            $preparedStament -> bindParam(3, $this -> descripcion);
            $preparedStament -> bindParam(4, $this -> logo);
            $preparedStament -> bindParam(5, $this -> duracion);
            $preparedStament -> bindParam(6, $this -> numero_subscriptores);
            $preparedStament -> bindParam(7, $this -> valoracion);
            $preparedStament -> bindParam(8, $this -> fechaCreacion);
            $preparedStament -> bindParam(9, $this -> fechaUltimaActualizacion);
            $preparedStament -> bindParam(10, $this -> usuario -> id);
            $preparedStament -> execute();
        }

        public function actualizar (Curso $curso){
            $query = 'UPDATE curso SET categoria_id = ?, titulo = ?, descripcion = ?, logo = ?, duracion = ?, numero_subscriptores`=[value-7],`valoracion`=[value-8],`fecha_creacion`=[value-9],`fecha_ultima_actualizacion`=[value-10],`usuario_id`=[value-11] WHERE 1';

        }

        

    }