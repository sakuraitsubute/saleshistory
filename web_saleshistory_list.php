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

//当月の各営業コードごとに売上情報を検索して変数に格納

$find01to31_a = $fm->newFindcommand('売上履歴');
$find01to31_a->addFindCriterion('年月日_UNSIGN_NUMERIC', date("Ym01", time()).'...'.date("Ymt", time()));
$find01to31_a->addFindCriterion('受注番号_CHAR', 'A0');
//$find01to31_a->addSortRule('受注番号_CHAR', 1, FILEMAKER_SORT_ASCEND);
$result_a = $find01to31_a->execute();
if(!FileMaker::isError($result_a)){
  $records_a = $result_a->getRecords();
}

$find01to31_b = $fm->newFindcommand('売上履歴');
$find01to31_b->addFindCriterion('年月日_UNSIGN_NUMERIC', date("Ym01", time()).'...'.date("Ymt", time()));
$find01to31_b->addFindCriterion('受注番号_CHAR', 'B0');
//$find01to31_b->addSortRule('受注番号_CHAR', 1, FILEMAKER_SORT_ASCEND);
$result_b = $find01to31_b->execute();
if(!FileMaker::isError($result_b)){
  $records_b = $result_b->getRecords();
}

$find01to31_c = $fm->newFindcommand('売上履歴');
$find01to31_c->addFindCriterion('年月日_UNSIGN_NUMERIC', date("Ym01", time()).'...'.date("Ymt", time()));
$find01to31_c->addFindCriterion('受注番号_CHAR', 'C0');
//$find01to31_c->addSortRule('受注番号_CHAR', 1, FILEMAKER_SORT_ASCEND);
$result_c = $find01to31_c->execute();
if(!FileMaker::isError($result_c)){
  $records_c = $result_c->getRecords();
}

$find01to31_d = $fm->newFindcommand('売上履歴');
$find01to31_d->addFindCriterion('年月日_UNSIGN_NUMERIC', date("Ym01", time()).'...'.date("Ymt", time()));
$find01to31_d->addFindCriterion('受注番号_CHAR', 'D0');
//$find01to31_d->addSortRule('受注番号_CHAR', 1, FILEMAKER_SORT_ASCEND);
$result_d = $find01to31_d->execute();
if(!FileMaker::isError($result_d)){
  $records_d = $result_d->getRecords();
}

$find01to31_e = $fm->newFindcommand('売上履歴');
$find01to31_e->addFindCriterion('年月日_UNSIGN_NUMERIC', date("Ym01", time()).'...'.date("Ymt", time()));
$find01to31_e->addFindCriterion('受注番号_CHAR', 'E0');
//$find01to31_e->addSortRule('受注番号_CHAR', 1, FILEMAKER_SORT_ASCEND);
$result_e = $find01to31_e->execute();
if(!FileMaker::isError($result_e)){
  $records_e = $result_e->getRecords();
}

$find01to31_f = $fm->newFindcommand('売上履歴');
$find01to31_f->addFindCriterion('年月日_UNSIGN_NUMERIC', date("Ym01", time()).'...'.date("Ymt", time()));
$find01to31_f->addFindCriterion('受注番号_CHAR', 'F0');
//$find01to31_f->addSortRule('受注番号_CHAR', 1, FILEMAKER_SORT_ASCEND);
$result_f = $find01to31_f->execute();
if(!FileMaker::isError($result_f)){
  $records_f = $result_f->getRecords();
}

$find01to31_g = $fm->newFindcommand('売上履歴');
$find01to31_g->addFindCriterion('年月日_UNSIGN_NUMERIC', date("Ym01", time()).'...'.date("Ymt", time()));
$find01to31_g->addFindCriterion('受注番号_CHAR', 'G0');
//$find01to31_g->addSortRule('受注番号_CHAR', 1, FILEMAKER_SORT_ASCEND);
$result_g = $find01to31_g->execute();
if(!FileMaker::isError($result_g)){
  $records_g = $result_g->getRecords();
}

$find01to31_h = $fm->newFindcommand('売上履歴');
$find01to31_h->addFindCriterion('年月日_UNSIGN_NUMERIC', date("Ym01", time()).'...'.date("Ymt", time()));
$find01to31_h->addFindCriterion('受注番号_CHAR', 'H0');
//$find01to31_h->addSortRule('受注番号_CHAR', 1, FILEMAKER_SORT_ASCEND);
$result_h = $find01to31_h->execute();
if(!FileMaker::isError($result_h)){
  $records_h = $result_h->getRecords();
}

$find01to31_i = $fm->newFindcommand('売上履歴');
$find01to31_i->addFindCriterion('年月日_UNSIGN_NUMERIC', date("Ym01", time()).'...'.date("Ymt", time()));
$find01to31_i->addFindCriterion('受注番号_CHAR', 'I0');
//$find01to31_i->addSortRule('受注番号_CHAR', 1, FILEMAKER_SORT_ASCEND);
$result_i = $find01to31_i->execute();
if(!FileMaker::isError($result_i)){
  $records_i = $result_i->getRecords();
}

$find01to31_j = $fm->newFindcommand('売上履歴');
$find01to31_j->addFindCriterion('年月日_UNSIGN_NUMERIC', date("Ym01", time()).'...'.date("Ymt", time()));
$find01to31_j->addFindCriterion('受注番号_CHAR', 'J0');
//$find01to31_j->addSortRule('受注番号_CHAR', 1, FILEMAKER_SORT_ASCEND);
$result_j = $find01to31_j->execute();
if(!FileMaker::isError($result_j)){
  $records_j = $result_j->getRecords();
}

$find01to31_k = $fm->newFindcommand('売上履歴');
$find01to31_k->addFindCriterion('年月日_UNSIGN_NUMERIC', date("Ym01", time()).'...'.date("Ymt", time()));
$find01to31_k->addFindCriterion('受注番号_CHAR', 'K0');
//$find01to31_k->addSortRule('受注番号_CHAR', 1, FILEMAKER_SORT_ASCEND);
$result_k = $find01to31_k->execute();
if(!FileMaker::isError($result_k)){
  $records_k = $result_k->getRecords();
}

$find01to31_l = $fm->newFindcommand('売上履歴');
$find01to31_l->addFindCriterion('年月日_UNSIGN_NUMERIC', date("Ym01", time()).'...'.date("Ymt", time()));
$find01to31_l->addFindCriterion('受注番号_CHAR', 'L0');
//$find01to31_l->addSortRule('受注番号_CHAR', 1, FILEMAKER_SORT_ASCEND);
$result_l = $find01to31_l->execute();
if(!FileMaker::isError($result_l)){
  $records_l = $result_l->getRecords();
}

$find01to31_m = $fm->newFindcommand('売上履歴');
$find01to31_m->addFindCriterion('年月日_UNSIGN_NUMERIC', date("Ym01", time()).'...'.date("Ymt", time()));
$find01to31_m->addFindCriterion('受注番号_CHAR', 'M0');
$find01to31_m->addSortRule('受注番号_CHAR', 1, FILEMAKER_SORT_ASCEND);
$result_m = $find01to31_m->execute();
if(!FileMaker::isError($result_m)){
  $records_m = $result_m->getRecords();
}

$find01to31_n = $fm->newFindcommand('売上履歴');
$find01to31_n->addFindCriterion('年月日_UNSIGN_NUMERIC', date("Ym01", time()).'...'.date("Ymt", time()));
$find01to31_n->addFindCriterion('受注番号_CHAR', 'N0');
//$find01to31_n->addSortRule('受注番号_CHAR', 1, FILEMAKER_SORT_ASCEND);
$result_n = $find01to31_n->execute();
if(!FileMaker::isError($result_n)){
  $records_n = $result_n->getRecords();
}

$find01to31_o = $fm->newFindcommand('売上履歴');
$find01to31_o->addFindCriterion('年月日_UNSIGN_NUMERIC', date("Ym01", time()).'...'.date("Ymt", time()));
$find01to31_o->addFindCriterion('受注番号_CHAR', 'O0');
//$find01to31_o->addSortRule('受注番号_CHAR', 1, FILEMAKER_SORT_ASCEND);
$result_o = $find01to31_o->execute();
if(!FileMaker::isError($result_o)){
  $records_o = $result_o->getRecords();
}

$find01to31_p = $fm->newFindcommand('売上履歴');
$find01to31_p->addFindCriterion('年月日_UNSIGN_NUMERIC', date("Ym01", time()).'...'.date("Ymt", time()));
$find01to31_p->addFindCriterion('受注番号_CHAR', 'P');
//$find01to31_p->addSortRule('受注番号_CHAR', 1, FILEMAKER_SORT_ASCEND);
$result_p = $find01to31_p->execute();
if(!FileMaker::isError($result_p)){
  $records_p = $result_p->getRecords();
}

$find01to31_q = $fm->newFindcommand('売上履歴');
$find01to31_q->addFindCriterion('年月日_UNSIGN_NUMERIC', date("Ym01", time()).'...'.date("Ymt", time()));
$find01to31_q->addFindCriterion('受注番号_CHAR', 'Q0');
//$find01to31_q->addSortRule('受注番号_CHAR', 1, FILEMAKER_SORT_ASCEND);
$result_q = $find01to31_q->execute();
if(!FileMaker::isError($result_q)){
  $records_q = $result_q->getRecords();
}

$find01to31_r = $fm->newFindcommand('売上履歴');
$find01to31_r->addFindCriterion('年月日_UNSIGN_NUMERIC', date("Ym01", time()).'...'.date("Ymt", time()));
$find01to31_r->addFindCriterion('受注番号_CHAR', 'R0');
//$find01to31_r->addSortRule('受注番号_CHAR', 1, FILEMAKER_SORT_ASCEND);
$result_r = $find01to31_r->execute();
if(!FileMaker::isError($result_r)){
  $records_r = $result_r->getRecords();
}

$find01to31_s = $fm->newFindcommand('売上履歴');
$find01to31_s->addFindCriterion('年月日_UNSIGN_NUMERIC', date("Ym01", time()).'...'.date("Ymt", time()));
$find01to31_s->addFindCriterion('受注番号_CHAR', 'S0');
//$find01to31_s->addSortRule('受注番号_CHAR', 1, FILEMAKER_SORT_ASCEND);
$result_s = $find01to31_s->execute();
if(!FileMaker::isError($result_s)){
  $records_s = $result_s->getRecords();
}

$find01to31_t = $fm->newFindcommand('売上履歴');
$find01to31_t->addFindCriterion('年月日_UNSIGN_NUMERIC', date("Ym01", time()).'...'.date("Ymt", time()));
$find01to31_t->addFindCriterion('受注番号_CHAR', 'T0');
//$find01to31_t->addSortRule('受注番号_CHAR', 1, FILEMAKER_SORT_ASCEND);
$result_t = $find01to31_t->execute();
if(!FileMaker::isError($result_t)){
  $records_t = $result_t->getRecords();
}

$find01to31_u = $fm->newFindcommand('売上履歴');
$find01to31_u->addFindCriterion('年月日_UNSIGN_NUMERIC', date("Ym01", time()).'...'.date("Ymt", time()));
$find01to31_u->addFindCriterion('受注番号_CHAR', 'U0');
//$find01to31_u->addSortRule('受注番号_CHAR', 1, FILEMAKER_SORT_ASCEND);
$result_u = $find01to31_u->execute();
if(!FileMaker::isError($result_u)){
  $records_u = $result_u->getRecords();
}

$find01to31_v = $fm->newFindcommand('売上履歴');
$find01to31_v->addFindCriterion('年月日_UNSIGN_NUMERIC', date("Ym01", time()).'...'.date("Ymt", time()));
$find01to31_v->addFindCriterion('受注番号_CHAR', 'V0');
//$find01to31_v->addSortRule('受注番号_CHAR', 1, FILEMAKER_SORT_ASCEND);
$result_v = $find01to31_v->execute();
if(!FileMaker::isError($result_v)){
  $records_v = $result_v->getRecords();
}

$find01to31_w = $fm->newFindcommand('売上履歴');
$find01to31_w->addFindCriterion('年月日_UNSIGN_NUMERIC', date("Ym01", time()).'...'.date("Ymt", time()));
$find01to31_w->addFindCriterion('受注番号_CHAR', 'W0');
//$find01to31_w->addSortRule('受注番号_CHAR', 1, FILEMAKER_SORT_ASCEND);
$result_w = $find01to31_w->execute();
if(!FileMaker::isError($result_w)){
  $records_w = $result_w->getRecords();
}

$find01to31_x = $fm->newFindcommand('売上履歴');
$find01to31_x->addFindCriterion('年月日_UNSIGN_NUMERIC', date("Ym01", time()).'...'.date("Ymt", time()));
$find01to31_x->addFindCriterion('受注番号_CHAR', 'X0');
//$find01to31_x->addSortRule('受注番号_CHAR', 1, FILEMAKER_SORT_ASCEND);
$result_x = $find01to31_x->execute();
if(!FileMaker::isError($result_x)){
  $records_x = $result_x->getRecords();
}

$find01to31_y = $fm->newFindcommand('売上履歴');
$find01to31_y->addFindCriterion('年月日_UNSIGN_NUMERIC', date("Ym01", time()).'...'.date("Ymt", time()));
//$find01to31_y->addFindCriterion('受注番号_CHAR', 'Y0');
$find01to31_y->addSortRule('受注番号_CHAR', 1, FILEMAKER_SORT_ASCEND);
$result_y = $find01to31_y->execute();
if(!FileMaker::isError($result_y)){
  $records_y = $result_y->getRecords();
}

$find01to31_z = $fm->newFindcommand('売上履歴');
$find01to31_z->addFindCriterion('年月日_UNSIGN_NUMERIC', date("Ym01", time()).'...'.date("Ymt", time()));
$find01to31_z->addFindCriterion('受注番号_CHAR', 'Z0');
//$find01to31_z->addSortRule('受注番号_CHAR', 1, FILEMAKER_SORT_ASCEND);
$result_z = $find01to31_z->execute();
if(!FileMaker::isError($result_z)){
  $records_z = $result_z->getRecords();
}
var_dump($records_z)

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
<td><?php foreach($records_z as $data){$price_Z = $data->getField('金額_DICIMAL'); $price_total_Z +=$price_Z; var_dump($price_Z);} echo $price_total_Z; unset($data) ?></td>
<td><?php foreach($records_z as $data){$cost_Z = $data->getField('原価_DICIMAL'); $cost_total_Z += $cost_Z;} echo $cost_total_Z; unset($data) ?></td>
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


?>

</body>
</html>
