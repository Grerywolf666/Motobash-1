
<?php  include("header.php"); 



if($_REQUEST['usertext'])
{
	?>
	<p>Ваш пост успешно добавлен и отправлен на рассмотрение в бездну. Очень скоро вы сможете его увидеть на главной странице</p>

<?php
$umail_temp=$_REQUEST['usermail'];
$post_text_temp=$_REQUEST['usertext'];
$post_data_temp = date('d-m-Y h:i');
//echo $post_time_temp;
//$Connection = new Mongo("mongodb://localhost:27017", array("connect" => TRUE));
//$db = $Connection -> motobashdb;
$collection = mongodb_connect_bezdna ();

/*for ($h=0; $h < 100; $h++) 
{ 
	$post_text_temp=$_REQUEST['usertext'].'пост номер '.$h;*/
$curs_numb = $collection -> find();
$curs_numb -> sort(array("numb" => -1 ));
$curs_numb -> limit(1);

$curs_numb -> rewind();

$i = $curs_numb -> current();
//var_dump($i);
$post_numb = (int)($i['numb']+1);
//var_dump($post_numb);
//echo $post_numb;
$data = array(
	//id
    postdate => "$post_data_temp",
   // posttime => "$post_time_temp",
    postemail => "$umail_temp",
    posttext => "$post_text_temp",
    numb => $post_numb,

);
$collection -> insert( $data );
//var_dump($data);
//$cursor = $collection->find();

/*}*/
}
else
{
	echo "<p>Ну просто нежданчик. Иногда бывает</p>";
}

 include("footer.php");


?>