
<?php  include("header.php"); 



if($_REQUEST['usertext'])
{
	if (filter_var($_REQUEST['usermail'], FILTER_VALIDATE_EMAIL))     // функция проверки email. пропускает любые адреса формата xxx@yyy.zz. Но кирилицу не пропускает) 
	{

	
	?>
	<p>Ваш пост успешно добавлен и отправлен на рассмотрение в бездну. Очень скоро вы сможете его увидеть на главной странице</p>

<?php
$umail_temp=$_REQUEST['usermail'];
$post_text_temp=strip_tags($_REQUEST['usertext'], "<br>"); 	     //функция удаляет все теги html и php из текста кроме тега <br>
$post_data_temp = date('d-m-Y h:i');

$collection = mongodb_connect_bezdna ();


$post_numb=$collection[collect_count] -> findOne();
if($post_numb[all_post_numb])
{
	$temp=array (all_post_numb=> $post_numb[all_post_numb],);
	$new_post_numb=$post_numb[all_post_numb]+1;
	$filt=array(all_post_numb=> $new_post_numb,);
	$collection[collect_count]->update($temp, $filt);
}
else
{
	$t2=array(all_post_numb=> 1,);
	$collection[collect_count]->insert($t2);
	$new_post_numb=1;

}
$data = array(
	//id
    postdate => "$post_data_temp",
   // posttime => "$post_time_temp",
    postemail => "$umail_temp",
    posttext => "$post_text_temp",
    numb => $new_post_numb,
    status =>"new",


);
$collection[collect_bezdna] -> insert( $data );
//var_dump($data);
//$cursor = $collection->find();

/*}*/
}
else
{
	echo "<br> Вы ввели некорретный Email адресс <br>";
}
}

else
{
	echo "<p>Ну просто нежданчик. Иногда бывает</p>";
}

 include("footer.php");


?>