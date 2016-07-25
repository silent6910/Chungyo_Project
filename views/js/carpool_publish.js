   $(document).ready(function () {
        $.ajax({
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
                {
                    location.href="login";
                }
                else
                    $("#Account").val(json);
            }
        }); 
        $("#datepicker").on("change",function() {
        $("#date_none").prop("value",$("#datepicker").prop("value"));
        });
        $("#type").prop("value","driver");
        $("#publish_button").click(function() {
        if(isNaN($("#price").prop("value")))
            alert("價位需為數字");
        else if($("#price").prop("value")==''|| $("#pointA").val()==""  ||$("#pointB").val()=="" )
            alert("請輸入完整資料");
        else
            $.ajax({
                type:"POST",
                data: $('#publish_form').serialize(),
                url:"publish/publish",
                datatpye:'text',
                async: false,
                error:function(){
                    alert("連線發生錯誤");
                },
                success:function(json)
                {
                        
                    var obj=JSON.parse(json)
                    if(obj==true)
                    {
                        alert("刊登成功!!")
                        location.href="index";
                    }
                    else if(obj==false)
                        alert("刊登失敗，您目前已有三個共乘活動")
                    }
                });
            });
        $("input[name='radios']").click(function() {
             if($("input[name='radios']:checked").val()=='false')
            {
               $("#price").prop("disabled",true).css("background-color","black");
               $("#seat").text("需要座位數");
               $("#type").prop("value","passenger");
               $("#price").prop("value"," ");
            }
           else
            {
               $("#price").prop("disabled",false).css("background-color","white");;
               $("#seat").text("提供座位數");
               $("#type").prop("value","driver");
            }
        });    
        $("#lack").on("change",function(){
            if($("#lack").prop("value")<1)
                $("#lack").prop("value",1);
            else if($("#lack").prop("value")>10)
                $("#lack").prop("value",10);
            else if(isNaN($("#lack").prop("value")))
                $("#lack").prop("value",1);
        });
        
        $("#lack_reduce").click(function()
        {
            if($("#lack").val()>1)
            {
                $("#lack").prop("value",$("#lack").prop("value")-1);
            }
            
        });
        $("#lack_plus").click(function()
            {   if( $("#lack").prop("value")<10)
                    $("#lack").prop("value",parseInt($("#lack").prop("value"))+1);
            });
        function check(sting)              //checkbox的值存下來 用ajax的方式{
        {
            $(sting).click(function(){
            if($(sting).prop("checked"))
                $(sting).prop("value","1");
            else 
                $(sting).prop("value","0");
            })
            }
         
        check("#food");
        check("#pet");
        check("#baggage");
        check("#smoke");
        var opt={
        dayNames:["星期日","星期一","星期二","星期三","星期四","星期五","星期六"],
        dayNamesMin:["日","一","二","三","四","五","六"],
        monthNames:["一月","二月","三月","四月","五月","六月","七月","八月","九月","十月","十一月","十二月"],
        monthNamesShort:["一月","二月","三月","四月","五月","六月","七月","八月","九月","十月","十一月","十二月"],
        prevText:"上月",
        nextText:"次月",
        weekHeader:"週",
        showMonthAfterYear:true,
        dateFormat:"yy-mm-dd",
        minDate:new Date()
        };
        $("#datepicker").datepicker(opt);
        var Today=new Date();
        var month,temp,date;
        if(Today.getMonth()+1<10)
        {
            temp=Today.getMonth()+1;
            temp=String(temp);
            month="0"+temp;
        }
        else
            month=Today.getMonth()+1;
        if(Today.getDate()<10)
        {
            temp=Today.getDate();
            temp=String(temp);
            date="0"+temp;
        }
        else
            date=Today.getDate();
        $( "#datepicker" ).prop("value",Today.getFullYear()+ 
         "-" +(month) + "-" + date);
        $("#date_none").prop("value",$("#datepicker").val());
        $( "#datepicker" ).datepicker("minDate","2016-07-07");
        $("#date_none").prop("value",$("#datepicker").val());
    });