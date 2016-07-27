<?php
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
            $row=mysqli_fetch_array($this->connect->sql_query("SELECT MAX( ID ) AS ID FROM Carpool_data"));
            return $row['ID'];
        }
        function publish()     //刊登
        {
            $ID=$this->getMAXID()+1;
            if($this->setID($ID)==true)
            {
                $this->insert_Carpool_data($ID);
                $this->insert_Carpool_data_plus($ID);
                return true;
            }
            else
                return false;
        }
        function setID($ID)  //將使用者的ID設成該次共乘的ID，如三個ID都不為零，則告知該使用者已有三個共乘活動
        {
            $row=$this->connect->sql_fetch_array($this->connect->sql_query("select * from User_AC_PW where Account='{$_POST['Account']}'"));
    		if($row['ID1']==0)
    			$this->connect->sql_query("update User_AC_PW set ID1=$ID where Account='{$_POST['Account']}'");
    		else if($row['ID2']==0)
    			$this->connect->sql_query("update User_AC_PW set ID2=$ID where Account='{$_POST['Account']}'");
    		else if($row['ID3']==0)
    			$this->connect->sql_query("update User_AC_PW set ID3=$ID where Account='{$_POST['Account']}'");
    		else	
    		    return false;
            return true;
        }
        function insert_Carpool_data($ID)    //寫入該共乘所有資訊
        {
            $_POST['pointA']=htmlspecialchars($_POST['pointA']);
            $_POST['pointB']=htmlspecialchars($_POST['pointB']);
            $this->connect->sql_query("INSERT INTO 
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
            $this->connect->sql_query("INSERT INTO `Carpool_data_plus`
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