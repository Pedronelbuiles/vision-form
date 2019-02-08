<?php 
include 'conection.php';
class Query extends Conection
{
    private $query;

    public function __construct() 
    {
         parent::__construct();
         $this->query ="";
    }
    
    public function __destruct()
    {
        parent::__destruct();
    }
    function getQuery()
    {
        return $this->query;
    }
    public function getArrayRecord(){
        return mysqli_fetch_array($this->query);
    }
    function setQuery ($query)
    {
        $this->query = mysqli_query($this->getlink(), $query);
    }
    
    public function totalRecords()
    {
        return mysqli_num_rows($this->query);
    }
    
    public function freeQuery()
    {
       mysqli_free_result($this->query);
    }

}