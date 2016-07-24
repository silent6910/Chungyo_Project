

<!DOCTYPE html>
<html lang="zh">
<head >
    <form action='carpool_publish.php' method=post> 
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <!-- 最新編譯和最佳化的 CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">

<!-- 選擇性佈景主題 -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">

<!-- 最新編譯和最佳化的 JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

  <link rel="stylesheet" href="/resources/demos/style.css">
    <link rel="stylesheet" href="https://job-qwerrtty.c9users.io/project_test2/views/css/carpool_member_carpool.css">

</head>
<body>
    <h3>會員共乘資訊</h3>
    <div class="content">
        <div class="indexWrap" >
            
          		<ul class="list-group" >
    	<?php while ($row =mysqli_fetch_array($data['result'])) : ?>
    		<li style=" width:450px;height:90px;" class="list-group-item">
    			<a href="../carpool_mycarpool?id=<?php echo $row["ID"] ?>"> 
    			
    			<p ><?php echo $row["date"] . "  " . $row["time"] ?> 
    			    <font style="float:right;font-size:1.3em"><?php   echo  $row['Account']; if(isset($row['Nickname'])) echo "(".$row['Nickname'].")" ?></font>
    			</p>
    			<img src="<?php echo $data['photo'].'?Account='.$row['Account']?>" style="width:50px;height:50px;float:right;"></img> 
    			<p style="font-size:1.0em"><?php echo $row["pointA"] . " 到 " . $row["pointB"] ?></p>
    		    <p><?php  echo ($row['type']=='passenger')?
    		                    "需要".$row['lack']."個空位":
    		                    "還剩".$row['lack']."個空位";?></p>
    		    </a>
    	 	</li>
    	 	
    	<?php endwhile ?>
    	</ul>
        </div>
    </div>
    
    
    
</body>
</html>