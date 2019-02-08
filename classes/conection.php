<?php

class Conection{
    private $host;
    private $user;
    private $password;
    private $dataBase;
    private $port;
    private $sokect;
    private $link;

    public function __construct()
    {
        $this->host="";
        $this->user="";
        $this->password="";
        $this->dataBase="";
        $this->port="3306";
        $this->sokect="";
        $this->link="";
    }
    
    public function __destruct() 
    {
        
    }
    
    function getHost() {
        return $this->host;
    }

    function getUser() {
        return $this->user;
    }

    function getPassword() {
        return $this->password;
    }

    function getDataBase() {
        return $this->dataBase;
    }

    function getPort() {
        return $this->port;
    }

    function getSokect() {
        return $this->sokect;
    }

    function getLink() {
        return $this->link;
    }

    function setHost($host) {
        $this->host = $host;
    }

    function setUser($user) {
        $this->user = $user;
    }

    function setPassword($password) {
        $this->password = $password;
    }

    function setDataBase($dataBase) {
        $this->dataBase = $dataBase;
    }

    function setPort($port) {
        $this->port = $port;
    }

    function setSokect($sokect) {
        $this->sokect = $sokect;
    }

    function setLink($link) {
        $this->link = $link;
    }

    public function connect()
    {
        if(!($this->link =
                mysqli_connect($this->host, $this->user,
                $this->password, $this->dataBase, $this->port, 
                $this->sokect)))
        {
            echo "No se puede conectar con el servidor";
            exit ();
        }
        
        if(!mysqli_select_db($this->link, $this->dataBase))
        {
            echo "Base de datos no válida";
            exit (); 
        }
    }
    
    public function closeConnection()
    {
        mysqli_close($this->link);
    }
}