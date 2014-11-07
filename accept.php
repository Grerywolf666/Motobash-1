<?php include("header.php"); ?>
<main>
    <?php
        $collect = mongodb_connect_bezdna();
        $n = (int)$_REQUEST[post_numb_in_base];
        $filt = array( "numb"=> $n);
        $filt2 = array( "numb"=> $n);

        $post = $collect[collect_bezdna]-> findOne($filt);

        if($post){

            $post_numb_new = $collect[collect_count_new] -> findOne();
            if($post_numb_new[all_post_numb_new]) {
                $new_post_numb = $post_numb_new[all_post_numb_new];
                $tt = (int)$post_numb_new[all_post_numb_new]+1;
                $temp = array (all_post_numb_new=> $tt,);

                $filt = array(all_post_numb_new=> $new_post_numb,);
                $collect[collect_count_new]->update($filt, $temp);
            }
            else {
                $t2=array(all_post_numb_new=> 1,);
                $collect[collect_count_new]->insert($t2);
                $tt = 1;
            }

            $new_data = array(
                postdate => "$post[postdate]",
                postemail => "$post[postemail]",
                posttext => "$post[posttext]",
                numb_new => $tt,
                numb => $n,
                status=> "accepted",
                like =>$post[like],
            );

            //$collect[collect_main] -> insert( $new_data );
            $collect[collect_bezdna]->update($filt2, $new_data);

            echo '<p class="sussess">Пост одобрен</p>';

        } else {
            echo '<p class="error">Нежданчик! Бывает</p>';
        }
    ?>
</main>
<?php include("footer.php"); ?>