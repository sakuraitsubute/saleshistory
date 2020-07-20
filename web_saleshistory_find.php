<!DOCTYPE html>
  <head>
  <meta charset="utf-8">
  <meta name="Content-Style-Type" content="text/css">
  <title>売上履歴検索</title>
  <meta name="viewport" content="width=device-width">
  <!-- JQueryとJQueryUIのCDN -->
  <script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>
  <script
  src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"
  integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU="
  crossorigin="anonymous"></script>

 <!-- このページのjs -->
  <script src="js/web_saleshistory_find.js?1121"></script>
   <!-- paginateのjs -->
  <!--<script src="js/PaginateMyTable.js"></script>-->
   <!-- tablesorterのjs -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.3/js/jquery.tablesorter.min.js"></script>
  
  <!-- tablesorterのcss -->
  <link rel="stylesheet" href="css/tablesorter/theme.green.css?1631">
   <!-- paginateのcss -->
  <link rel="stylesheet" href="css/PaginateMyTable.css">
   <!-- JQueryUIのcss -->
<link rel="stylesheet" href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <!-- このページのCSS -->
 <link rel="stylesheet" href="css/web_saleshistory_find_php.css?1136"> 
</head>


<body>
<?php
session_start();
if(!$_SESSION['userid']){
  echo '<h1>ログインしてください</h1>';
  echo '<p><button type="button" class="close">閉じる</button></p>';
  die();
}else{

 //ini_set('display_errors',1);

//タイムゾーンを日本に設定
date_default_timezone_set('Asia/Tokyo');
//FileMakerのクラスを使えるようにする
require_once('FileMaker.php');


$userid = 'web';
$password = 'tEL6728061';

//データベース名・ホスト・アカウントを定義
$fm = new FileMaker();
$fm->setProperty('database', 'オフコンデータ');
$fm->setProperty('hostspec', 'http://192.168.0.73');
$fm->setProperty('username', $userid);
$fm->setProperty('password', $password);

//フォームからもらった値をエスケープ
$find_word = htmlspecialchars($_POST['find_word'], ENT_QUOTES, 'UTF-8');
$title = htmlspecialchars($_POST['title'], ENT_QUOTES, 'UTF-8');
$start = htmlspecialchars($_POST['start_date'], ENT_QUOTES, 'UTF-8');
$end = htmlspecialchars($_POST['end_date'], ENT_QUOTES, 'UTF-8');


//値が数字か文字列かで場合分けして、データベース内を検索
if(is_numeric($find_word)){
  //入力が数字だった場合
  //タイトルは無視する

  

  $findCommandA = $fm->newfindCommand('売上履歴');
  $findCommandA->addFindCriterion('整理番号_UNSIGN_NUMERIC', $find_word);
  $findCommandA->addSortRule('年月日_UNSIGN_NUMERIC', 1, FILEMAKER_SORT_DESCEND);
  

  $result = $findCommandA->execute();

}else if(empty($find_word) & $title){
  //タイトルだけ入力された場合の処理

  $findCommandB = $fm->newfindCommand('売上履歴');
  $findCommandB->addFindCriterion('タイトル名', $find_word);
  if($start and $end){
    $findCommandB->addFindCriterion('年月日_UNSIGN_NUMERIC', $start.'...'.$end);
  }
 $findCommandB->addSortRule('年月日_UNSIGN_NUMERIC', 1, FILEMAKER_SORT_DESCEND);
  
  $result = $findCommandB->execute();

  

}else if(is_string($find_word) and empty($title)){
  //得意先名もしくはユーザー名、受注番号のみで検索する場合
  //CompoundFindは新規検索条件を追加しての検索
  $orderO = array("AO-", "BO-", "CO-", "DO-", "EO-", "FO-", "GO-", "HO-", "IO-", "JO-", "KO-", "LO-", "MO-", "NO-", "OO-", "PO-", "QO-", "RO-", "SO-", "TO-", "UO-", "VO-", "WO-", "XO-", "YO-", "ZO-");
  $order0 = array("A0-", "B0-", "C0-", "D0-", "E0-", "F0-", "G0-", "H0-", "I0-", "J0-", "K0-", "L0-", "M0-", "N0-", "O0-", "P0-", "Q0-", "R0-", "S0-", "T0-", "U0-", "V0-", "W0-", "X0-", "Y0-", "Z0-");

  $find_word = str_replace($orderO, $order0, $find_word);

  $findrequest = array();
  $findrequest[0] = $fm->newFindRequest('売上履歴');
  $findrequest[0]->addFindCriterion('得意先名', $find_word);
  if($start and $end){
  $findrequest[0]->addFindCriterion('年月日_UNSIGN_NUMERIC', $start.'...'.$end);
  }

  $findrequest[1] = $fm->newFindRequest('売上履歴');
  $findrequest[1]->addFindCriterion('受注番号_CHAR', $find_word);
  

  $compoundFind = $fm->newCompoundFindCommand('売上履歴');
  $compoundFind->add(1, $findrequest[0]);
  $compoundFind->add(2, $findrequest[1]);
 
  $compoundFind->addSortRule('年月日_UNSIGN_NUMERIC', 1, FILEMAKER_SORT_DESCEND);
  
  $result = $compoundFind->execute();
}else if(is_string($find_word) and !empty($title)){
  //得意先名もしくはユーザー名とタイトルが入力された場合
  //addFindCriterionは同一検索条件内での検索項目追加

  
  $findcommand = $fm->newFindCommand('売上履歴');
  $findcommand->addFindCriterion('得意先名', $find_word);
  $findcommand->addFindCriterion('タイトル名', $title);
  if($start and $end){
    $findcommand->addFindCriterion('年月日_UNSIGN_NUMERIC', $start.'...'.$end);
  }
  $findcommand->addSortRule('年月日_UNSIGN_NUMERIC', 1, FILEMAKER_SORT_DESCEND);
  $result = $findcommand->execute();

}


if(FileMaker::isError($result)){
  //エラー処理
  echo '<div class="error">FileMaker Error Code:'. $result->getCode();
  echo '<p>'. $result->getMessage(). '</p>';
  echo '<a href="web_saleshistory_find_form.php">検索画面へ</a></div>';
}else{
  //正常処理
  $records = $result->getRecords();
  
  ?>
 

 <h1>検索結果</h1>
  <table border="1" id="mytable" class="tablesorter-green">
  <thead>
    <tr>
    <th>詳細</th>
    <th>年月日</th>
    <th>整理番号</th>
    <th>受注番号</th>
    <th>得意先名</th>
    <th>タイトル名</th>
    </tr>
    </thead>
    <tbody>
  <?php
  
  //getFieldでフィールド内容を取得
    foreach($records as $record){
      echo '<tr><input type="hidden" name="recordid" class="recordid" value="'.$record->getField('レコードID').'">';
      echo '<td><button type="button" class="detail_button">詳細へ</button></td>';
      echo '<td>'. date('Y/m/d', strtotime($record->getField('年月日_UNSIGN_NUMERIC'))). '</td>';
      echo '<td>'.$record->getField('整理番号_UNSIGN_NUMERIC').'</td>';
      echo '<td>'.$record->getField('受注番号_CHAR').'</td>';
      echo '<td>'.$record->getField('得意先名').'</td>';
      echo '<td>'.$record->getField('タイトル名').'</td>';
      echo '</tr>';
    }
    $para['range'] = $para['range']+10;
    ?>
    </tbody>
  </table>
  <div id="modal" class="modal">
    <div class="modal_content">
      <div class="modal_body">
      <button type="button" id="detail_close">☓</button>
      <h1>売上詳細</h1>
      <table border="1" id="detail_table" class="tablesorter-green">
        <tr>
          <th>年月日</th>
          <td id="date"></td>
        </tr>
        <tr>
        <th>整理番号</th>
          <td id="seiri"></td>
        </tr>
        <tr>
          <th>受注番号</th>
          <td id="order"></td>
        </tr>
          <tr>
          <th>得意先名</th>
          <td id="tokui"></td>
          </tr>
          <tr>
          <th>外注先</th>
          <td id="gait"></td>
          </tr>
          <tr>
          <th>タイトル名</th>
          <td id="title"></td>
          </tr>
          <tr>
          <th>数量</th>
          <td id="amount"></td>
          </tr>
          <tr>
          <th>単価</th>
          <td id="s_price"></td>
          </tr>
         <tr>
         <th>金額</th>
          <td id="price"></td>
         </tr>
          <tr>
          <th>原価</th>
          <td id="cost"></td>
          </tr>
          <tr>
          <th>差益</th>
          <td id="profit"></td>
          </tr>
          <tr>
          <th>利益率</th>
          <td id="profit_rate"></td>
          </tr>
          
        
      </table>
      </div>
    </div>
  </div>
  <a href="web_saleshistory_find_form.php">検索画面へ</a>
  <?php
}


}
?>
</body>
</html>