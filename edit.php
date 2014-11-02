<?php include("header.php"); ?>

<?php
if( $_REQUEST[update]=='update' )
{

$collect=mongodb_connect_bezdna();


$n=(int)$_REQUEST[post_numb_in_base];
$filt=array( "numb"=> $n);

$post=$collect[collect_bezdna]-> findOne($filt);
//$post_data_temp=$post[postdata];
$umail_temp=$post[postemail];
$post_text_temp=$_REQUEST[post_text];
$new_ar=array(

    postdate => "$post[postdate]",
   // posttime => "$post_time_temp",
    postemail => "$umail_temp",
    posttext => "$post_text_temp",
    numb => $n,


	);

$collect[collect_bezdna]->update($filt, $new_ar);
$post=$collect[collect_bezdna]-> findOne($filt);

//$edit_post=$post -> current();
//var_dump($post);
?>
<form  action="edit.php" method="POST">
Номер поста <?php echo "$post[numb]"; ?><br>
Мыло <?php echo "$post[postemail]"; ?><br>

                    
Дата <?php echo "$post[postdate]"; ?><br>

<input name="post_numb_in_base" type="hidden" value="<?php echo $n; ?>"><br>
<input name="post_text" type="textarea" size=100  value="<?php echo "$post[posttext]"; ?>"><br>


<input name="update" type="submit" value="update">



</form>
<form  action="index.php" method="POST">
<input name="cancel" type="submit" value="Отмена">
</form>
<br>одобрить!<br>
<form  action="accept.php" method="POST">
<input name="post_numb_in_base" type="hidden" value="<?php echo $n; ?>"><br>

<input name="accept" type="submit" value="accept">
</form>


<?php

}
else
{
$collect=mongodb_connect_bezdna();
$n=(int)$_REQUEST[post_numb_in_base];
$filt=array( "numb"=> $n);
echo "<br><br>$_REQUEST[post_numb_in_base]<br><br>$n<br><br>";

$post=$collect[collect_bezdna]-> findOne($filt);
//$edit_post=$post -> current();
//var_dump($post);
?>
<form  action="edit.php" method="POST">
Номер поста <?php echo "$post[numb]"; ?><br>
Мыло <?php echo "$post[postemail]"; ?><br>

                    
Дата <?php echo "$post[postdate]"; ?><br>
<input name="post_numb_in_base" type="hidden" value="<?php echo $n; ?>"><br>
<input name="post_text" type="textarea" size=100  value="<?php echo "$post[posttext]"; ?>"><br>


<input name="update" type="submit" value="update">



</form>
<form  action="index.php" method="POST">
<input name="cancel" type="submit" value="Отмена">
</form>
<?php //-------------------------======================================---------------------------------------
//одобрение производится без редактирования!!!!! Если исправтиь и нажать одобрить - то в одобреное пойдет нередактированное ?>

<br>одобрить!<br>
<form  action="accept.php" method="POST">
<input name="post_numb_in_base" type="hidden" value="<?php echo $n; ?>"><br>

<input name="accept" type="submit" value="accept">
</form>





<?php }
 include("footer.php");

?>