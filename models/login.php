<?php
    require_once("connect_db.php");
    
    class login
    {
        function __construct()
        {
            $this->connect=new databaseuse;
            $this->DB=$this->connect->DB;
        }
        function __destruct()
        {
            $this->DB=null;
        }
        function login()      
        {
            $PW=md5($_POST['Password']);
        	return $this->DB->query("select  * from User_AC_PW where
        	Account='{$_POST['Account']}' AND Password='{$PW}'");
        }
    }
?>