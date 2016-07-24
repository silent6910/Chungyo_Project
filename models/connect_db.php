
<?php
class databaseuse
{
    
    private $connect;
    private $url="localhost",
            $account="root",
            $password="asd456",
            $database="project";
    function __construct()
    {
        $this->connect=mysqli_connect
        ($this->url,$this->account,$this->password,$this->database);
          mysqli_query($this->connect,"set names utf8");
          mysqli_query($this->connect,"SET CHARACTER_SET_RESULTS=UTF8;");
    }
    function get_database_url()
    {
        return $this->url;
    }
    function get_database_account()
    {
        return $this->account;
    }
    function get_database_password()
    {
        return $this->password;
    }
    function get_database_database()
    {
        return $this->database;
    }
    function connect()
    {
        if(!$this->connect)
            die("連不上資料庫");
        else
            echo "OK";
    }
    function sql_query($query)
    {
        return mysqli_query($this->connect,$query);
    }
    function sql_fetch_array($result)
    {
        return mysqli_fetch_array($result);
    }
    function sql_num_rows($result)
    {
        return mysqli_num_rows($result);
    }
    function sql_affected_rows()
    {
        return mysqli_affected_rows($this->connect);
    }
}
?>