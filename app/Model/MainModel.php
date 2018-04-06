<?php

namespace Model;


class MainModel
{
    private $config;
    protected $db;
    private $driver;
    private $host;
    private $user;
    private $password;
    private $dbName;

    public function __construct($config)
    {
        $this->config = $config;

        $this->driver = $this->config['driver_pdo'];
        $this->host = $this->config['host'];
        $this->user = $this->config['user'];
        $this->password = $this->config['password'];
        $this->dbName = $this->config['dbname'];

        $this->connect();
    }

    public function connect()
    {
        $dsn = "$this->driver:host=$this->host;dbname=$this->dbName";

        $this->db = new \PDO($dsn,$this->user,$this->password);
        $this->db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        $this->db->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
    }
}