<?php

class App {
    
  public function __construct() {
        $url = $this->parseUrl();
        
        $controllerName = "{$url[0]}Controller";
        if (!file_exists("controllers/$controllerName.php")) //若此Controller不存在，則導向本人自制的404網頁
        {
            require_once(dirname(__FILE__)."/error404.html");
            return;
        }
        require_once "controllers/$controllerName.php";
        $controller = new $controllerName;
        $methodName = isset($url[1]) ? $url[1] : "index";  //若不存在第二個參數，則呼叫名為index的method
        if (!method_exists($controller, $methodName))
        {
            require_once(dirname(__FILE__)."/error404.html");
            return;
        }
        unset($url[0]); unset($url[1]);
        $params = $url ? array_values($url) : Array();
        call_user_func_array(Array($controller, $methodName), $params); //這行CALL method
    }
    //網址的參數作切割，例如https://job-qwerrtty.c9users.io/project_test2/index/membercarpool
    // 把index/membercarpool切出來，$url[0]即是index，亦是Controller的名稱
    //membercarpool是$url[1]，即indexController裡的membercarpool method
    public function parseUrl() {    
        if (isset($_GET["url"])) {
            $url = rtrim($_GET["url"], "/");
            $url = explode("/", $url);
            return $url;
        }
    }
    
}

?>