<?php
session_start();   //此只做session的評斷，若有則回傳該使用者的AC，若無則回傳false
class checksessionController extends Controller
{
  function index()
  {
    echo (isset($_SESSION['user']))?("true"):("false");
  }
}
?>