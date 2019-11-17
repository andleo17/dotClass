<?php

    require_once 'Conexion.php';
    require_once 'Ciudad.php';
    require_once 'Pais.php';

    Usuario ::ejecutar($_SERVER['REQUEST_URI']);

    class Usuario {
        public $id;
        public $nickname;
        public $password;
        public $nombres;
        public $apellidos;
        public $email;
        public $fechaNacimiento;
        public $descripcion;
        public $numeroSeguidores;
        public $preguntaSeguridad;
        public $respuestaSeguridad;
        public $foto;
        public $pais;
        public $ciudad;
        public $fechaCreacion;
        public $estado;

        public static function iniciarSesion ($nickname, $password) {
            $query = 'SELECT * FROM usuario WHERE nickname = ? AND password = ?;';
            $cnx = Conexion ::conectarBD();
            $preparedStatement = $cnx -> prepare($query);
            $preparedStatement -> bindParam(1, $nickname);
            $preparedStatement -> bindParam(2, $password);
            $preparedStatement -> execute();
            if ($usuario = $preparedStatement -> fetchObject()) {
                $usuario = self ::mapear($usuario);
                session_start();
                $_SESSION['usuario'] = $usuario;
                return $usuario;
            } else {
                return null;
            }
        }

        private function mapear ($resultSet) {
            $usuario = new Usuario();
            $usuario -> id = $resultSet -> id;
            $usuario -> nickname = $resultSet -> nickname;
            $usuario -> password = $resultSet -> password;
            $usuario -> nombres = $resultSet -> nombres;
            $usuario -> apellidos = $resultSet -> apellidos;
            $usuario -> email = $resultSet -> email;
            $usuario -> fechaNacimiento = $resultSet -> fecha_nacimiento;
            $usuario -> descripcion = $resultSet -> descripcion;
            $usuario -> numeroSeguidores = $resultSet -> numero_seguidores;
            $usuario -> preguntaSeguridad = $resultSet -> pregunta_seguridad;
            $usuario -> respuestaSeguridad = $resultSet -> respuesta_seguridad;
            $usuario -> foto = $resultSet -> foto;
            $usuario -> pais = Pais ::buscar($resultSet -> pais_id);
            $usuario -> ciudad = Ciudad ::buscar($resultSet -> ciudad_id);
            $usuario -> fechaCreacion = $resultSet -> fecha_creacion;
            $usuario -> estado = $resultSet -> estado;

            return $usuario;
        }

        public static function listar () {
            $lista = [];
            $query = 'SELECT * FROM usuario';
            $cnx = Conexion ::conectarBD();
            $resulset = $cnx -> query($query);
            while ($usuario = $resulset -> fetchObject()) {
                $usuario = self ::mapear($usuario);
                array_push($lista, $usuario);
            }
            return $lista;
        }

        public static function buscar ($id) {
            $query = 'SELECT * FROM usuario WHERE id = ?';
            $cnx = Conexion ::conectarBD();
            $preparedStatement = $cnx -> prepare($query);
            $preparedStatement -> bindParam(1, $id);
            $preparedStatement -> execute();
            if ($usuario = $preparedStatement -> fetchObject()) {
                $usuario = self ::mapear($usuario);
                return $usuario;
            } else {
                return null;
            }
        }

        public function registrar (Usuario $usuario) {
            $query = 'INSERT INTO usuario VALUES(DEFAULT,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)';
            $preparedStament = Conexion ::conectarBD() -> prepare($query);
            $preparedStament -> bindParam(1, $this -> nickname);
            $preparedStament -> bindParam(2, $this -> password);
            $preparedStament -> bindParam(3, $this -> nombres);
            $preparedStament -> bindParam(4, $this -> apellidos);
            $preparedStament -> bindParam(5, $this -> email);
            $preparedStament -> bindParam(6, $this -> fechaNacimiento);
            $preparedStament -> bindParam(7, $this -> descripcion);
            $preparedStament -> bindParam(8, $this -> numeroSeguidores);
            $preparedStament -> bindParam(9, $this -> preguntaSeguridad);
            $preparedStament -> bindParam(10, $this -> respuestaSeguridad);
            $preparedStament -> bindParam(11, $this -> foto);
            $preparedStament -> bindParam(12, $this -> pais -> id);
            $preparedStament -> bindParam(13, $this -> ciudad -> id);
            $preparedStament -> bindParam(14, $this -> fechaCreacion);
            $preparedStament -> bindParam(15, $this -> estado);
            $preparedStament -> execute();
        }

        public function actualizar (Usuario $usuario) {
            $query = 'UPDATE usuario SET nickname =?,password = ?,nombres = ?, apellidos = ?, email = ?, fecha_nacimiento = ?, descripcion =?, numero_seguidores = ?, pregunta_seguridad = ?, respuesta_seguridad = ?, foto = ?, pais_id = ?, ciudad_id = ?,fecha_creacion = ?, estado = ? WHERE id = ?';
            $preparedStament = Conexion ::conectarBD() -> prepare($query);
            $preparedStament -> bindParam(1, $usuario -> nickname);
            $preparedStament -> bindParam(2, $usuario -> password);
            $preparedStament -> bindParam(3, $usuario -> nombres);
            $preparedStament -> bindParam(4, $usuario -> apellidos);
            $preparedStament -> bindParam(5, $usuario -> email);
            $preparedStament -> bindParam(6, $usuario -> fechaNacimiento);
            $preparedStament -> bindParam(7, $usuario -> descripcion);
            $preparedStament -> bindParam(8, $usuario -> numeroSeguidores);
            $preparedStament -> bindParam(9, $usuario -> preguntaSeguridad);
            $preparedStament -> bindParam(10, $usuario -> respuestaSeguridad);
            $preparedStament -> bindParam(11, $usuario -> foto);
            $preparedStament -> bindParam(12, $usuario -> pais -> id);
            $preparedStament -> bindParam(13, $usuario -> ciudad);
            $preparedStament -> bindParam(14, $usuario -> fechaCreacion);
            $preparedStament -> bindParam(15, $usuario -> estado);
            $preparedStament -> bindParam(16, $this -> id);
            $preparedStament -> execute();
        }

        public static function eliminar (Usuario $usuario) {
            $query = 'DELETE FROM usuario WHERE id = ?';
            $preparedStament = Conexion ::conectarBD() -> prepare($query);
            $preparedStament -> bindParam(1, $usuario -> id);
            $preparedStament -> execute();
        }

        public static function ejecutar ($request) {
            $peticion = explode('/', $request);
            if ($peticion[count($peticion) - 2] == __CLASS__) {
                $peticion = end($peticion);
                switch ($peticion) {
                    case '':
                        echo json_encode(self ::listar());
                        break;

                    case 'crear':
                        echo '';
                        break;

                    case 'login':
                        echo json_encode(self ::iniciarSesion($_POST['nickname'], $_POST['password']));
                        break;

                    default:
                        break;
                }
            }
        }

    }