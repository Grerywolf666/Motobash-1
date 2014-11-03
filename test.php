<?php 
include("header.php"); 



$collect=mongodb_connect_bezdna();
$n=(int)$_REQUEST[post_numb_in_base];
$filt=array( "numb"=> 19);

$collect[collect_bezdna]->remove($filt);
Echo "<br><br>Пост одобрен<br><br>";






 include("footer.php");
 ?>

 <form  action="up_down_likes.php" method="POST">
<input name="nuber" type="hidden" value="<?php echo $post_print[numb]; ?>"><br>
<input name="submit" type="submit" value="+">
</form>


<form  action="up_down_likes.php" method="POST">
<input name="nuber" type="hidden" value="<?php echo $post_print[numb]; ?>"><br>
<input name="submit" type="submit" value="-">
</form>