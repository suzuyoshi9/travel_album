<?php
   include_once "DatabaseClass.php";
   session_start();
   if(!isset($_SESSION["USERID"])){
    die('<html><body>ログインしていません<br><a href="javascript:history.go(-1)">戻る</a>');
   }
   $db = new Database();
   $user=$_SESSION["USERID"];
?>
<!DOCTYPE HTML>
<html>
<head>
<title>旅行の削除</title>
<link rel="stylesheet" href="main.css" type="text/css">
<script type="text/javascript" src="check.js"></script>
</head>
<body>
<p>旅行の削除</p>
<form action="delete.php" method="POST" onSubmit="return check()">
<?php
   $query="select t.travel_name,t.caption from travel t, user u where t.user_id=u.id and u.name = ?";
   $db->prepare($query);
   $db->bind_param('s',$user);
   $result=$db->execute();
   if($result->num_rows == 0){
        echo "旅行はありません";
   }
   else{
     echo "<select name='travel_name' required>";
     $result->bind_result($travel_name,$caption);
     while($result->fetch()){
        echo "<option value=".$travel_name.">";
        echo $caption;
        echo "</option>";
     }
     echo "</select>";
     echo "<input type='hidden' name='disposal' value='travel'>";
     echo "<p><input type='submit' value='送信'></p>";
   }
?>
</form>
<a href="/travel_album">メインへ</a>
</body>
</html>
