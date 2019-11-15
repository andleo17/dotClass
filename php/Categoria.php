<?php

require_once 'Conexion.php';

class Categoria {
    
    private $id;
    private $nombre;

    public static function listar() {
        $query = 'SELECT * FROM categoria';
        $cnx = Conexion::conectarBD();
        $resultSet = $cnx -> query($query);
        return $resultSet -> fetchAll(PDO::FETCH_CLASS, __CLASS__);
    }

    public static function buscar($id) {
        $query = 'SELECT * FROM categoria WHERE id = :id';
        $cnx = Conexion::conectarBD();
        $cnx -> prepare($query);
        $cnx -> bindParam(':id', $id);
        $cnx -> execute();
        return $cnx -> fetchObject(__CLASS__);
    }
}