<?php
require_once 'Conexion.php';

class pais{
    private $id;
    private $nombre;
    
    public static function listar() {
        $query = 'SELECT * FROM pais';
        $cnx = Conexion::conectarBD();
        $resulset = $cnx ->query($query);
        return $resulset -> fetchAll(PDO::FETCH_CLASS,__CLASS__);
    }

    public static function buscar($id) {
        $query = 'SELECT * FROM pais WHERE id = : id';
        $cnx = Conexion::conectarBD();
        $cnx -> prepare($query);
        $cnx -> bindParam(':id',$id);
        $cnx -> execute();
        return $cnx -> fetchObject(__CLASS__);
    }

}