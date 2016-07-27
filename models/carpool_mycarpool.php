<?php
    require_once("connect_db.php");
    
    class carpool_mycarpool
    {
        // 以下是讀需要寫入view的資料
        function __construct()
        {
            $this->connect=new databaseuse;
            $this->DB=$this->connect->DB;
        }
        function __destruct()
        {
            $this->DB=null;
        }
        function control() //把這ID的共乘資訊全印出來
        {
            $result=$this->DB->query("select  * from Carpool_data
            inner join Carpool_data_plus 
            using(ID)
            where ID='{$_GET['id']}'");
            return $result;
        }
        function control_member()  //印出這次共乘的所有成員
        {
            return $this->DB->query("select  Account from User_AC_PW
	        where ID1='{$_GET['id']}' or ID2='{$_GET['id']}' or ID3='{$_GET['id']}'");
	        
        }
        
        //以下是做退出共乘的function
        
        function check_userdata()    //查詢此使用者的ID (主要用途)
        {
            return $this->DB->query(
	        "select * from User_AC_PW where Account='{$_POST['Account']}'");
        }
        function quit_updateID($ID)       //哪個ID與此次ID一樣則歸零，並依照type決定是司機不在提供座位給此使用者，或者一般使用者退出該次共乘
        {
            $this->DB->query("update User_AC_PW set 
            $ID=0 where Account='{$_POST['Account']}'");
            if($_POST['type']=='passenger')
                $this->DB->query("update Carpool_data set ps_boolean=0 where ID='{$_POST['ID']}'");
            else
                $this->DB->query("update Carpool_data set lack=lack+1 where ID='{$_POST['ID']}'");
        }
        function check_ischeat()
        {
            return mysqli_fetch_array($this->DB->query("select * from Carpool_data where ID='{$_POST['ID']}'"));
        }
        function master_quit()    //如果該使用者是主揪，則刪除所有此次共乘資訊
        {
            $this->DB->query("DELETE FROM `Carpool_data` where ID='{$_POST['ID']}' ");
            $this->DB->query("DELETE FROM `Carpool_data_plus` where ID='{$_POST['ID']}' ");
            $this->DB->query("update User_AC_PW set ID1=0 where ID1='{$_POST['ID']}'");
            $this->DB->query("update User_AC_PW set ID2=0 where ID2='{$_POST['ID']}'");
            $this->DB->query("update User_AC_PW set ID3=0 where ID3='{$_POST['ID']}'");
        }
        function lack_reduce($ID)   //更新該使用者的ID，並依照TYPE去更新該次共乘資訊
        {
            $this->DB->query("update User_AC_PW set $ID='{$_POST['ID']}' where Account='{$_POST['Account']}'");
		    ($_POST['type']=='driver')?
    			$this->DB->query("update Carpool_data SET lack=lack-1 
    			where ID='{$_POST['ID']}'"):
    			$this->DB->query("update Carpool_data SET ps_boolean=1 
    			where ID='{$_POST['ID']}'");
        }
        
    }
?>