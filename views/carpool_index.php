

<!DOCTYPE html>

<html lang="zh">
<head >
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <!-- 最新編譯和最佳化的 CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">

<!-- 選擇性佈景主題 -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">

<!-- 最新編譯和最佳化的 JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>

 <script type="text/javascript" src="https://job-qwerrtty.c9users.io/project_test2/views/js/jquery.js"></script>
 <script type="text/javascript" src="https://job-qwerrtty.c9users.io/project_test2/views/js/carpool_index.js"></script>
 
 <link rel="stylesheet" type="text/css" href="https://job-qwerrtty.c9users.io/project_test2/views/css/carpool_index.css" />

</head>  
<body style="font-family:Microsoft JhengHei; ">
  <ul class="nav nav-tabs"  >
        <li><a  href="https://job-qwerrtty.c9users.io/project_test2/index">首頁</a></li>
        <li><a  href="https://job-qwerrtty.c9users.io/project_test2/register">註冊</a></li>
        <li id="login"><a  ><?php  echo $data['word'];  ?></a></li>
        <li><a  href="https://job-qwerrtty.c9users.io/project_test2/publish" style="color:green">刊登</a></li>
        <li><a  href="https://job-qwerrtty.c9users.io/project_test2/index/membercarpool" style="float:right;">會員的共乘
        </a></li>
        <li style="float:right;margin-top:5px"><font style="font-size:20px">你好  
        <?php echo $data['user'] ?></font></li>
        <li><a href="https://job-qwerrtty.c9users.io/project_test2/index/upload_photo_view" style="color:blue;font-weight:bolder">上傳大頭貼</a></li>
        <li><a href="https://job-qwerrtty.c9users.io/project_test2/index/modify_data" >修改會員資料</a></li>
        <!-- Single button -->
    </ul>
<br>
  <div class="search">
         <input id="search_text" type="text" name="a" style="width:250px;height:35px;" 
         placeholder="要到哪呢?"/>
         <button  id='search_button'type="button"> 搜尋</button>
         
   </div>
   <div class="content">
       <div class="button">
      <button type="button" id="new"name='new' >最新共乘資訊</button>
      <button type="button"  id="more"name='more'>更多共乘資訊</button>
   </div>
    <div class="indexWrap" >
        
      	<ul class="list-group" >
    	<?php while ($row =mysqli_fetch_array($data["result"])) : ?>
    	    
    		<li style=" width:450px;height:90px;" class="list-group-item">
    			<a href="carpool_mycarpool?id=<?php echo $row["ID"] ?>"> 
    			
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
