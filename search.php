<?php include("header.php");
$collect=mongodb_connect_bezdna ();
//$collect_main=mongodb_connect_main ();
?>


<main role="main">

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
        ?>


        <!--start прорисовка поста найденного по номеру           =============================================-->

        <figure id="quote-<?php echo $post_print[numb]; ?>" class="quote">
            <figcaption class="actions">
                <div class="id">#<?php echo $post_print[numb]; ?></div>
                <div class="rating">
                    <div class="grade">
                        <form  action="up_down_likes.php" method="POST">
                            <input name="number" type="hidden" value="<?php echo $post_print[numb]; ?>">
                            <input name="submit" type="submit" value="+">
                        </form>
                    </div>
                    <span class="value"><?php echo show_like($post_print[numb],$like_db) ;?> </span>
                    <div class="downgrade">
                        <form  action="up_down_likes.php" method="POST">
                            <input name="number" type="hidden" value="<?php echo $post_print[numb]; ?>">
                            <input name="submit" type="submit" value="-">
                        </form>
                    </div>
                </div>
                <div class="share" id="s1">Поделиться</div>
                <div class="pubdate">
                    <time datetime="<?php echo '$post_print[postdate]'; ?>" pubdate>
                        <span class="day"><?php echo get_date_day($post_print[postdate]); ?></span>-<span class="month"><?php echo get_date_month($post_print[postdate]); ?></span>-<span class="year"><?php echo get_date_year($post_print[postdate]); ?></span> <span class="time"><?php echo get_date_time($post_print[postdate]); ?></span>
                    </time>
                </div>
            </figcaption>
            <article class="content" role="article">
                <?php echo $post_print[posttext];?>
            </article>
            <div class="edit">
                <form  action="edit.php" method="POST">
                    <input name="post_numb_in_base" type="hidden" value="<?php echo $post_print[numb];?>">
                    <input name="Edit" type="submit" value="Edit">
                </form>
            </div>
        </figure>
            <?php

    }



        else
    {

    $filt=array(
        posttext=>new MongoRegex ( "/{$_REQUEST[search]}/i" ),);


    $check=$collect[collect_bezdna]->findOne($filt);                //если найдет хотя бы один по запросу

    if($check){
    $post=$collect[collect_bezdna]->find($filt);                // создаем запрос для поиска
    $post -> sort(array("numb" => -1 ));
    $post -> limit(50);   // пока введу ограничение на поиск только из 50 пследних постов
    $post-> rewind();
                


    while($post){
        $flagff=TRUE;
        $post_print=$post -> current();
        $like_db=$collect[like];
        ?>


        <!--start прорисовка постов -->
        <figure id="quote-<?php echo $post_print[numb]; ?>" class="quote">
            <figcaption class="actions">
                <div class="id">#<?php echo $post_print[numb]; ?></div>
                <div class="rating">
                    <div class="grade">
                        <form  action="up_down_likes.php" method="POST">
                            <input name="number" type="hidden" value="<?php echo $post_print[numb]; ?>">
                            <input name="submit" type="submit" value="+">
                        </form>
                    </div>
                    <span class="value"><?php echo show_like($post_print[numb],$like_db) ;?> </span>
                    <div class="downgrade">
                        <form  action="up_down_likes.php" method="POST">
                            <input name="number" type="hidden" value="<?php echo $post_print[numb]; ?>">
                            <input name="submit" type="submit" value="-">
                        </form>
                    </div>
                </div>
                <div class="share" id="s1">Поделиться</div>
                <div class="pubdate">
                    <time datetime="<?php echo '$post_print[postdate]'; ?>" pubdate>
                        <span class="day"><?php echo get_date_day($post_print[postdate]); ?></span>-<span class="month"><?php echo get_date_month($post_print[postdate]); ?></span>-<span class="year"><?php echo get_date_year($post_print[postdate]); ?></span> <span class="time"><?php echo get_date_time($post_print[postdate]); ?></span>
                    </time>
                </div>
            </figcaption>
            <article class="content" role="article">
                <?php echo $post_print[posttext];?>
            </article>
            <div class="edit">
                <form  action="edit.php" method="POST">
                    <input name="post_numb_in_base" type="hidden" value="<?php echo $post_print[numb];?>">
                    <input name="Edit" type="submit" value="Edit">
                </form>
            </div>
        </figure>
            <?php






            /*
            //======================================ФУНКЦИИ ДОБАВЛЕНИЯ И УДАЛЕНИЯ================================================= 
         

            //====================================================================================================================
            */ ?>

        <!--end QUOTE BLOCK-->






<?php
        //$i++;
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