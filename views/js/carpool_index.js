     
     $(document).ready(function () {
        $("#more").click(function() {
             location.href="index/allcarpool";
        })
     $("#search_button").click(function() {
         
         location.href="index/search?pointB="+
         $("#search_text").val();
     })
       
     $("#login").click(function(){
         if( $("#login").text()=='登出')
         {
            $.ajax({
                url:"index/unsetsesson",
                error: function()
                {
                    alert("連線失敗");
                },
                success: function(json) 
                {
                    (json.match("true"))?alert("登出成功"):alert("未知錯誤");
                    location.href="index";
                    
                }
            }); 
         }
         else if ( $("#login").text()=='登入')
         {
            location.href="login";
         }
 })
});
    