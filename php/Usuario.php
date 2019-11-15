<?php

class Usuario {
    private $id;
    private $nickname;
    private $password;
    private $nombres;
    private $email;
    private $fecha_nacimiento;
    private $descripcion;
    private $numero_seguidores;
    private $pregunta_seguridad;
    private $respuesta_seguridad;
    private $foto;
    private $pais;
    private $ciudad;

    public static function listar() {
        $query = 'SELECT * FROM usuario';
        $cnx = Conexion::conectarBD();
        $resulset = $cnx ->query($query);
        return $resulset -> fetchAll(PDO::FETCH_CLASS,__CLASS__);
    }
    


}