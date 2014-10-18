<?php



///if(isset($_POST['submit']))
if($_POST[login]=="admin") {
	$Connection = new Mongo("mongodb://localhost:27017");
	$db = $Connection -> motobashdb-> security;
	//$collect -> security;
	//$collect = $db -> security	;
	$hash = md5(generateCode(10));
	$password=md5(md5($_POST[password]));
	$new_admin=array(
						login => "$_POST[login]",
						//password => "$password",
						//hash =>"$hash"	
						);
	var_dump($new_admin) ;
	$new_pass=array(
						login => "$_POST[login]",
						password => "$password",
						hash =>"$hash"	
						);



	$db->update($new_admin, $new_pass);
	//$db->insert($new_admin);
	var_dump($db);
	echo "Well Done!";
	

}
else
{ ?>

<form  action="add_admin.php" method="POST">

Логин <input name="login" type="text"><br>

Пароль <input name="password" type="password"><br>

<input name="submit" type="submit" value="Авторизироваться">

</form> <?php  
}

function generateCode($length=6) 
{

    				$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHI JKLMNOPRQSTUVWXYZ0123456789";

   					 $code = "";

   						$clen = strlen($chars) - 1;  
   					 	while (strlen($code) < $length) {

            			$code .= $chars[mt_rand(0,$clen)];  
            			  }

   						 return $code;

}
//}
?>