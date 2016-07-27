<?php
require_once("connect_db.php");

    class index {
       
        function __construct()
        {
            $this->connect=new databaseuse;
            $this->DB=$this->connect->DB;
        }
        function __destruct()
        {
            $this->DB=null;
        }
        function index()  // 印出前五筆的共乘資訊
        {
            $result=$this->DB->query("SELECT * 
            FROM Carpool_data
            INNER JOIN User_data
            USING ( Account ) 
            ORDER BY ID DESC 
            LIMIT 0 , 5");
            return $result;
        }
        function search()     //查詢關鍵字的共乘
        {
            $pointB=$_GET['pointB'];
            $result=$this->DB->query
            ("select  * from Carpool_data 
            INNER JOIN User_data
            USING ( Account )
            where pointB like '%$pointB%' ");
            return $result;
	 
        }
        function allcarpool()   //印出所有共乘資訊
        {
            $result=$this->DB->query("select  * from Carpool_data 
            INNER JOIN User_data
            USING ( Account )
            where 1 
            ORDER BY ID DESC");
	        return $result;
        }
        function member()  //取出該使用者的共乘資訊，並加入該主揪的暱稱(主要功能)
        {
            $Account=$_SESSION['user'];
            $result_ID=$this->DB->query("select  ID1,ID2,ID3 from User_AC_PW where
	                Account='{$Account}'")->fetch();
	        return $this->DB->query("select  * from Carpool_data
                                            INNER JOIN User_data
                                            USING ( Account )where
                                            ID='{$result_ID['ID1']}' or 
                                            ID='{$result_ID['ID2']}' or
                                            ID='{$result_ID['ID3']}'
                                            ORDER BY ID DESC");
        }
        function modify_data($Account)
        {
            if($_POST['nickname']!='')
            $this->DB->query("UPDATE `User_data` SET `Nickname`='{$_POST['nickname']}'
            where Account='{$Account}'");
            if($_POST['e-mail']!='')
            $this->DB->query("UPDATE `User_data` SET `E-mail`='{$_POST['e-mail']}'
            where Account='{$Account}'");
            $pw=md5($_POST['Password']);
            $this->DB->query("UPDATE `User_AC_PW`  set Password='{$pw}'
            where Account='{$Account}'");
        }
        function upload_photo()   //上傳圖片
        {
            $id = $_POST["txtID"];
        	$f = fopen($_FILES["fileImage"]["tmp_name"], "rb");
        	$picture = addslashes(fread($f, $_FILES["fileImage"]["size"]));
        	$this->DB->query("update User_data set photo='$picture' where Account='{$_SESSION['user']}'");
        	
        }
    }

    ?>