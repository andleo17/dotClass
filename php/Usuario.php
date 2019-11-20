<?php

    require_once 'Conexion.php';
    require_once 'Ciudad.php';
    require_once 'Pais.php';
    require_once 'Curso.php';
    require_once 'Conocimiento.php';
    require_once 'ExperienciaLaboral.php';

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
            $resultSet = $cnx -> query($query);
            while ($usuario = $resultSet -> fetchObject()) {
                $usuario = self ::mapear($usuario);
                array_push($lista, $usuario);
            }
            return $lista;
        }

        public static function buscar ($id) {
            $query = 'SELECT * FROM usuario WHERE id = :id OR nickname = :id';
            $cnx = Conexion ::conectarBD();
            $preparedStatement = $cnx -> prepare($query);
            $preparedStatement -> bindParam(':id', $id);
            $preparedStatement -> execute();
            if ($usuario = $preparedStatement -> fetchObject()) {
                $usuario = self ::mapear($usuario);
                return $usuario;
            } else {
                return null;
            }
        }

        public function registrar () {
            if (basename($this -> foto['name']) == '') {
                $url_foto = 'user.jpg';
            } else {
                $url_foto = basename($this -> foto['name']);
                move_uploaded_file($this -> foto['tmp_name'], "../uploads/perfiles/$url_foto");
            };

            $this -> foto = $url_foto;

            $query = 'INSERT INTO usuario VALUES(DEFAULT,?,?,?,?,?,?,?, DEFAULT,?,?,?,?,?, DEFAULT, DEFAULT)';
            $preparedStament = Conexion ::conectarBD() -> prepare($query);
            $preparedStament -> bindParam(1, $this -> nickname);
            $preparedStament -> bindParam(2, $this -> password);
            $preparedStament -> bindParam(3, $this -> nombres);
            $preparedStament -> bindParam(4, $this -> apellidos);
            $preparedStament -> bindParam(5, $this -> email);
            $preparedStament -> bindParam(6, $this -> fechaNacimiento);
            $preparedStament -> bindParam(7, $this -> descripcion);
            $preparedStament -> bindParam(8, $this -> preguntaSeguridad);
            $preparedStament -> bindParam(9, $this -> respuestaSeguridad);
            $preparedStament -> bindParam(10, $this -> foto);
            $preparedStament -> bindParam(11, $this -> pais);
            $preparedStament -> bindParam(12, $this -> ciudad);
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
            $preparedStament -> bindParam(13, $usuario -> ciudad -> id);
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

        public static function listarSeguimiento (Usuario $usuario) {
            $lista = [];
            $query = 'SELECT curso_id FROM seguimiento WHERE usuario_id = ?';
            $preparedStatement = Conexion ::conectarBD() -> prepare($query);
            $preparedStatement -> bindParam(1, $usuario -> id);
            $preparedStatement -> execute();
            while ($curso = $preparedStatement -> fetchObject()) {
                $curso = Curso ::buscar($curso -> curso_id);
                array_push($lista, $curso);
            }
            return $lista;
        }

        public static function listarEnseñanza (Usuario $usuario) {
            $lista = [];
            $query = 'SELECT id FROM curso WHERE usuario_id = ?';
            $preparedStatement = Conexion ::conectarBD() -> prepare($query);
            $preparedStatement -> bindParam(1, $usuario -> id);
            $preparedStatement -> execute();
            while ($curso = $preparedStatement -> fetchObject()) {
                $curso = Curso ::buscar($curso -> id);
                array_push($lista, $curso);
            }
            return $lista;
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
                        if ($_POST['password'] == $_POST['confirmarPassword']) {
                            try {
                                $usuario = new Usuario;
                                $usuario -> nickname = $_POST['nickname'];
                                $usuario -> password = $_POST['password'];
                                $usuario -> nombres = $_POST['nombres'];
                                $usuario -> apellidos = $_POST['apellidos'];
                                $usuario -> email = $_POST['email'];
                                $usuario -> fechaNacimiento = $_POST['fechaNacimiento'];
                                $usuario -> descripcion = $_POST['descripcion'];
                                $usuario -> preguntaSeguridad = $_POST['preguntaSeguridad'];
                                $usuario -> respuestaSeguridad = $_POST['respuestaSeguridad'];
                                $usuario -> foto = $_FILES['foto'];
                                $usuario -> pais = $_POST['pais'];
                                $usuario -> ciudad = $_POST['ciudad'];
                                $usuario -> registrar();
                                echo 1;
                            } catch (PDOException $exception) {
                                echo 'Algo sucedió mal';
                            }
                        } else {
                            echo 'Contraseñas no coinciden';
                        }
                        break;

                    case 'login':
                        echo json_encode(self ::iniciarSesion($_POST['nickname'], $_POST['password']));
                        break;

                    case 'cerrarSesion':
                        session_start();
                        session_destroy();
                        break;

                    default:
                        return self ::buscar($peticion);
                        break;
                }
            }
        }

    }