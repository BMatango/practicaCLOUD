<?php

class Database {
    //DSN----Data Sourse Name
    private static $dbName = 'yantex';
    private static $dbHost = 'node23676-bmatango.jl.serv.net.mx';
    private static $dbUsername = 'root';
    private static $dbUserPassword = 'SFEmeb12129';
    //propiedad para el control de la conexion
    private static $conexion = null;

    public function __construct() {
        exit('Inicializacion no permitida');
    }

    public static function connect() {
        // Una sola conexion para toda la aplicacion:
        if (null == self::$conexion) {   //self::propiedad es para instanciar
            try {
                self::$conexion = new PDO("mysql:host=" . self::$dbHost . ";" . "dbname=" . self::$dbName, self::$dbUsername, self::$dbUserPassword);
            } catch (PDOException $e) {
                die($e->getMessage());//die  la aplicacion se detenga si hay un error
            }
        }
        return self::$conexion;
    }

    public static function disconnect() {
        self::$conexion = null;
    }

}

?>