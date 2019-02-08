<?php

class paginaMaestra
{
    function __construct(){

    }
    function __destruct(){
        
    }

    public function gethead()
    {
        include 'views/templates/head.php';
    }
    public function getscripts()
    {
        include 'views/templates/scripts.php';
    }
    public function getcabecera()
    {
        include 'views/templates/cabecera.php';
    }
}