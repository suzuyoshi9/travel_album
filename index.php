<!DOCTYPE HTML>
<html>
<head>
<title>旅行写真データベース</title>
<script type="text/javascript" src="menu.js"></script>
<link rel="stylesheet" href="main.css" type="text/css">
<link rel="stylesheet" href="menu.css" type="text/css">
</head>
<body>
<h1>Travel Album</h1>
<?php
session_start();
if(isset($_SESSION["USERID"])) echo $_SESSION["USERID"]."でログインしています<br><br>";
else echo "ログインしていません<br><br>";
?>
<div class="menus">
各メニューをクリック
<div class="menu_off">
 <div class="menuitem" onclick="doToggleClassName(getParentObj(this),'menu_on','menu_off')">旅行</div>
 <ul>
  <li><a href="search_travel.html">検索</a></li>
  <li><a href="add_travel.html">追加</a></li>
  <li><a href="modify_travel.php">編集</a></li>
  <li><a href="delete_travel.php">削除</a></li>
 </ul>
</div>
<div class="menu_off">
 <div class="menuitem" onclick="doToggleClassName(getParentObj(this),'menu_on','menu_off')">写真</div>
 <ul>
  <li><a href="add_photo.html">追加</a></li>
  <li><a href="delete_photo.php">削除</a></li>
 </ul>
</div>
<div class="menu_off">
 <div class="menuitem" onclick="doToggleClassName(getParentObj(this),'menu_on','menu_off')">ユーザー</div>
 <ul>
  <li><a href="add_user.html">追加</a></li>
  <li><a href="modify_user.html">編集</a></li>
  <li><a href="delete_user.html">削除</a></li>
  <li><a href="login.html">ログイン</a></li>
  <li><a href="logout.php">ログアウト</a></li>
 </ul>
</div>
</div>
<div class="list">
旅行一覧
<table border=4 width=500 align=center>
<tr>
<th>旅行名</th>
<th>開始日</th>
<th>終了日</th>
<th>作成者</th>
</tr>
<?php
  include "show.php";
  main();
?>
</table>
</div>
</body>
</html>
