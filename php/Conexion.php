<?php
// PDO PHP Data Object
class Conexion {

    public static function conectarBD() {
        $driver = "pgsql";
        $servidor = "localhost";
        $basedatos = "dotclass";
        $usuario = "postgres";
        $clave 	 = "12345";
        $puerto = "5432";
        $cadena = "$driver:host=$servidor;port=$puerto;dbname=$basedatos;";
        $cnx = new PDO($cadena,$usuario,$clave);
        return $cnx;
    }
    
}
?>