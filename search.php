<?php include("header.php");
$collect=mongodb_connect_bezdna ();
//$collect_main=mongodb_connect_main ();
?>


<main role="main">

<?php if($_REQUEST[search])
{
    $f1="/";
    $f2="/i";
    $flagff=FALSE;
    $seashword=$f1.$_REQUEST[search].$f2;

    $filt=array(
        posttext=>"Gmail мыло",);
    $test=0;
    //$post=$collect[collect_bezdna]->find();
    $post=$collect[collect_main]->find();
    $post -> sort(array("numb" => -1 ));
    $post-> rewind();
    while($post){
        $test++;
        echo "<br><br> че та тама<br>
        $test<br>";
        $post_print=$post -> current();
        $like_db=$collect[like];
        ?>


        <!--start QUITE BLOCK-->
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
    else
    {
        echo "Страница не существует";

    }

    ?>
    </main>


<?php include("footer.php");?>