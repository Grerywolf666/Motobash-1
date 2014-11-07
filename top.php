<?php include("header.php");
$collect=mongodb_connect_bezdna ();
//$collect_main=mongodb_connect_main ();
$pagen = Whatpagenumber($collect[collect_bezdna], $_REQUEST['pagen'],"accepted");?>


<main role="main">

<?php if($pagen!='PageError!')
{
    ?>

        <!--start PAGINATION BLOCK-->
      <?php page_count_number($pagen,$collect[collect_bezdna],"accepted"); ?>
        <!--end PAGINATION BLOCK-->



        <!--start QUITE BLOCK-->


        <?php   

        $post_all=$collect[collect_bezdna]; 
         $post=postn_bezdna_top($pagen, $collect[collect_bezdna], "accepted"); // достаем из базы требуемое нам количество постов, и курсор с данной выборкой запихиваем $post

         while($post){
        
        $post_print=$post -> current();





         
        $post_numb_on_page=$pagen;
        $like_db=$collect[like];
        one_post($post_print, $pagen, $like_db);
        
        if($post ->hasNext())   // печатаем пока можем
            {$post -> next();}
        else{break;}

    }?>
        <!--end QUOTE BLOCK-->

        <!--start PAGINATION BLOCK-->
        <?php page_count_number($pagen, $collect[collect_bezdna],"accepted"); ?>
        <!--end PAGINATION BLOCK-->
<?php }
    else
    {
        echo "Страница не существует";

    }

    ?>
    </main>


<?php include("footer.php");










?>