<?php
// PDO PHP Data Object
class Conexion {

    public static function conectarBD() {
        $driver = "pgsql";
        $servidor = "localhost";
        $basedatos = "dotclass";
        $usuario = "postgres";
        $clave 	 = "123456789";
        $puerto = "5454";
        $cadena = "$driver:host=$servidor;port=$puerto;dbname=$basedatos;";
        $cnx = new PDO($cadena,$usuario,$clave);
        return $cnx;
    }
    
}
?>