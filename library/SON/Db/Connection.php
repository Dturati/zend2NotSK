<?php
namespace SON\Db;

class Connection
{
    private $server;
    private $user;
    private $password;
    private $dbName;

    public function __construct($server,$dbName,$user,$password)
    {
        $this->server   = $server;
        $this->dbName   = $dbName;
        $this->user     = $user;
        $this->password = $password;

        //return new \PDO("mysql:host={$this->server};dbname={$this->dbName}",$this->user,$this->password);
    }

}