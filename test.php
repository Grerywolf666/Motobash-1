<?php 
include("header.php"); 



$collect=mongodb_connect_bezdna();
$n=(int)$_REQUEST[post_numb_in_base];
$filt=array( "numb"=> 19);

$collect[collect_bezdna]->remove($filt);
Echo "<br><br>Пост одобрен<br><br>";






 include("footer.php");
 ?>