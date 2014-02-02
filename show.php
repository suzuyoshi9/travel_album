<?php
   include_once "DatabaseClass.php";
   $db = new Database();

   function main(){
      global $db;
      $query = "select t.caption,t.start_date,t.end_date,t.travel_name,u.name from travel t, user u where t.user_id=u.id";
      $result=$db->query($query);

      $result->bind_result($result_name,$result_start,$result_end,$travel_id,$result_user);
      while($result->fetch()){
        echo "<tr>";
        echo "<th><a href=show_photo.php?travel=".$travel_id.">".$result_name."</th></a>";
        echo "<th>".$result_start."</th>";
        echo "<th>".$result_end."</th>";
        echo "<th>".$result_user."</th>";
        echo "</tr>";
      }
   }

   function photo($travel){
      global $db;
      $query="select caption from travel t where t.travel_name=?";
      $db->prepare($query);
      $db->bind_param('s',$travel);
      $result=$db->execute();
      $result->bind_result($title);
      $result->fetch();
      echo "<title>".$title."</title>";
      echo "</head>";
      echo "<body>";
      echo "<h1>".$title."</h1>";

      $query= "select p.path from photo p,travel t where t.id=p.travel_id and t.travel_name=?";
      $db->prepare($query);
      $db->bind_param('s',$travel);
      $result=$db->execute();
      if($result->num_rows == 0){
        echo "<p>写真はありません。</p>";
      }
      else {
        $result->bind_result($image_path);
        while($result->fetch()){
           echo "<a href=img/".$image_path."><img src=img_thumb/".$image_path." hspace=10></a>";
        }
      }
      echo "</body>";
   }
?>
