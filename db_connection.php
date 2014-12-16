<?php

class Db extends mysqli
{
    public function __construct($host = 'localhost', $user = 'root', $pw = NULL, $db = 'chat')
    {
        parent::__construct($host, $user, $pw, $db);
    }
    
    public function getPosts()
    {
        $sql = "SELECT post.message, post.timestamp, user.name FROM post JOIN user ON user.id = post.user_id ORDER BY post.timestamp DESC";
        return $this->getQueryData($this->query($sql));
    }
    
    public function getMessages($user_id)
    {
        $current_user_id = $_SESSION['current_user_id'];
        $sql = "SELECT message.text, message.timestamp, user.name FROM message JOIN user ON message.send_user_id = user.id OR message.receive_user_id = 'user.id'"
                . " WHERE  message.send_user_id = '$current_user_id' AND message.receive_user_id = '$user_id'"
                . " OR message.send_user_id = '$user_id' AND message.receive_user_id = '$current_user_id' ORDER BY message.timestamp";
         //AND message.receive_user_id = '$user_id' OR message.send_user_id = '$user_id' AND message.receive_user_id = '$current_user_id' 
                //. "WHERE message.receive_user_id = '$user_id'";
        return $this->getQueryData($this->query($sql));
    }
    
    public function sendMessage($receiver_id)
    {
        $message = filter_input(INPUT_POST, "message", FILTER_SANITIZE_STRING);
        $current_user_id = $_SESSION['current_user_id'];
        $sql = "INSERT message (`text`, `send_user_id`, `receive_user_id`) VALUES ('$message', '$current_user_id', '$receiver_id')";
        $this->query($sql);
    }
    
    public function getChatPartner($user_id)
    {
        $sql = "SELECT id, name FROM user WHERE id = '$user_id'";
        return $this->getQueryData($this->query($sql));
    }
    
    public function getUsers()
    {
        $sql = "SELECT * FROM user";
        return $this->getQueryData($this->query($sql));
    }
    
    public function doPost()
    {
        $post = filter_input(INPUT_POST, "post", FILTER_SANITIZE_STRING);
        $user_id = $_SESSION['current_user_id'];
        $sql = "INSERT post (message, user_id) VALUES ('$post', '$user_id')";
        $this->query($sql);
    }
    
    
    
    public function getQueryData($sqlQuery)
    {
        $arr = array();
        while ($dsatz = $sqlQuery->fetch_assoc())
        {
            $arr[] = $dsatz;
        }
        //return mysqli_fetch_assoc($res);
        return $arr;
    }
    
    public function authenticate($name, $password)
    {
        $sql = "SELECT * FROM user WHERE name = '$name' AND password = '$password'";
        if ($res = $this->query($sql))
        {
            return $this->getQueryData($res);
        }
        else
        {
            return false;
        }
        //$res = $this->getQueryData($this->query($sql));
        //return $res;
    }
    
    public function signUp()
    {
        $name = filter_input(INPUT_POST, "username", FILTER_SANITIZE_STRING);
        $password_1 = md5(filter_input(INPUT_POST, "password_1", FILTER_SANITIZE_STRING));
        $password_2 = md5(filter_input(INPUT_POST, "password_2", FILTER_SANITIZE_STRING));

        $sql = "INSERT user (name, password) VALUES ('$name', '$password_1')";
        if ($password_1 != $password_2) 
        {
            $_SESSION['error'] = "Passwörter stimmen nicht überein.";
            header("Location: sign_up.php");
        }
        elseif ($this->query($sql))
        {
            $_SESSION['message'] = "Benutzer erfolgreich erstellt.";
            header("Location: index.php");
        }
        else
        {
            $_SESSION['error'] = "Der User mit dem Namen $name ist bereits vorhanden.";
            header("Location: index.php");
        }
        //return;
    }
}

//$db = new Db('localhost','root','','firma');

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
    
//    function connect()
//    { 
//        try
//        {
//            if ($this->con = mysqli_connect($this->host, $this->db_user))
//            {
//                mysqli_select_db($this->con, $this->db);
//            }
//            else
//            {
//                throw new Exception('Unable to connect');
//            }
//            
//        } catch (Exception $e) {
//            echo $e->getMessage();
//        } 
//    }
    
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
        return;
    }
}

