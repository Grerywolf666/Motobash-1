
<?php
$umail_temp="greywolf@mail.ru";
$post_text_temp="Это текст для мотобаша. Привет всем. Сколько нужно программистов, чтобы поменять лампочку? Ответ - безпонятия =)))";
$post_data_temp = "10-20-3020 14:32";
//echo $post_time_temp;
$Connection = new Mongo("mongodb://localhost:27017", array("connect" => TRUE));
$db = $Connection -> motobashdb;


//urs_numb = $db -> post;
//$curs_numb=$collection -> find();
for ($h=0; $h < 100; $h++) { 
	$collection = $db -> newpostt;
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
}

//var_dump($data);
//$cursor = $collection->find();



	echo "<p>Ну просто нежданчик. Иногда бывает</p>";
