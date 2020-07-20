  <?php
  $para = $_GET['para'];

  if(empty($para['seiri']) and empty($para['order']) and empty($para['tokui']) and empty($para['title']) and empty($para['start']) and empty($para['end'])){
    echo '<h1>売上履歴検索</h1>';
    //var_dump($_GET['para']);
    
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



$findCommand = $fm->newFindCommand('売上履歴');
$findCommand->addFindCriterion('整理番号_UNSIGN_NUMERIC', $para['seiri']);
$findCommand->addFindCriterion('受注番号_CHAR', $para['order']);
$findCommand->addFindCriterion('得意先名', $para['tokui']);
$findCommand->addFindCriterion('タイトル名', $para['title']);

if($para['start'] && $para['end']){
  $findCommand->addFindCriterion('年月日_UNSIGN_NUMERIC', $para['start'].'...'.$para['end']);
}

$findCommand->addSortRule('年月日_UNSIGN_NUMERIC', 1, FILEMAKER_SORT_DESCEND);
//$findCommand->setRange($para['range'], $para['range']+10);
$result = $findCommand->execute();

if(FileMaker::isError($result)){
  echo '<h1>検索条件にヒットする結果がありません</h1>';
  echo $result->getCode();
  echo $result->getMessage().'<br>';
  var_dump($_GET['para']);
}else{
  //正常処理
  $count = $result->getFetchCount();
  $records = $result->getRecords();
  //echo '$number='.$number.'<br>';
  ?>

<!DOCTYPE html>
  <head>
  <meta charset="utf-8">
  <meta name="Content-Style-Type" content="text/css">
  <title>売上履歴</title>
  <meta name="viewport" content="width=device-width">
  <!-- JQueryとJQueryUIのCDN -->
  <script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>
  <script src="js/saleshistory_find.js?1445"></script>
</head>
<body>
<input type="hidden" id="page" value="<?= $para['range']?>">
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
  <!--<a href="#" id="next">次へ</a> -->
    <?php
    //echo $para['range'];
   // echo '<a href="http://153.142.59.177/develop_box/saleshistory_find.php?para[seiri]='.$para['seiri'].'&para[order]='.$para['order'].'&para[tokui]='.$para['tokui'].'&para[title]='.$para['title'].'&para[start]='.$para['start'].'para[end]='.$para['end'].'&para[range]='.$para['range'].'">次へ</a>';
  }
}
?>
</body>
</html>
