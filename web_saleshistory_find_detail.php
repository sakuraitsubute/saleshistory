<?php
//session_start();
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

$recordid = htmlspecialchars($_POST['recordid'], ENT_QUOTES,'utf-8');

$findcommand = $fm->newFindCommand('売上履歴詳細');
$findcommand->addFindCriterion('レコードID', $recordid);
$result = $findcommand->execute();

if(FileMaker::isError($result)){
  $error = array('fail'=>'FileMaker Error:'.$result->getCode().$result->getMessage());
  $jsonerror = json_encode($error,JSON_UNESCAPED_UNICODE);
  echo $jsonerror;
}else{
  $record = $result->getFirstRecord();
  $data = array(
    'success'=>'通信成功',
    'date'=>date('Y/m/d', strtotime($record->getField('年月日_UNSIGN_NUMERIC'))),
    'seiri'=>$record->getField('整理番号_UNSIGN_NUMERIC'),
    'order'=>$record->getField('受注番号_CHAR'),
    'tokui'=>$record->getField('得意先名'),
    'gait'=>$record->getField('売上履歴_外注先_dbo.KFMGAIT::名称_CHAR'),
    'title'=>$record->getField('タイトル名'),
    'amount'=>$record->getField('数量_DECIMAL'),
    //'s_price'=>$record->getField('単価_UNSIGN_DICIMAL'),
    //'price'=>$record->getField('金額_DECIMAL'),
    //'cost'=>$record->getField('原価_DECIMAL'),
    //'profit'=>$record->getField('差益'),
    //'profit_rate'=>$record->getField('利益率')
  );
  $jsondata = json_encode($data, JSON_UNESCAPED_UNICODE);
  echo $jsondata;
}

?>