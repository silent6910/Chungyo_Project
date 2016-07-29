<?php
    ################這個model測試做完所有商業邏輯
    require_once("connect_db.php");
    class publish
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
        function getMAXID()  //取出最大ID並+1
        {
            $row=$this->DB->query("SELECT MAX( ID ) AS ID FROM Carpool_data")->fetch();
            return $row['ID'];
        }
        function publish()     //刊登
        {
            try{
                $this->DB->beginTransaction();  //若有任一個SQL語句出錯，則全部回溯
                $ID=$this->getMAXID()+1;
                if($this->setID($ID)==true)
                {
                    $this->insert_Carpool_data($ID);
                    $this->insert_Carpool_data_plus($ID);
                    $this->DB->commit();
                    return true;
                }
                else
                    return false;
            }
            catch (PDOException $err) {
            	$this->DB->rollback();
                return $err->getMessage();
            	exit();
            }
        }
        function setID($ID)  //將使用者的ID設成該次共乘的ID，如三個ID都不為零，則告知該使用者已有三個共乘活動
        {
            $row=$this->DB->query("select * from User_AC_PW 
            where Account='{$_POST['Account']}'")->fetch();
    		if($row['ID1']==0)
    			return $this->DB->query("update User_AC_PW set ID1=$ID 
    			where Account='{$_POST['Account']}'")->rowCount();
    		else if($row['ID2']==0)
    			return $this->DB->query("update User_AC_PW set ID2=$ID 
    			where Account='{$_POST['Account']}'")->rowCount();
    		else if($row['ID3']==0)
    			return $this->DB->query("update User_AC_PW set ID3=$ID 
    			where Account='{$_POST['Account']}'")->rowCount();
    		else	
    		    return false;
        }
        function insert_Carpool_data($ID)    //寫入該共乘所有資訊
        {
            $_POST['pointA']=htmlspecialchars($_POST['pointA']);
            $_POST['pointB']=htmlspecialchars($_POST['pointB']);
            $this->DB->query("INSERT INTO 
        	`Carpool_data`
        	(  `Account` ,  `ID` ,  `pointA` ,  `pointB` ,  `date` ,  `time` , `lack` ,  `price`,`type`) 
        	VALUES (
        	'{$_POST['Account']}','{$ID}' , 
        	'{$_POST['pointA']}',
        	'{$_POST['pointB']}',
        	'{$_POST['date']}',
        	'{$_POST['time']}',
        	'{$_POST['lack']}',
        	'{$_POST['price']}',
        	'{$_POST['type']}'
        	)");
        }
        function insert_Carpool_data_plus($ID)      //寫入該共乘所有額外資訊
        {
            $this->DB->query("INSERT INTO `Carpool_data_plus`
        	(`ID`, `food`, `pet`, `baggage`, `smoke`, `remark`)
        	VALUES(
        	'{$ID}',
        	'{$_POST['food']}',
        	'{$_POST['pet']}',
        	'{$_POST['baggage']}',
        	'{$_POST['smoke']}',
        	'{$_POST['remark']}')");
        }
    }