<?php
$dbh = new PDO("mysql:host=localhost;dbname=project", "root", "asd456");
//$dbh->exec("set names utf8");

$result = $dbh->query("select * from User_data where Account='{$_GET['Account']}'");
$row = $result->fetch();

//$f = fopen("/tmp/image1.jpg", "w");
//fwrite($f, $row["cPicture"]);
//fclose($f);

   
header("content-type:image/jpeg", true);
echo $row["photo"];

$dbh = NULL;
//echo "Done.";
?>
