<html>
<head>
<link rel="stylesheet" href="resources/main.css" type="text/css">
<?php
$travel=$_GET['travel'];
include "show.php";
photo($travel);
?>
<br>
<a href="javascript:history.go(-1)">戻る</a>
</html>
