<?php

    require_once 'Conexion.php';
    require_once 'Ciudad.php';
    require_once 'Pais.php';

    $peticion = $_SERVER['REQUEST_URI'];
    $peticion = explode('/', $peticion);

    if ($peticion[count($peticion) - 2] == 'Usuario.php') {
        $peticion = end($peticion);

        switch ($peticion) {
            case '':
                echo json_encode(Usuario ::listar());
                break;

            case 'crear':
                break;

            default:
                break;
        }
    }

    class Usuario {
        public $id;
        public $nickname;
        public $password;
        public $nombres;
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
            $query = 'SELECT * FROM usuario WHERE id = :id';
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

        

        


    }