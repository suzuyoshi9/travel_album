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

    if($disposal==="travel") travel($ID,$user,$caption,$start,$end,$_FILES);
    else if($disposal==="photo")  photo($ID,$_FILES);

    function travel($ID,$user,$name,$start,$end,$file){
        global $db;
        $uid=$db->getuid($user);
        $up_dir="img";
        $up_thumb="img_thumb";
        $query = "insert into travel (user_id,travel_name,caption,start_date,end_date) values (?,?,?,?,?)";
        $db->prepare($query);
        $db->bind_param('issss',$uid,$ID,$name,$start,$end);
        $result=$db->execute();
        if(!$result) die("旅行の追加に失敗しました");
        $travel_id=$db->insert_id;

        photo($name,$file);
        /*foreach($file["image"]["error"] as $key => $error){
            if($error==UPLOAD_ERR_OK){
                $moto_name=$file["image"]["name"][$key];
                $tmp_name=$file["image"]["tmp_name"][$key];
                $file_name=substr(base_convert(md5(uniqid()), 16, 36), 0, 20).".".substr(strrchr($moto_name, '.'), 1);

                $query = "insert into photo (travel_id,path) values (?,?)";
                $db->prepare($query);
                $db->bind_param('is',$travel_id,$file_name);
                $result=$db->execute();
                if(!$result) die("写真の追加に失敗しました");
                move_uploaded_file($tmp_name,"$up_dir/$file_name");
                copy("$up_dir/$file_name","$up_thumb/$file_name");
                $image = new Imagick("$up_thumb/$file_name");
                $image->thumbnailImage(150,150);
                $image->writeImages("$up_thumb/$file_name",true);
            }
        }*/
        echo "<html><body>旅行の追加に成功しました。<br><a href=index.php>トップに戻る</a></body></html>";
    }

    function photo($travel_name,$file){
        global $db;
        $up_dir="img";
        $up_thumb="img_thumb";
        $travel_id=$db->gettid($travel_name);

        foreach($file["image"]["error"] as $key => $error){
            if($error==UPLOAD_ERR_OK){
                $moto_name=$file["image"]["name"][$key];
                $tmp_name=$file["image"]["tmp_name"][$key];
                $file_name=substr(base_convert(md5(uniqid()), 16, 36), 0, 20).".".substr(strrchr($moto_name, '.'), 1);

                $query = "insert into photo (travel_id,path) values (?,?)";
                $db->prepare($query);
                $db->bind_param('is',$travel_id,$file_name);
                $result=$db->execute();
                if(!$result) die("写真の追加に失敗しました");
                move_uploaded_file($tmp_name,"$up_dir/$file_name");
                copy("$up_dir/$file_name","$up_thumb/$file_name");
                $image = new Imagick("$up_thumb/$file_name");
                $image->thumbnailImage(150,0);
                $image->writeImages("$up_thumb/$file_name",true);
            }
        }
        echo "写真の追加に成功しました。";
    }
?>
