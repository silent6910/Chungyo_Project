<?php
    require_once("connect_db.php");
    
    class carpool_mycarpool
    {
        // 以下是讀需要寫入view的資料
        function __construct()
        {
            $this->connect=new databaseuse;
            $this->DB=$this->connect->DB;
            $this->DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        function __destruct()
        {
            $this->DB=null;
        }
        function load_data($ID) //把這ID的共乘資訊全印出來
        {
            $result=$this->DB->query("select  * from Carpool_data
            inner join Carpool_data_plus 
            using(ID)
            where ID='{$ID}'");
            return $result;
        }
        function load_data_member($ID)  //印出這次共乘的所有成員
        {
            return $this->DB->query("select  Account from Carpool_ID_AC
	        where ID='{$ID}'");
	        
        }
        
        //以下是做退出共乘的function
        function User_quit($ID,$Account,$type)       //哪個ID與此次ID一樣則歸零，並依照type決定是司機不在提供座位給此使用者，或者一般使用者退出該次共乘
        {
            $this->DB->query("update User_AC_PW set 
            ID_count=ID_count-1 where Account='{$Account}'");
            $this->DB->query("DELETE FROM `Carpool_ID_AC` where ID='{$ID}' AND Account='{$Account}' ");
            ($type=='passenger')?
                $this->DB->query("update Carpool_data set ps_boolean=0 where ID='{$ID}'")
                :$this->DB->query("update Carpool_data set lack=lack+1 where ID='{$ID}'");
        }
        function check_ischeat($ID)
        {
            return $this->DB->query("select * from Carpool_data where ID='{$ID}'")->fetch();
        }
        function master_quit($ID)    //如果該使用者是主揪，則刪除所有此次共乘資訊
        {
            try{
                $this->DB->beginTransaction();
                $this->DB->query("DELETE FROM `Carpool_data` where ID='{$ID}' ");
                $this->DB->query("DELETE FROM `Carpool_data_plus` where ID='{$ID}' ");
                $this->DB->query("DELETE FROM `Carpool_ID_AC` where ID='{$ID}' ");
                $condition="(select Account from Carpool_ID_AC where ID='{$ID}')";
                $this->DB->query("update User_AC_PW set ID_count=ID_count-1 where Account=$condition");
                $this->DB->commit();
                return "delete";
            }
             catch (PDOException $err) {
            	$this->DB->rollback();//回溯
            	error_log($err->getMessage()."\n",3,"./php_errors.log"); //將錯誤寫入log裡
                return ("error");
            }
            
        }
        function check_ID_count($Account) //用來判斷使用者是否已有三個共乘活動
        {
            return $this->DB->query("SELECT  `ID_count` FROM `User_AC_PW` WHERE `Account`='{$Account}'");
        }
        function join($ID,$Account)   //更新該使用者的ID，並依照TYPE去更新該次共乘資訊
        {
            $this->DB->beginTransaction();
            $User_AC_PW=$this->DB->exec("update User_AC_PW set 
            ID_count=ID_count+1 where Account='{$Account}'");
            $Carpool_ID_AC=$this->DB->exec("INSERT INTO `Carpool_ID_AC`(`ID`, `Account`) VALUES ('{$ID}','{$Account}')");
		    $Carpool_data=($_POST['type']=='driver')?
    			$this->DB->exec("update Carpool_data SET lack=lack-1 
    			where ID='{$ID}'")
    			:$this->DB->exec("update Carpool_data SET ps_boolean=1 
    			where ID='{$ID}'");
    		if($User_AC_PW!=1 || $Carpool_ID_AC!=1 || $Carpool_data!=1) //若有任一SQL statement沒有成功，就回溯
    		{
    		    $this->DB->rollback();//回溯
    		    error_log("join出錯，三個SQL影響行數分別為".$User_AC_PW."_".$Carpool_ID_AC."_".$Carpool_data
    		    ."\n",3,"./php_errors.log"); //將錯誤寫入log裡
    		    return "error";
    		}
    		else
    		    $this->DB->commit();
    		return "true";
        }
        
    }
?>