$(document).ready(function () {
    $.ajax //若沒有登入(session)，則無法加入或提供座位
    ({
        url:"checksession",
        async: false,
        error: function()
        {
            alert("連線失敗");
            location.href="index";
        },
        success: function(json) 
        {
            if(json.match("false"))
                $("#decide").prop("disabled",true);
            else
                $("#user").val(json);
        }
    });
    function load_data(obj)  //寫入該次共乘的資料
    {
            $("#main").text("主揪: "+obj.Account);
            $("#photo").html("<img style='width:50px;height:50px;float:left;'src='https://job-qwerrtty.c9users.io/project_test2/models/show_image.php?Account="+obj.Account+"'"+'>');
            $("#location").text("地點: "+obj.pointA+"  到  "+obj.pointB);
            $("#date").text("時間: "+obj.date+" "+obj.time);
            checkbox("#food",obj.food);
            checkbox("#pet",obj.pet);
            checkbox("#baggage",obj.baggage);
            checkbox("#smoke",obj.smoke);
            $("#remark").text(obj.remark);
            $("#remark").attr("disabled",true);
            $("#Account").val(obj.Account);
            if(obj.type=='passenger')
            {
                $("#type").prop("value",obj.type);
                $("#lack").text("需要"+obj.lack+"個空位");
                $("#price").text(" ");
                $("#decide").text("提供座位");
                if(obj.ps_boolean==1 && !obj.member.match( $("#Account").prop("value")))
                    $("#decide").attr("disabled",true);
            }
            else
            {
                $("#lack").text("還有"+obj.lack+"個空位");
                $("#price").text("每位價格: "+obj.price);
            }
            $("#member").text("參與者: "+obj.member)//整段讀取資料
            if($("#member").text().match($("#user").val()))
                $("#decide").text("退出");
            else if(obj.lack<=0)
                $("#decide").attr("disabled",true);
    }
    var url = location.href;
    function checkbox(checkbox,checked)  //設定CHECKBOX的狀態
    {
        if(checked=='1')
            $(checkbox).prop("checked",true);
        else
            $(checkbox).prop("checked",false);
        $(checkbox).attr("disabled",true);
    }
    temp=url.split("?");  //將get到的id拆解出來
    temp_id=temp[1].replace("id=","");
    $("#ID").prop("value",temp_id);
    $.ajax        //拿id去載入資料
    ({
        type: 'GET',
        url: 'carpool_mycarpool/load_data?'+temp[1],
        dataType:"text",
        async: false,
        error: function() {
            alert("出錯");
        },
        success: function(json) 
        {
            var obj = JSON.parse(json);
            load_data(obj);
        }
    });
    $("#decide").click(function(){    // 按鈕為「退出」時的情況
        if($("#decide").text()=='退出')
            $.ajax({
                 data: $('#join_form').serialize(),
                 type: 'POST',
                 url: 'carpool_mycarpool/quit',
                 datatype:"text",
                 error:function()
                 {
                     alert("出現錯誤");
                     window.location.reload();
                 },
                 success:function(json)
                 {
                    if(json.match('quit'))
                    {
                        alert("退出成功");
                        window.location.reload();
                    }
                    else if(json.match('delete'))
                    {
                        alert("刪除成功");
                        window.location.replace("index");
                    }
                    else 
                        alert("出錯嚕");
                    
                 }
            });
        else                    //按鈕為「加入」時的情況
         $.ajax({
            data: $('#join_form').serialize(),
            type: 'POST',
            url: 'carpool_mycarpool/join',
            dataType:"text",
            error: function() {
              alert("出現錯誤");
            },
            success:function(json)
            {
            if(json.match("true"))
            {
                alert("加入成功");
                window.location.reload();
            }
            else if(json.match("false"))
                alert("加入失敗,您目前已有三個共乘活動");
            else if(json.match('cheat'))
            {
                alert("請勿亂來");
                window.location.replace("index");
            }
            else if(json.match("login"))
            {
                alert("請先登入");
                window.location.replace("login");
            }
            else
                alert("出錯嚕");
        }
             });
    });
    $("#home").click(function(){
        location.href="index";
    })
 });