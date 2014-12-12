<?php

class connection
{
    private $user = "root";
    private $host = "localhost";
    private $con;
    private $db = "chat";
    
    function __construct($host = NULL, $user = NULL) 
    {
        $this->host = $host;
        $this->user = $user;
    }
    
    function connect()
    { 
        try
        {
            if ($this->con = mysqli_connect($this->host, $this->user))
            {
                mysqli_select_db($this->con, $this->db);
            }
            else
            {
                throw new Exception('Unable to connect');
            }
            
        } catch (Exception $e) {
            echo $e->getMessage();
        } 
    }
    
    function query($sql)
    {
        var_dump(mysqli_query($this->con, $sql));
        //return mysqli_query($this->con, $sql);
    }
    
    function close()
    {
        mysqli_close($this->con);
    }
}

