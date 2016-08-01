<?php
session_start();
class carpool_mycarpoolController extends Controller{
    function index()
    {
        $this->view("carpool_mycarpool.html");
    }
    function load_data()            //做資料寫入view的動作，拿get到的ID去搜資料庫，把資料塞進view裡，respond給使用者
    {
        $load=$this->model("carpool_mycarpool");
        $result=$load->load_data($_GET['id']);    //載入該次共乘資訊
        $member=$load->load_data_member($_GET['id']);  //載入該次共乘的所有使用者
        while($row_member=$member->fetch())
		    $sting_member.="成員:".$row_member['Account']." ";
        $row=$result->fetch();
        $array=array("member"=>$sting_member);
        echo json_encode(array_merge($row,$array),JSON_UNESCAPED_UNICODE);
        //將兩個不同的result合併
    }
    function quit() //這function 做會員退出共乘
    {
        if(!isset($_SESSION['user'])|| !isset($_POST['ID'])||!isset($_POST['type']))
            die("請輸入正確");
        $quit=$this->model("carpool_mycarpool");
        if($_SESSION['user']==$_POST['Account'])  //如果要退出共乘的使用者是主揪，就刪除這次共乘活動
        {                           //並且更新所有使用者與此次共乘相同的ID
            echo ($quit->master_quit($_POST['ID']));
            exit();
        }
        $quit->User_quit($_POST['ID'],$_SESSION['user'],$_POST['type']);
        echo ("quit");
        exit();
    }
    function join()  //此function讓使用者加入該次共乘
    {
        if(!isset($_SESSION['user']))
        {
            echo ("login");
            exit();
        }
        $join=$this->model("carpool_mycarpool"); 
        $check_ischeat=$join->check_ischeat($_POST['ID']);
        if($check_ischeat['lack']==0 || $check_ischeat['ps_boolean']==1)  //驗證使用者是否透過更改前端的內容，破壞加入的規則
        {
            echo ("cheat");
            exit();
        }
        $ID_count=$join->check_ID_count($_SESSION['user'])->fetch();
        if($ID_count['ID_count']>=3)  //驗證該使用者是否已經有三個共乘活動
        {
            echo ("false");
		    exit();
        }
    	else
    	{
		    echo $join->join($_POST['ID'],$_SESSION['user']);
		}
    }
}
?>
