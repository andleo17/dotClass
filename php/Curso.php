<?php

require_once 'Conexion.php';

$peticion = $_SERVER['REQUEST_URI'];
$peticion = explode('/', $peticion);
$peticion = end($peticion);

switch ($peticion) {
    case 'listar':
        echo json_encode(Curso::listar());
        break;

    case 'crear':
        break;
    
    default:
        echo "No te conozco";
        break;
}

class Curso {

    private $id;
    private $categoria;
    private $titulo;
    private $descripcion;
    private $logo;
    private $duracion;
    private $numeroSubscriptores;
    private $valoracion;
    private $fechaCreacion;
    private $fechaUltimaActualizacion;
    private $usuario;

    public static function listar() {
        $query = 'SELECT * FROM curso';
        $cnx = Conexion::conectarBD();
        $resulset = $cnx ->query($query);
        return $resulset -> fetchAll(PDO::FETCH_CLASS, __CLASS__);
    }


}