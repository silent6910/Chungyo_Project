       $(document).ready(function () {
         $("#modify").click(function(){
            alert("qqq");
         $.ajax(
         {
             type:"POST",
             data: $('#register').serialize(), //把hmtl 裡的form傳出去
             url:"https://job-qwerrtty.c9users.io/project_test2/index/modify_data_update",
             dataType:"text",
             
             error: function()
             {
                alert("連線失敗");
                
             },
            success: function(json) 
            {
                alert(json);
                if(json.match("no"))
                {
                    alert("請輸入密碼");
                }
                else
                {
                    alert("修改成功"); 
                    location.href="https://job-qwerrtty.c9users.io/project_test2/index";
                }
             }
         });
        
         });
       });