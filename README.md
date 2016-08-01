# PHP_Project
<<<<<<< HEAD

資策會「PHP職前教育訓練」專題


//////////////

這是在資策會一個月以來所完成的作品，是一個提供使用者刊登或加入共乘的網站

使用者可以註冊帳號，登入完帳號後，可使用網站的內功能，以下有介紹，然後預設使用者只能同時刊登或者加入三次共乘

/////////////

本作品部分參照某些網站的版面配置，因為本人不太擅長美工，如果版面因為縮放而亂掉，敬請見諒

雖說可以直接使用Free Bootstrap Themes & Templates,但我覺得版面自己刻會學到比較多的東西,對於前端也會更加了解

//////////////

此作品使用MVC架構，使用者遞交request給Controller，

Controller把model require進來，然後整理完資料後，把資料包進view裡，respond回使用者。

亦有做路由的功能

//////////////////////////////////////

2016/08/01

完成優化資料庫部分

////////////////////////////////////////

2016/07/30

未來將加入「多重條件搜尋」、「VIP系統」、「願望清單(指定條件，當如果有人刊登符合條件的共乘活動時，則自動通知該使用者)」

「及時訊息通知(類似FB的『您有新訊息』時會出現！)」、「大頭貼裁切」、「刊登可選擇不同樣式」、「使用Goole Map API」

預計優化資料庫使用者擁有的共乘ID的儲存方式，將三個欄位合併成一個儲存使用者現在擁有的共乘活動數量

預設為0，若為3則表示已經額滿，並新建一個專門存放該次共乘ID與使用者AC的Table




/////////////////////////////////////////

2016/07/27
將網站原先使用的mysqli全面改成PDO

本來還想再C9上新建一個專案，將本專題移植過去的，但遇到許多路徑問題，暫時無法完成

////////////////////////////////////////

////////////////////////////////////////

2016/07/15

已經專題全部已更改成MVC架構(使用老師課堂教的那套，require core進來呼叫APP()的那套)，VIEW的request除了共乘詳細資訊用GET的方式以外，其餘使用jquery的$.ajas的POST方式

PHP部分已大部分都做註解，JS部分註解

若有不足的地方，請通知我:mailforjob6910@gmail.com










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



點選任一筆共乘資訊顯示共乘細目，使用jquery的ajax方式將資料load，會有一瞬間會看到只有html與CSS的框架，此為乘客找司機的共乘活動，僅限一位司機，若司機已加入此次共乘，則其他人無法再加入

![image](https://github.com/silent6910/Chungyo_Project/raw/master/images/mycarpool_driver.png)


點選任一筆共乘資訊顯示共乘細目，使用jquery的ajax方式將資料load，會有一瞬間會看到只有html與CSS的框架，此為司機提供座位的共乘活動，當提供的空位已額滿時，將鎖定加入按鈕，並不讓乘客加入

![image](https://github.com/silent6910/Chungyo_Project/raw/master/images/publish.png)


點選「刊登」，出現刊登頁面，可選擇「提供座位」、「找車搭」，，使用jquery的$.ajax與將資料上傳至pubilshController的publish function，

依據回傳值判斷是否刊登成功

///////////////////////////////////////////////////////

以下為資料庫截圖

//////////////////////////////////////////////////////

![image](https://github.com/silent6910/Chungyo_Project/raw/master/images/Carpool_data.png)


這是共乘資訊的部分，依table順序分別是該共乘的主揪、ID(primary key)、出發地、目的地、日期、時間

提供幾個座位(需要幾個座位)、價錢(若乘客找司機則無)、類型（司機找乘客或乘客找司機）、判斷是否已經有司機提供給乘客座位

![image](https://github.com/silent6910/Chungyo_Project/raw/master/images/Carpool_plus.png)


這是共乘額外資訊的部分，依table順序分別是該共乘的ID(primary key)、是否禁止飲食、是否禁止攜帶寵物

是否禁止攜帶大型行李、是否禁止吸煙喝酒嚼檳榔、備註

![image](https://github.com/silent6910/Chungyo_Project/raw/master/images/User_AC_PW.png)

這是使用者帳戶與密碼的部分，依table順序分別是帳號、密碼、儲存該使用者現在所擁有的共乘活動數量

![image](https://github.com/silent6910/Chungyo_Project/raw/master/images/User_data.png)

這是使用者帳戶與其額外資訊，依table順序分別是帳號、性別、暱稱、e-mail、大頭照

![image](https://github.com/silent6910/Chungyo_Project/raw/master/images/Carpool_ID_AC.png)

這是優化過的資料庫系統，解決之前擴充性極差的問題，直接create 一個table，用來存每個使用者的每個共乘ID





=======
新秀聯盟project
>>>>>>> 95aa1c1283b8c3e558a103a3c9eeebe53765aa95
