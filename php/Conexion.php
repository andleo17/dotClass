<?php
// PDO PHP Data Object
class Conexion {

    public static function conectarBD() {
        $driver = "mysql";
        $servidor = "localhost";
        $basedatos = "dotClass";
        $usuario = "root";
        $clave 	 = "";
        $cadena = "$driver:host=$servidor;dbname=$basedatos";
        $cnx = new PDO($cadena,$usuario,$clave);
        return $cnx;
    }
    
}
?>