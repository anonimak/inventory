<?php
class Database{
    private $user= DB_USER;
    private $pass= DB_PASS;

    private $dns;

    private $db;

    public function __construct(){
        $option = [
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ];

        $this->dns = 'mysql:host='.DB_HOST.';dbname='.DB_NAME;

        try{
            $this->db= new PDO($this->dns,$this->user,$this->pass,$option);
        }
        catch(PDOException $e){
            print "Error :".$e->getMessage().PHP_EOL;
            die();

        }
        return $this->db;
    }

    public function query($query)
    {
        $this->stmt = $this->db->prepare($query);
    }

    public function bind($param, $value, $type = null)
    {
        if (is_null($type)) {
            switch (true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
                    break;
            }
        }

        $this->stmt->bindValue($param, $value, $type);
    }

    public function execute()
    {
        return $this->stmt->execute();
    }

    public function execute_param($param = [])
    {
        return $this->stmt->execute($param);
    }

    public function resultSet()
    {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function single()
    {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function rowCount(){
        $this->execute();
        return $this->stmt->fetchColumn();
    }

}