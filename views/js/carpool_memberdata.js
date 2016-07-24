       $(document).ready(function () {
           var Password=false;
           var Password2=false;
           var email=false;
         function verifyemail()
         {
           $("#e-mail").on("blur",function(){
             if($("#e-mail").prop("value")=='')
             {
                 $("#e-mail_label").text("不得為空")
                 email=false;
             }
                 else
             {
                $("#e-mail_label").text("")
                email=true;
             }
           });
         }
        
         function verifyPassword()
         {
             $("#Password2").on("blur",function(){
                 
             if($("#Password2").prop("value")=='')
             {
                $("#Password2_label").text("不得為空")
                Password=false;
                 
             }
             else   if(($("#Password2").val().length)<6)
             {
                  $("#Password2_label").text("密碼字數不得小於6");
                  Password=false;
             }
             else
             {
                $("#Password_label").text("");
                Password=true;
             }
             });
         }
         function verifyPassword_check()
         {
             $("#Password2_check").on("blur",function(){
                 if($("#Password2").prop("value")!=$("#Password2_check").prop("value"))
             {
                $("#Password2_check_label").text("密碼不一，請重新輸入");
                Password2=false;
             }
             else
             {
                $("#Password2_label").text("");
                Password2=true;
             }
             });
             
         }
         verifyPassword();
         verifyPassword_check()
         verifyemail();
         $("#registerbutton").click(function(){
             if(  Password && Password2 && email)
         $.ajax(
         {
             type:"POST",
             data: $('#register').serialize(), //把hmtl 裡的form傳出去
             url:"php/carpool_register",
             dataType:"text",
             
             error: function()
             {
                alert("連線失敗");
                
             },
            success: function(json) 
            {
                var obj=JSON.parse(json);
                if(obj==false)
                {
                    alert("註冊成功")
                    location.href="carpool_index";
                }
                else
                    alert("帳號已有人註冊");
             }
         });
         else 
            alert("請輸入完整");
         });
       });