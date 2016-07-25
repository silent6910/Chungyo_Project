<?php
##########################################
//處理刊登的頁面
##########################################

    class publishController extends Controller
    {
        function index()
        {
            $this->view("carpool_publish.html");
        }
        function publish()  //處理刊登的事項
        {
            if(!isset($_POST['Account']) &&!isset($_POST['ID']))
		        die("請輸入正確");
            $publish=$this->model("publish");
            echo json_encode($publish->publish());
        }
    }
?>