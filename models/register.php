<?php
    require_once("connect_db.php");
    class register
    {
        function __construct()
        {
            $this->connect=new databaseuse;
        }
        function register_verify()  //驗證有無重複
        {
            return $this->connect->sql_query(
             "select * 
             from User_AC_PW
             where Account='{$_POST['Account']}'");
        }
        function register()
        {
            $PW=md5($_POST['Password']);
            $_POST['Account']=htmlentities($_POST['Account']);      //將特殊字元轉碼
            $_POST['nickname']=htmlentities($_POST['nickname']);
            $this->connect->sql_query("INSERT INTO `User_AC_PW`
            (`Account`, `Password`) VALUES ('{$_POST['Account']}'
            ,'{$PW}')");
            $this->connect->sql_query("INSERT INTO `User_data`
            (`Account`, `Gender`, `Nickname`, `E-mail`)
            Values(
            '{$_POST['Account']}',
            '{$_POST['gender']}',
            '{$_POST['nickname']}',
            '{$_POST['e-mail']}')");
        }
    }
?>
