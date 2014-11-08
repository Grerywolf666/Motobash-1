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
        
         best_post_today($collect, $show_admin); 
         }
         if($_REQUEST[page_top]=='month')
         {
            best_post_month($collect, $show_admin);

         }
         elseif (($_REQUEST[page_top]!='month') and ($_REQUEST[page_top]))
         {
            best_post_year($collect, $_REQUEST[page_top], $show_admin);

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