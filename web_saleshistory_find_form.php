<DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="Content-Style-Type" content="text/css">
  <title>売上履歴検索</title>
  <meta name="viewport" content="width=device-width">
  <link rel="stylesheet" href="css/web_saleshistory_find_form.css">
  <script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>
 <script src="js/saleshistory_find_form.js"></script> 
</head>


<body>
  <?php
session_start();
if(!$_SESSION['userid']){
  echo '<h1>ログインしてください</h1>';
  echo '<p><button type="button" id="close">閉じる</button></p>';
  die();
}else{
?>


  <!--<img src="img_box/logo.png" alt="会社のロゴ">-->
  <h1>売上履歴検索</h1>
    <hr>
    <form action="web_saleshistory_find.php" method="POST">
      <div align="center">
      <label for="find_word">整理番号/受注番号<br>得意先名<br>のいずれかを入力</label>
     <p> <input type="text" name="find_word" class="text"></p>
     <label for="title">タイトル名を入力</label>
     <p><input type="text" name="title" class="text"></p>
     <p>
     年月日
     <input type="tel" name="start_date" class="text">
     〜
     <input type="tel" name="end_date" class="text">
     <p>記入例：20200620〜20200630</p>
     
     </p>
      <input type="submit" name="submit" value="検索"  class="submit_button">
      
    </div>
    
    <!---
    <div>
      <label for="member_name">名前</label>
      <input type="text" name="member_name">
      <input type="submit" value="送信">
    </div>
  --->
    </form>
    <p><button type="button" id="close">閉じる</button></p>
 <?php
}
?>
</body>
</html>