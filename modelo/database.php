<?php

class BaseDatos extends PDO
{
    private static $db_host = 'localhost';
    private static $db_port = '5332';
    private static $db_user = 'postgres';
    private static $db_pass = 'password';
    protected $db_name = 'mydb';

    protected $query;

    private $connection;

    # los siguientes métodos pueden definirse con exactitud y
    # no son abstractos
    # Conectar a la base de datos
    private function abrir_conexion()
    {
        try {

            $this->connection = parent::__construct("pgsql:host=$this->db_host;
                                                port=$this->port; dbname=$this->db_name;
                                                user=$this->db_user;
                                                password=$this->db_pass");

        } catch(PDOException $e) {

            echo  $e->getMessage();

        }
    }

    # Desconectar la base de datos
    public function cerrar_conexion()
    {
        $this->connection = null;
    }

    # Ejecutar un query simple del tipo INSERT, DELETE, UPDATE, SELECT
    protected function ejecutar_consulta_simple($sql)
    {
        $this->abrir_conexion();
        $statement = $this->connection->prepare($sql);
        return $statement;
    }
}

?>
