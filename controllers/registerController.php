<?php
//處理註冊頁面
    session_start();
    class registerController extends Controller
    {
        function index()
        {
            $this->view("carpool_register.html");
        }
        function register()
        {
            if(!isset($_POST['Account'])||!isset($_POST['Password']))
                die("請輸入正確");
            else if(!preg_match("/^([0-9A-Za-z]+)$/",$_POST['Account'])) 
            //如果帳號不為英文或數字則告知client錯誤
            {
                echo json_encode("no");
                die();
            }
            $register=$this->model("register");
            if($register->register_verify()->rowCount()>0) 
                echo json_encode(false);
            else{
                $register->register();
                echo json_encode(true);
            }
            
        }
    }
?>
