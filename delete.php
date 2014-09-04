<?php
include_once "DatabaseClass.php";
session_start();
if(!isset($_SESSION["USERID"])){
    die('<html><body>ログインしていません<br><a href="javascript:history.go(-1)">戻る</a>');
}

$db = new Database();
$db->change_user();
extract($_POST);
$user=$_SESSION["USERID"];

if($disposal==="travel") travel($travel_name);
else if($disposal==="photo")  photo($file_name);
else if($disposal==="user") user($user);

function travel($travel){
    global $db;
    $names=array();
    $tid=$db->gettid($travel);
    $query = "select path from photo where travel_id=?";
    $db->prepare($query);
    $db->bind_param('i',$tid);
    $result=$db->execute();
    $result->bind_result($tmp);
    while($result->fetch()) array_push($names,$tmp);
    foreach($names as $photo_name) photo($photo_name);
    $query = "delete from travel where id=?";
    $db->prepare($query);
    $db->bind_param('i',$tid);
    $result=$db->execute();
    if(!$result) die("<html><body>旅行の削除に失敗しました。<br><a href=index.php>トップに戻る</a></body></html>");
    echo "<html><body>旅行の削除に成功しました。<br><a href=index.php>トップに戻る</a></body></html>";
}

function photo($file_name){
    global $db;
    $up_dir="img";
    $up_thumb="img_thumb";
    $query = "delete from photo where path=?";
    $db->prepare($query);
    $db->bind_param('s',$file_name);
    $result=$db->execute();
    if(!$result) die("写真の削除に失敗しました");
    unlink("$up_dir/$file_name");
    unlink("$up_thumb/$file_name");
    echo $file_name."を削除しました<br>";
}

?>
