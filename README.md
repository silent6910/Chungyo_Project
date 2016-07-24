# Chungyo_Project

新秀聯盟專題




注意：本project僅用來呈現於「中佑--新秀聯盟專題」中，如將本project恣意使用，請自行負責任





![image](https://github.com/silent6910/Chungyo_Project/raw/master/image/0713.png)


首頁，上方可以註冊、登入(登出)、刊登(會員登入限定)、查看會員資料

中部分能鍵入文字搜尋所有共乘活動

下部分可以看到近五筆共乘活動、可點選查看所有共乘資訊


![image](https://github.com/silent6910/Chungyo_Project/raw/master/image/0713register.png)


註冊功能、使用jquery做ajax，在client端先進行初步驗證，最終在上傳至server




![image](https://github.com/silent6910/Chungyo_Project/raw/master/image/0713 all.png)


查看更多共乘資訊



![image](https://github.com/silent6910/Chungyo_Project/raw/master/image/0713serch.png)


鍵入文字搜尋結果




![image](https://github.com/silent6910/Chungyo_Project/raw/master/image/0713detail.png)



點選任一筆共乘資訊顯示共乘細目，副檔名HTML，使用jquery的$.ajax與server進行溝通，網頁先讀一次html與CSS，

再讀javascript內容



![image](https://github.com/silent6910/Chungyo_Project/raw/master/image/0713publish.png)




點選「刊登」，出現刊登頁面，可選擇「提供座位」、「找車搭」，副檔名HTML，使用jquery的$.ajax與server進行溝通

依據回傳值判斷是否刊登成功










2016/07/12 今天新增太多東西了，這版就當是ver.1 之後在寫上新增、修改項目

2016/07/13

預計修改carpool_publish.html、carpool_publish.php檔，讓其他使用者也可以加入共乘

新增搜尋功能，功能寫在carpool_serch.php

以上如期完成的話，會在進一步去完成部分功能

2016/07/13
完成「更多共乘資訊」、「搜尋」、完成「其他人可以加入共乘活動」、完成使用者刊登可另選擇「找車搭」功能

修正登入驗證問題、修正註冊驗證問題


預計2016/07/14

預計完成偵錯功能、並且開始重構還有模擬專題發表


2016/07/14

完成刊登另一選擇--「找車搭」功能！！、新增以cookie功能將登入的會員印在首頁上的歡迎功能(如果沒有登入則顯示遊客)


修正刊登寫入資料庫的時間與日期異常、重構程式，將所有用到資料庫的部分刪除、並新增成一個php檔，

裡頭寫class，建構式包括寫好連線部分，以及設定語言為uft8，並且還有重構carpool_mycarpool_join.php 有效改善對資料庫使用效率




預計2016/07/15

預計完成退出「共乘活動」之功能、新增會員修改資料功能、會員可以上傳大頭貼之功能

部分重構程式




