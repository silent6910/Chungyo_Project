<?php
        try{
        $ID="1";
        $Account='sss';
        $test = new PDO("mysql:host=localhost;dbname=project",
        "root","asd456") ;
        $test->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $test->beginTransaction();
        $test->exec("set names utf8");
        $test->exec("insert into Carpool_ID_AC values(1,'aa')");
        $test->exec("INSERT INTO  `Carpool_ID_AC` (`ID`,`Account`) 
            qdqqqdqt}'");
        $test->commit();
        $test=null;
        }
        catch (PDOException $err) {
            $test->rollback();
                echo $err->getMessage();
            }
?>