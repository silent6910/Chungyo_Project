<?php
    function abc(&$ab)
    {
        $ab++;
        return $ab;
    }
    $ab=12;
    abc($ab);
    echo $ab;
    //這題我有猜對，帶址的參數會實際影響到該參數的值
?>