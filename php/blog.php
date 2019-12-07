<?php

    require_once 'Conexion.php';
    require_once 'Usuario.php';

    class Blog {

        public $id;
        public $usuario;
        public $titulo;
        public $contenido;
        public $fechaCreacion;

        private function mapear ($resulset) {
            $blog = new Blog();
            $blog -> id = $resulset -> id;
            $blog -> usuario = Usuario :: buscar($resulset-> usuario_id);
            $blog -> titulo = $resulset -> titulo;
            $blog -> contenido = $resulset -> contenido;
            $blog -> fechaCreacion = $resulset -> fecha_creacion;

            return $blog;
        }

        public static function listar() {
            $lista = [];
            $query = 'SELECT * FROM blog';
            $cnx = Conexion :: conectarBD();
            $resulset = $cnx -> query($query);
            while ($blog = $resulset -> fetchObject()) {
                $blog = self ::mapear($blog);
                array_push($lista, $blog);
            }
            return $lista;
        }

        public static function buscar ($id) {
            $query = 'SELECT * FROM blog WHERE id = ?';
            $cnx = Conexion ::conectarBD();
            $preparedStatement = $cnx -> prepare($query);
            $preparedStatement -> bindParam(1, $id);
            $preparedStatement -> execute();
            if ($blog = $preparedStatement -> fetchObject()) {
                $blog = self ::mapear($blog);
                return $blog;
            } else {
                return null;
            }
        }
    }