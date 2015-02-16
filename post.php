<?php include("header.php");
$collect=mongodb_connect_bezdna ();

?>




<?php if($_REQUEST[number])
{
    $flagff=FALSE;
 

    $filt=array(
        numb=>(int)$_REQUEST[number],);
    $post=$collect[collect_bezdna]->findOne($filt);                //если найдет хотя бы один по номеру
    if($post)

    {
         $flagff=TRUE;
         $post_print=$post;
         $like_db=$collect[like];
        one_post($post_print, $page_numb, $like_db, $show_admin);
    }

 if($flagff=FALSE)
        {
            echo "По вашему запросу ничего не найдено";
        }
}



    else
    {
        echo "Страница не существует";

    }

    ?>


<?php include("footer.php");?>