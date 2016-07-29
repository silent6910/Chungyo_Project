# Chungyo_Project
<<<<<<< HEAD

新秀聯盟專題


最終目標--將本專題與大學專題做結合，做APP與網站整合


2016/07/29
將該作品重新修改、包裝，預計在禮拜日前完成


2016/07/27
將網站原先使用的mysqli全面改成PDO

本來還想再C9上新建一個專案，將本專題移植過去的，但遇到許多路徑問題，暫時無法完成

////////////////////////////////////////

////////////////////////////////////////


已經專題全部已更改成MVC架構(使用老師課堂教的那套，require core進來呼叫APP()的那套)，VIEW的request除了共乘詳細資訊用GET的方式以外，其餘使用jquery的$.ajas的POST方式

PHP部分已大部分都做註解，JS部分(views)部分，則無，若有任何關於前端部分的疑問，請通知我

若有不足的地方，請通知我，我會在發表前盡快修改。








注意：本project僅用來呈現於「中佑--新秀聯盟專題」中，如將本project恣意使用，請自行負責任





![image](https://github.com/silent6910/Chungyo_Project/raw/master/images/index.png)


首頁，上方可以註冊、登入(登出)、刊登(會員登入限定)、查看會員資料

中部分能鍵入文字搜尋所有共乘活動

下部分可以看到近五筆共乘活動、可點選查看所有共乘資訊


![image](https://github.com/silent6910/Chungyo_Project/raw/master/images/register.png)


註冊功能、使用jquery做ajax，在client端先進行初步驗證，最終在上傳至server

並將會顯示於網頁的用戶資訊做htmlentities，避免產生XSS等問題




![image](https://github.com/silent6910/Chungyo_Project/raw/master/images/allcarpool.png)


查看更多共乘資訊



![image](https://github.com/silent6910/Chungyo_Project/raw/master/images/search.png)


鍵入文字搜尋結果

![image](https://github.com/silent6910/Chungyo_Project/raw/master/images/member_carpool.png)

該使用者的共乘資訊


![image](https://github.com/silent6910/Chungyo_Project/raw/master/images/mycarpool_passeng.png)



點選任一筆共乘資訊顯示共乘細目，此為乘客找司機的共乘活動，僅限一位司機，若司機已加入此次共乘，則其他人無法再加入

![image](https://github.com/silent6910/Chungyo_Project/raw/master/images/mycarpool_driver.png)


點選任一筆共乘資訊顯示共乘細目，此為司機提供座位的共乘活動，當提供的空位已額滿時，將鎖定加入按鈕，並不讓乘客加入

![image](https://github.com/silent6910/Chungyo_Project/raw/master/images/publish.png)


點選「刊登」，出現刊登頁面，可選擇「提供座位」、「找車搭」，，使用jquery的$.ajax與將資料上傳至pubilshController的publish function，

依據回傳值判斷是否刊登成功











=======
新秀聯盟project
>>>>>>> 95aa1c1283b8c3e558a103a3c9eeebe53765aa95
