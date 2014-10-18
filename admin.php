<?php



if(isset($_POST['submit'])){
	$Connection = new Mongo("mongodb://localhost:27017");
	$db = $Connection -> motobashdb;
	$collect = $db -> security;
	$filter=array("login"=> "$_POST[login]");
	//var_dump($filter) ;
	//echo "<br>" ;
	$person = $collect->findOne($filter);
	//var_dump($person);
		if($person[password])
			{
				$password = $person[password];
					if($password===md5(md5($_POST['password'])))
					{
						
						$password=md5(md5($_POST['password']));
						$new_user=array(login => "$_POST[login]",);



	//--------------------------------------------------------------------------
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
       //--------------------------------------------------------------------------
						$hash=md5(md5(generateCode(10)));
            			//echo "<br> $hash";

            			//echo "<br> ID::   $person[_id]";


            			$add_new_hash= array(login => "$_POST[login]",
												password => "$password",
												hash =>"$hash"	 ,);
            			$collect->update($new_user, $add_new_hash);

            			$person = $collect->findOne($filter);

            			setcookie("id", $person['_id'], time()+60*60*24*30);

        				setcookie("hash", $hash, time()+60*60*24*30);
        				header("Location: garaj.php"); exit();






            			}
            			else
            						{?>

<form  action="admin.php" method="POST">

Логин <input name="login" type="text"><br>

Пароль <input name="password" type="password"><br>

<input name="submit" type="submit" value="Авторизироваться">

</form>


<?php }
            			//	"password" => "$_POST[login]",
            			 //);
			}
			            			else
            						{?>

<form  action="admin.php" method="POST">

Логин <input name="login" type="text"><br>

Пароль <input name="password" type="password"><br>

<input name="submit" type="submit" value="Авторизироваться">

</form>


<?php }
		}
	//$post = $collect -> find(login: $_POST[login]); 
	//$post -> sort(array("numb" => -1 ));
	

	/*if($collect->password==$_POST[password])
	



	if ($_POST[login]=='admin')
		{
			$pass=md5(md5($_POST[password]));
			echo $pass;
		} */
	else
	{
		?>
<form  action="admin.php" method="POST">

Логин <input name="login" type="text"><br>

Пароль <input name="password" type="password"><br>

<input name="submit" type="submit" value="Авторизироваться">

</form>
<?php }