<script type="text/javascript" >
    function foo()
    {
        foo.abc=function()
        {
            alert("@@@@");
        }
        this.abc=function()
        {
            alert("123");
        }
        abc=function()
        {
            alert("456");
        }
        var abc=function()
        {
            alert("789");
        }
    }
    foo.abc=function()
    {
        alert("ccccccccc");
    }
    abc=function()
    {
        alert("aaaaaaaa");
    }
    f=new foo();
    foo.abc();
    f.abc();
    abc();
    
    //這題會印出 「@@@@」、「123」、「aaaaaaaaaaa」
</script>