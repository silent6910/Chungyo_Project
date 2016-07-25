<?php
session_start();
class carpool_mycarpoolController extends Controller{
    function index()
    {
        $this->view("carpool_mycarpool.html");
    }
    function control()            //做資料寫入view的動作
    {
        $control=$this->model("carpool_mycarpool");
        $result=$control->control();
        $member=$control->control_member();
        while($row_member=mysqli_fetch_array($member))
		    $sting_member.="成員:".$row_member['Account']." ";
        $row=mysqli_fetch_array($result);
        $array=array("member"=>$sting_member);
        echo json_encode(array_merge($row,$array),JSON_UNESCAPED_UNICODE);
        //將兩個不同的result合併
    }
    function quit() //這function 做會員退出共乘
    {
        if(!isset($_POST['Account']) && !isset($_POST['ID']))
            die("請輸入正確");
        $quit=$this->model("carpool_mycarpool");
        if($_POST['match']=="true")  //如果要退出共乘的使用者是主揪，就刪除這次共乘活動
        {                           //並且更新所有使用者與此次共乘相同的ID
            $quit->master_quit();
            echo json_encode("delete");
            exit();
        }
        $row=mysqli_fetch_array($quit->check_userdata()); //退出的如果是一般使用者，則更新該使用者的ID
        if($row['ID1']==$_POST['ID'])
	        $quit->quit_updateID("ID1");
    	else if($row['ID2']==$_POST['ID'])
    	    $quit->quit_updateID("ID2");
    	else if($row['ID3']==$_POST['ID'])
    	    $quit->quit_updateID("ID3");
        echo json_encode("quit");
        exit();
    }
    function join()  //此function讓使用者加入該次共乘
    {
        if(!isset($_SESSION['user']))
        {
            echo json_encode("login");
            exit();
        }
        $join=$this->model("carpool_mycarpool"); 
        $check_ischeat=$join->check_ischeat();
        if($check_ischeat['lack']==0 || $check_ischeat['ps_boolean']==1)  //驗證使用者是否透過更改前端的內容，破壞加入的規則
        {
            echo json_encode("cheat");
            exit();
        }
        $row=mysqli_fetch_array($join->check_userdata()); //使用者的哪個ID為0就更新為此次共乘的ID就退出，並回傳成功訊息
        if($row['ID1']==0)
		    $join->lack_reduce("ID1");
    	else if($row['ID2']==0)
    		$join->lack_reduce("ID2");
    	else if($row['ID3']==0)
    		$join->lack_reduce("ID3");
    	else
    	{
		    echo json_encode(false);
		    exit();
		}                           //若三個ID都不為零，則說明該使用者已有三個共乘活動
        echo json_encode(true);
    }
}
?>
