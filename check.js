//http://www.tagindex.com/javascript/form/submit.html 参考

function check(){
	if(GetFileName(location.href)==="delete_user.html")
          message="送信してよろしいですか？\n写真と旅行も削除されます";
	else if(GetFileName(location.href)==="delete_travel.php")
          message="送信してもよろしいですか？\n写真も削除されます";
        else message="送信してもよろしいですか？";
	if(window.confirm(message)){ // 確認ダイアログを表示

		return true; // 「OK」時は送信を実行

	}
	else{ // 「キャンセル」時の処理

		return false; // 送信を中止

	}

}
//http://asobicocoro.com/tips/article/48 参考
function GetFileName(file_url){
	file_url=file_url.substring(file_url.lastIndexOf("/")+1,file_url.length);
 return file_url;
}
