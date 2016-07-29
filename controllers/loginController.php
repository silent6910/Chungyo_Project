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
            
            // $login=$this->model("login");
            $login=$this->model("login");
            if($login->login()->rowCount()>0)
            {
         	   echo ("true");
         	   $_SESSION['user']=$_POST['Account'];
	        }
	        else
         	   echo ("false");
        	
        }
    }
?>