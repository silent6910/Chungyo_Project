<?php
require_once("connect_db.php");

    class index {
       
        function __construct()
        {
            $this->connect=new databaseuse;
            $this->DB=$this->connect->DB;
            $this->DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //設定屬性,ATTR_ERRMODE:錯誤回報,ERRMODE_EXCEPTION:Throw exceptions
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
        function member($Account)  //取出該使用者的共乘資訊，並加入該主揪的暱稱(主要功能)
        {
            $ID="select ID from Carpool_ID_AC where Account='{$Account}'"; //取出Carpool_ID_AC的ID作為搜尋Carpool_data的ID用
            $Inner="INNER JOIN User_data USING ( Account ) "; //查詢該共乘主揪的暱稱
	        return $this->DB->query("select Carpool_data. * , User_data.Nickname
	        from ($ID) as ID,`Carpool_data` $Inner where Carpool_data.ID = ID.ID");
        }
        function modify_data($Account)  //修改會員資料
        {
            try{
                $this->DB->beginTransaction();
                if($_POST['nickname']!='')
                    $this->DB->query("UPDATE `User_data` SET `Nickname`='{$_POST['nickname']}'
                    where Account='{$Account}'");
                if($_POST['e-mail']!='')
                    $this->DB->query("UPDATE `User_data` SET `E-mail`='{$_POST['e-mail']}'
                    where Account='{$Account}'");
                $pw=md5($_POST['Password']);
                $this->DB->query("UPDATE `User_AC_PW`  set Password='{$pw}'
                where Account='{$Account}'");
                $this->DB->commit();
            }
            catch (PDOException $err) {
            	$this->DB->rollback();    //回溯
                return $err->getMessage();
            }
        }
        function user_nickname($Account)  //印出該會員的暱稱
        {
            $sql="select Nickname from User_data where Account ='{$Account}'";
            $row=$this->DB->query($sql)->fetch();
            return $row['Nickname'];
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