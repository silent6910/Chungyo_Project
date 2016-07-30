<?php
    ################這個model測試做完所有商業邏輯
    require_once("connect_db.php");
    class publish
    {
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
        function publish($Account)     //刊登
        {
            try{
                $this->DB->beginTransaction();  //若有任一個SQL語句出錯，
                //則全部回溯(得搭配setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);)
                if($this->ID_count($Account)>=1)
                {
                    $this->ID_count_add($Account);
                    $ID=$this->getMAXID()+1;      //取出最大ID並+1
                    $this->insert_Carpool_ID_AC($ID,$Account); //插入負責存放ID對應AC的table
                    $this->insert_Carpool_data($ID);           //寫入該共乘所有資訊
                    $this->insert_Carpool_data_plus($ID);      //寫入該共乘所有額外資訊
                    $this->DB->commit();
                    return true;
                }
                else
                    return false;
            }
            catch (PDOException $err) {
            	$this->DB->rollback();    //回溯
                return $err->getMessage();
            }
        }
        function ID_count($Account)  //回傳使用者現在是否已經有三個共乘活動
        {
            return $this->DB->query("select ID_count from User_AC_PW 
            where Account='{$Account}' AND ID_count<3")->rowCount();
        }
        function ID_count_add($Account)  //增加該使用者的共乘總數
        {
             $this->DB->query("update User_AC_PW 
             set ID_count=ID_count+1 where Account='{$Account}'");
        }
        function getMAXID()  //取出最大ID並+1
        {
            $row=$this->DB->query("SELECT MAX( ID ) AS ID FROM Carpool_data")->fetch();
            return $row['ID'];
        }
        function insert_Carpool_ID_AC($ID,$Account)  //插入負責存放ID對應AC的table
        {
            $this->DB->query("INSERT INTO  `Carpool_ID_AC` (`ID`,`Account`) 
            values('{$ID}','{$Account}')");
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