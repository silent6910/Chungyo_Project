<?php
######################################
//此Controller處理login頁面
######################################
    session_start(); 
    class loginController extends Controller
    {
        function index()  //印出view
        {
            $this->view("carpool_login.html");
        }
        function login()  //處理login的事項
        {
            if(!isset($_POST['Account']) || !isset($_POST['Password']))
		        die("false");
            $login=$this->model("login");
            $conunt=$login->login();
            if(count($login->login())>0)
            {
        	   echo json_encode(true);
        	   $_SESSION['user']=$_POST['Account'];
	        }
	        else
        	   echo json_encode(false);
        	
        }
    }
?>