<?php
    require_once("connect_db.php");
    
    class login
    {
        function __construct()
        {
            $this->connect=new databaseuse;
        }
        function login()
        {
            $PW=md5($_POST['Password']);
        	return $this->connect->sql_query("select  * from User_AC_PW where
        	Account='{$_POST['Account']}' AND Password='{$PW}'");
        }
    }
?>