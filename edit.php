﻿<?php include("header.php"); ?>
<main role="main">
<?php


if($show_admin){


if( $_REQUEST[update]=='update' )
{

$collect=mongodb_connect_bezdna();


$n=(int)$_REQUEST[post_numb_in_base];
$filt=array( "numb"=> $n);

$post=$collect[collect_bezdna]-> findOne($filt);

$post_data_temp=$post[postdata];
$umail_temp=$post[postemail];
$post_text_temp=$_REQUEST[post_text];
$status=$post[status];
if($post[numb_new])
{
$new_ar=array(
	postdate => "$post[postdate]",
    postemail => "$umail_temp",
    posttext => "$post_text_temp",
    numb => $n,
    numb_new=> $post[numb_new],
    status =>$post[status],
    like => $post[like],

	);
}
else{
$new_ar=array(
	postdate => "$post[postdate]",
    postemail => "$umail_temp",
    posttext => "$post_text_temp",
    numb => $n,

    status =>$post[status],
    like => $post[like],

	);
}

$collect[collect_bezdna]->update($filt, $new_ar);
$post=$collect[collect_bezdna]-> findOne($filt);

//$edit_post=$post -> current();
//var_dump($post);
?>
<br>Пост изменен<br><br>
<form  action="edit.php" method="POST">

Номер поста <?php echo "$post[numb]"; ?><br>
Мыло <?php echo "$post[postemail]"; ?><br>

                    
Дата <?php echo "$post[postdate]"; ?><br>
Статус поста <?php echo "$post[status]"; ?><br>

<input name="post_numb_in_base" type="hidden" value="<?php echo $n; ?>"><br>
<textarea name="post_text" cols="50" rows="6" ><?php echo "$post[posttext]"; ?></textarea><br>



<input name="update" type="submit" value="update">



</form>
<form  action="index.php" method="POST">
<input name="cancel" type="submit" value="Отмена">
</form>
<form  action="delete.php" method="POST">
<input name="post_numb_in_base" type="hidden" value="<?php echo $n; ?>"><br>

<input name="delete" type="submit" value="delete">
</form>
<?php
if($post[status]=="new") 
	{?>

<br>одобрить!<br>
<form  action="accept.php" method="POST">
<input name="post_numb_in_base" type="hidden" value="<?php echo $n; ?>"><br>

<input name="accept" type="submit" value="accept">
</form>



<?php
}
}
else
{
$collect=mongodb_connect_bezdna();
$n=(int)$_REQUEST[post_numb_in_base];
$filt=array( "numb"=> $n);
//echo "<br><br>$_REQUEST[post_numb_in_base]<br><br>$n<br><br>";

$post=$collect[collect_bezdna]-> findOne($filt);
//$edit_post=$post -> current();
//var_dump($post);
?>
<br><br><br>
<form  action="edit.php" method="POST">
Номер поста <?php echo "$post[numb]"; ?><br>
Мыло <?php echo "$post[postemail]"; ?><br>

                    
Дата <?php echo "$post[postdate]"; ?><br>
Статус поста <?php echo "$post[status]"; ?><br>
<input name="post_numb_in_base" type="hidden" value="<?php echo $n; ?>"><br>
<textarea name="post_text" cols="50" rows="6" ><?php echo "$post[posttext]"; ?></textarea><br>


<input name="update" type="submit" value="update">



</form>
<form  action="index.php" method="POST">
<input name="cancel" type="submit" value="Отмена">
</form>
<form  action="delete.php" method="POST">
<input name="post_numb_in_base" type="hidden" value="<?php echo $n; ?>"><br>

<input name="delete" type="submit" value="delete">
</form>
<?php //-------------------------======================================---------------------------------------
//одобрение производится без редактирования!!!!! Если исправтиь и нажать одобрить - то в одобреное пойдет нередактированное

if($post[status]=="new") 
	{?>

<br>одобрить!<br>
<form  action="accept.php" method="POST">
<input name="post_numb_in_base" type="hidden" value="<?php echo $n; ?>"><br>

<input name="accept" type="submit" value="accept">
</form>




</main>
<?php }} }
else
echo "<br><br>Ошибка доступа<br><br>";
 include("footer.php");

?>