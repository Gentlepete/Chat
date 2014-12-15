<?php

class connection
{
    private $db_user = "root";
    private $host = "localhost";
    private $con;
    private $db = "chat";
    
//    function __construct($host = NULL, $db_user = NULL) 
//    {
//        $this->host = $host;
//        $this->db_user = $db_user;
//    }
    
    function connect()
    { 
        try
        {
            if ($this->con = mysqli_connect($this->host, $this->db_user))
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
        //var_dump(mysqli_query($this->con, $sql));
        return mysqli_query($this->con, $sql);
    }
    
    function get_query_data($res)
    {
        $arr = array();
        while ($dsatz = mysqli_fetch_assoc($res))
        {
            $arr[] = $dsatz;
        }
        //return mysqli_fetch_assoc($res);
        return $arr;
    }
    
    function close()
    {
        mysqli_close($this->con);
    }
}

