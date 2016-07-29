  $(document).ready(function () {
           var Account=false;
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
           })
         }
         function verifyAccount(){
             
             $("#Account").on("blur",function(){
                 
             if($("#Account").prop("value")=='')
             {
                $("#Account_label").text("不得為空")
               Account=false; }
             else   if(($("#Account").val().length)<6)
             {
                  $("#Account_label").text("帳號字數不得小於6");
                 Account=false;
             }
             else
             {
                $("#Account_label").text("")
                Account=true;
             }
             })
         }
         function verifyPassword()
         {
             $("#Password").on("blur",function(){
                 
             if($("#Password").prop("value")=='')
             {
                $("#Password_label").text("不得為空")
                Password=false;
                 
             }
             else   if(($("#Password").val().length)<6)
             {
                  $("#Password_label").text("密碼字數不得小於6");
                  Password=false;
             }
             else
             {
                $("#Password_label").text("");
                Password=true;
             }
             })
         }
         function verifyPassword2(){
             $("#Password2").on("blur",function(){
             if($("#Password2").prop("value")!=$("#Password").prop("value"))
             {
                $("#Password2_label").text("密碼不一，請重新輸入");
                Password2=false;
             }
             else
             {
                $("#Password2_label").text("");
                Password2=true;
             }
             });
         }
         verifyAccount();       //########這四個FUNCTION做帳號初步驗證
         verifyPassword();
         verifyPassword2();
         verifyemail();
         $("#registerbutton").click(function(){
             if(Account && Password && Password2 && email)
         $.ajax(
         {
             type:"POST",
             data: $('#register').serialize(), //把hmtl 裡的form傳出去
             url:"register/register",
             dataType:"text",
             
            error: function()
            {
                alert("註冊成功");
                location.href="index";
                
            },
            success: function(json) 
            {
               
                var obj=JSON.parse(json);
                if(obj==true)
                {
                    alert("註冊成功");
                    location.href="index";
                }
                else if(obj=='no')
                    alert("帳號只能是英文與數字");
                else
                    alert("帳號已有人註冊");
             }
         });
         else 
            alert("請輸入完整");
         });
       });