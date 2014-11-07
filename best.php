<?php include("header.php");
$collect=mongodb_connect_bezdna ();
//$collect_main=mongodb_connect_main ();
//$pagen = Whatpagenumber($collect[collect_bezdna], $_REQUEST['pagen'],"accepted");?>


<main role="main">

<?php if($pagen!='PageError!')
{
    ?>

        <!--start PAGINATION BLOCK-->
      <?php menu_top($collect, $_REQUEST[page_top]); ?>
        <!--end PAGINATION BLOCK-->



        <!--start QUITE BLOCK-->

        <?php  
        if(!$_REQUEST[page_top])
        {
        
         best_post_today($collect); 
         }
         if($_REQUEST[page_top]=='month')
         {
            best_post_month($collect);

         }
         else
         {
            best_post_year($collect, $_REQUEST[page_top]);

         }


         ?>
        <!--end QUOTE BLOCK-->

        <!--start PAGINATION BLOCK-->
        <?php menu_top($collect, $_REQUEST[page_top]); ?>
        <!--end PAGINATION BLOCK-->
<?php }
    else
    {
        echo "Страница не существует";

    }

    ?>
    </main>


<?php include("footer.php");?>