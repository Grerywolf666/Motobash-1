<?php include("header.php");
$collect=mongodb_connect_bezdna (); 
$post_numb=$collect[collect_count] -> findOne();

    $filt=array(
    status =>"accepted",);
    $postt=$collect[collect_bezdna]->findOne($filt);
if($postt){
do{
    
    $random=mt_rand(1, $post_numb[all_post_numb] );
    $filt=array(numb => $random,
    status =>"accepted",);
    $post=$collect[collect_bezdna]->findOne($filt);
}while (!$post); }

?>

<main role="main">
<?php

if($post)
{
        $post_print=$post;
        $like_db=$collect[like];
        one_post($post_print, $page_numb, $like_db, $show_admin);
}
else
{
    echo "<br><br>Страница не найдена<br><br>";
}

?>
    </main>


<?php include("footer.php");?>