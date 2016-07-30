<?php
##########################################
//處理刊登的頁面  這個Controller測試model做完所有商業邏輯
##########################################
session_start();

    class publishController extends Controller
    {
        function index()
        {
            $this->view("carpool_publish.html");
        }
        function publish()  //處理刊登的事項
        {
            if(!isset($_SESSION['user']))
		        die("請輸入正確");
            $publish=$this->model("publish");
            echo json_encode($publish->publish($_SESSION['user']));
        }
    }
?>