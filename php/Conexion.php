<?php
// PDO PHP Data Object
class Conexion {

    public static function conectarBD() {
        $driver = "mysql";
        $servidor = "localhost";
        $basedatos = "dotClass";
        $usuario = "root";
        $clave 	 = "";
        $cadena = "$driver:host=$servidor;dbname=$basedatos;charset=UTF8;";
        $cnx = new PDO($cadena,$usuario,$clave, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        return $cnx;
    }
    
}
?>