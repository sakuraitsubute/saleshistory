<DOCTYPE html>
  <html>
  <head>
    <meta charset="utf-8">
    <meta name="Content-Style-Type" content="text/css">
    <title>営業コード別・当月売上リスト</title>
    <script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>
 <!-- <script src="js/PaginateMyTable.js"></script> -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.3/js/jquery.tablesorter.min.js"></script>
  <!--<script src="js/WM_web_inventory_find.js?1023"></script>
  <meta name="viewport" content="width=device-width">
  <link rel="stylesheet" href="css/WM_web_inventory_find.css?0830">
  <link rel="stylesheet" href="css/tablesorter/theme.green.css">
  
  <link rel="stylesheet" href="css/PaginateMyTable.css"> -->
  
 

  </head>
  <body>

  <?php
 ini_set('display_errors',1);

session_start();
if(!$_SESSION['userid']){
  echo '<h1>ログインしてください</h1>';
  echo' <p><button type="button" id="close">閉じる</button></p>';
}else{
//タイムゾーンを日本に設定
date_default_timezone_set('Asia/Tokyo');
//FileMakerのクラスを使えるようにする
require_once('FileMaker.php');


$userid = $_SESSION['userid'];
$password = $_SESSION['password'];

//データベース名・ホスト・アカウントを定義
$fm = new FileMaker();
$fm->setProperty('database', 'オフコンデータ');
$fm->setProperty('hostspec', 'http://192.168.0.73');
$fm->setProperty('username', 'web');
$fm->setProperty('password', 'tEL6728061');

//直近一週間で棚卸しをした記録があるかどうか調べる

$find01to31 = $fm->newFindcommand('売上履歴');
$find01to31->addFindCriterion('年月日_UNSIGN_NUMERIC', date("Ym01", time()).'...'.date("Ymt", time()));
$find01to31->addSortRule('受注番号_CHAR', 1, FILEMAKER_SORT_ASCEND);
$result = $find01to31->execute();

if(FileMaker::isError($result)){
  echo 'FileMaker Error:'.$result->getCode().'<br>';
  echo $result->getMessage();
  echo '<h1>当月の売上データがありません</h1>';
  echo' <p><button type="button" id="close">閉じる</button></p>';
}else{
  $records = $result->getRecords();

  $A0 = array();
  $B0 = array();
  $C0 = array();
  $D0 = array();
  $E0 = array();
  $F0 = array();
  $G0 = array();
  $H0 = array();
  $I0 = array();
  $J0 = array();
  $K0 = array();
  $L0 = array();
  $M0 = array();
  $N0 = array();
  $O0 = array();
  $P0 = array();
  $Q0 = array();
  $R0 = array();
  $S0 = array();
  $T0 = array();
  $U0 = array();
  $V0 = array();
  $W0 = array();
  $X0 = array();
  $Y0 = array();
  $Z0 = array();
  
  foreach($records as $record){
    $order = $record->getFIeld('受注番号_CHAR');
    switch(substr($order,0,2)){
      case 'A0':
        $A0[] = $record;
      break;

      case 'B0':
        $B0[] = $record;
      break;

      case 'C0':
        $C0[] = $record;
      break;

      case 'D0':
        $D0[] = $record;
      break;

      case 'E0':
        $E0[] = $record;
      break;

      case 'F0':
        $F0[] = $record;
      break;

      case 'G0':
        $G0[] = $record;
      break;

      case 'H0':
        $H0[] = $record;
      break;

      case 'I0':
        $I0[] = $record;
      break;

      case 'J0':
        $J0[] = $record;
      break;

      case 'K0':
        $K0[] = $record;
      break;

      case 'L0':
        $L0[] = $record;
      break;

      case 'M0':
        $M0[] = $record;
      break;

      case 'N0':
        $N0[] = $record;
      break;

      case 'O0':
        $O0[] = $record;
      break;

      case 'P0':
        $P0[] = $record;
      break;

      case 'Q0':
        $Q0[] = $record;
      break;

      case 'R0':
        $R0[] = $record;
      break;

      case 'S0':
        $S0[] = $record;
      break;

      case 'T0':
        $T0[] = $record;
      break;

      case 'U0':
        $U0[]= $record;
      break;

      case 'V0':
        $V0[] = $record;
      break;

      case 'W0':
        $W0[] = $record;
      break;

      case 'X0':
        $X0[] = $record;
      break;

      case 'Y0':
        $Y0[] = $record;
      break;

      case 'Z0':
        $Z0[] = $record;
      break;
    }
  }
  

?>

<h1>営業コード別・当月売上リスト</h1>
<table border = "1" class="tablesorter-green">
<thead>
<tr>
<th>担当者</th>
<th>売上実績</th>
<th>仕入</th>
<th>利益</th>
<th>利益率</th>
</tr>
</thead>
<tbody>
<td>Z0</td>
<td><?php foreach($Z0 as $data){$price_Z = $data->getField('金額_DICIMAL'); $price_total_Z +=$price_Z; var_dump($price_Z);} echo $price_total_Z; unset($data) ?></td>
<td><?php foreach($Z0 as $data){$cost_Z = $data->getField('原価_DICIMAL'); $cost_total_Z += $cost_Z;} echo $cost_total_Z; unset($data) ?></td>
<td><?php $price_total_Z - $cost_total_Z ?></td>
<td><?php ($cost_total_Z / $price_total_Z) * 100 ?></td>
</tbody>
</table>

<p class="select">
<select name="order" id="order_select">
<option value="">営業コードで絞り込み</option>
<option value="A0">A0</option>
<option value="B0">B0</option>
<option value="D0">D0</option>
<option value="F0">F0</option>
<option value="G0">G0</option>
<option value="H0">H0</option>
<option value="I0">I0</option>
<option value="K0">K0</option>
<option value="N0">N0</option>
<option value="P0">P0</option>
<option value="Q0">Q0</option>
<option value="R0">R0</option>
<option value="T0">T0</option>
<option value="V0">V0</option>
<option value="W0">W0</option>
<option value="Z0">Z0</option>
</select>
<!--
<input type="text" id="tokui_find" placeholder="得意先で絞り込み">
<input type="text" id="user_find" placeholder="ユーザーで絞り込み">
<input type="text" id="title_find" placeholder="タイトルで絞り込み">
<button type="button" id="find_button">検索</button>
-->
</p>


<div id="inventory_table">

  <table border="1" id="mytable" class="tablesorter-green">
    <thead>
    <tr>
    <th>詳細</th>
      <th>年月日</th>
      <th>整理番号</th>
      <th>受注番号</th>
      <th>得意先名</th>
      <th>タイトル名</th>
      <th>数量</th>
      <th>伝票番号</th>
     </tr>
     </thead>


    <tbody>
    <?php
    /*
      foreach($records as $record){
        echo '<tr data-href="WM_web_inventory_revision_form.php?id='.$record->getField('c_レコードID').'"><input type="hidden" name="recordid" class="recordid" value="'.$record->getField('c_レコードID').'">';
        echo '<td>'. date('Y/m/d', strtotime($record->getField('棚卸し日付'))). '</td>';
        echo '<td>'. $record->getField('整理番号'). '</td>';
        echo '<td>'. $record->getField('受注番号'). '</td>';
        echo '<td>'. $record->getField('棚卸し_dbo.findview::得意先名');
        echo '<td>'. $record->getField('棚卸し_dbo.findview::ユーザー名');
        echo '<td>'. $record->getField('棚卸し_dbo.findview::タイトル名');
        echo '<td>'. $record->getField('入数');
        echo '<td>'. $record->getField('棚番');
        echo '<td>'. $record->getField('ケース数');
        echo '<td>'. $record->getField('c_棚卸し在庫数比較');
        echo '<td class="button"><button type="button" class="delete_button">削除</button>';
        echo '</tr>';
          }
          */
    ?>
    </tbody>
  </table>
 
</div>

<p>
    <button type="button" id="close">閉じる</button>
</p>
<?php
  }
}

?>

</body>
</html>