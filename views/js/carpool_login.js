    $(document).ready(function () 
    {
        $("#login").click(function(){
            $.ajax(
            {
                type: 'POST',
                data: $("#login_form").serialize(),
                url: 'login/login',
                dataType:"text",
          error: function(xhr) 
          {
            alert('Ajax request 發生錯誤');
          },
            success: function(json) 
            {
                var obj=JSON.parse(json);
                if(obj==true)
            { 
                alert('登入成功');
                window.location.replace("index");
            }
                else
                    alert("登入失敗");
            }
            });
        });
    });