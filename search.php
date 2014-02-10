<?php
   include_once "DatabaseClass.php";
   $db = new Database();
   extract($_POST);
   if($disposal==="caption") caption($caption);
   else if($disposal==="date") hiduke($start,$end);
   else if($disposal==="user") user($user);
   function caption($caption){
      global $db;
      $query = "select t.caption,t.start_date,t.end_date,t.travel_name,u.name from travel t, user u where t.user_id=u.id and t.caption like ?";
      $name='%'.$caption.'%';
      $db->prepare($query);
      $db->bind_param('s',$name);
      $result=$db->execute();
      if($result->num_rows == 0){
        die("<html>結果はありません。<br><a href='javascript:history.go(-1)'>戻る</a></html>");
      }
      $result->bind_result($result_name,$result_start,$result_end,$travel_id,$result_user);
      echo "<table border=4 width=500 align=center><tr><th>旅行名</th><th>開始日</th><th>終了日</th><th>作成者</th></tr>";
      while($result->fetch()){
        echo "<tr>";
        echo "<th><a href=show_photo.php?travel=".$travel_id.">".$result_name."</th></a>";
        echo "<th>".$result_start."</th>";
        echo "<th>".$result_end."</th>";
        echo "<th>".$result_user."</th>";
        echo "</tr>";
      }
      echo "</table>";
   }

   function hiduke($start,$end){
      global $db;
      $query = "select t.caption,t.start_date,t.end_date,t.travel_name,u.name from travel t, user u where t.user_id=u.id and t.start_date between ? and ?";
      $db->prepare($query);
      $db->bind_param('ss',$start,$end);
      $result=$db->execute();
      if($result->num_rows == 0){
        die("<html>結果はありません。<br><a href='javascript:history.go(-1)'>戻る</a></html>");
      }
      $result->bind_result($result_name,$result_start,$result_end,$travel_id,$result_user);
      echo "<table border=4 width=500 align=center><tr><th>旅行名</th><th>開始日</th><th>終了日</th><th>作成者</th></tr>";
      while($result->fetch()){
        echo "<tr>";
        echo "<th><a href=show_photo.php?travel=".$travel_id.">".$result_name."</th></a>";
        echo "<th>".$result_start."</th>";
        echo "<th>".$result_end."</th>";
        echo "<th>".$result_user."</th>";
        echo "</tr>";
      }
      echo "</table>";
   }

   function user($user){
      global $db;
      $query = "select t.caption,t.start_date,t.end_date,t.travel_name,u.name from travel t, user u where t.user_id=u.id and u.name=?";
      $db->prepare($query);
      $db->bind_param('s',$user);
      $result=$db->execute();
      if($result->num_rows == 0){
        die("<html>結果はありません。<br><a href='javascript:history.go(-1)'>戻る</a></html>");
      }
      $result->bind_result($result_name,$result_start,$result_end,$travel_id,$result_user);
      echo "<table border=4 width=500 align=center><tr><th>旅行名</th><th>開始日</th><th>終了日</th><th>作成者</th></tr>";
      while($result->fetch()){
        echo "<tr>";
        echo "<th><a href=show_photo.php?travel=".$travel_id.">".$result_name."</th></a>";
        echo "<th>".$result_start."</th>";
        echo "<th>".$result_end."</th>";
        echo "<th>".$result_user."</th>";
        echo "</tr>";
      }
      echo "</table>";
   }
?>
