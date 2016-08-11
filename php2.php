<?php
$str="April 2015";
$replacement="$2,$1 $3";
$patten="/^[A-Za-z],+$/i" ;
echo preg_replace($patten,$replacement,$str);

//這題我只記得patten前部分是長這樣，後面是XXX/i這樣，但我不管怎樣寫 echo出來的值都是April 2015

?>
