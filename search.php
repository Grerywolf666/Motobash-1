<?php include("header.php");
$collect=mongodb_connect_bezdna ();

?>


<main role="main">
<br>
<br>

<?php if($_REQUEST[search])
{
    $flagff=FALSE;
 

    $filt=array(
        numb=>(int)$_REQUEST[search],);
    $post=$collect[collect_bezdna]->findOne($filt);                //если найдет хотя бы один по номеру
    if($post)

    {
         $flagff=TRUE;
         $post_print=$post;
         $like_db=$collect[like];
        one_post($post_print, $page_numb, $like_db, $show_admin);
    }



        else
    {

    $filt=array(
        posttext=>new MongoRegex ( "/{$_REQUEST[search]}/i" ),);


    $check=$collect[collect_bezdna]->findOne($filt);                //если найдет хотя бы один по запросу

    if($check){
    $post=$collect[collect_bezdna]->find($filt);                // создаем запрос для поиска
    $post -> sort(array("numb" => -1 ));
    $post -> limit(50);                     // пока введу ограничение на поиск только из 50 пследних постов
    $post-> rewind();
                


    while($post){
        $flagff=TRUE;
        $post_print=$post -> current();
        $like_db=$collect[like];
       one_post($post_print, $page_numb, $like_db, $show_admin);
        if($post ->hasNext())
            {$post -> next();
                $flagff=TRUE;}
        else{break;}

}    
}
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
    </main>


<?php include("footer.php");?>