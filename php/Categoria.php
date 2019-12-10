<?php

    require_once 'Conexion.php';
    require_once 'Curso.php';

    Categoria ::ejecutar($_SERVER['REQUEST_URI']);

    class Categoria {

        public $id;
        public $nombre;
        public $descripcion;
        public $logo;

        private function mapear ($resultSet) {
            $categoria = new Categoria();
            $categoria -> id = $resultSet -> id;
            $categoria -> nombre = $resultSet -> nombre;
            $categoria -> descripcion = nl2br($resultSet -> descripcion);
            $categoria -> logo = $resultSet -> logo;
            return $categoria;
        }

        public function registrar () {
            $query = 'INSERT INTO categoria VALUES(DEFAULT,?,?,?)';
            $preparedStament = Conexion ::conectarBD() -> prepare($query);
            $preparedStament -> bindParam(1, $this -> nombre);
            $preparedStament -> bindParam(2, $this -> descripcion);
            $preparedStament -> bindParam(3, $this -> logo);
            $preparedStament -> execute();
        }


        public static function eliminar ($id) {
            $query = 'DELETE FROM categoria WHERE id = ?';
            $cnx = Conexion ::conectarBD();
            $preparedStatement = $cnx -> prepare($query);
            $preparedStatement -> bindParam(1, $id);
            $preparedStatement -> execute();
            if ($categoria = $preparedStatement -> fetchObject()) {
                $categoria = self ::mapear($categoria);
                return $categoria;
            } else {
                return null;
            }
        }

        public static function listar () {
            $lista = [];
            $query = 'SELECT * FROM categoria';
            $cnx = Conexion ::conectarBD();
            $resulset = $cnx -> query($query);
            while ($categoria = $resulset -> fetchObject()) {
                $categoria = self ::mapear($categoria);
                array_push($lista, $categoria);
            }
            return $lista;
        }

        public static function listarCursos ($id) {
            return Curso ::listarCategoria($id);
        }

        public static function buscar ($id) {
            $query = 'SELECT * FROM categoria WHERE id = ?';
            $cnx = Conexion ::conectarBD();
            $preparedStatement = $cnx -> prepare($query);
            $preparedStatement -> bindParam(1, $id);
            $preparedStatement -> execute();
            if ($categoria = $preparedStatement -> fetchObject()) {
                $categoria = self ::mapear($categoria);
                return $categoria;
            } else {
                return null;
            }
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
                        try {
                            $categoria = new Categoria;
                            $categoria -> nombre = $_POST['txtnombre'];
                            $categoria -> descripcion = $_POST['txtdescripcion'];
                            $categoria -> logo = $_POST['txtlogo'];
                            $categoria -> registrar();
                            echo 1;
                        } catch (PDOException $exception) {
                            echo 'Algo sucedió mal';
                        }                        
                        break;
                    case 'eliminar':
                        try {
                            echo json_encode(self :: eliminar($_POST['id']));
                            echo 1;
                        } catch (PDOException $exception) {
                            echo 'Algo sucedió mal';
                        } 
                        break;
                    default:
                        echo json_encode(self :: buscar($peticion));
                        break;
                }
            }
        }


    }