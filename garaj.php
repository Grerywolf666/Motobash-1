<?php include("header.php");
$collect=mongodb_connect_bezdna ();
//$collect_main=mongodb_connect_main ();
$pagen = Whatpagenumber($collect[collect_bezdna], $_REQUEST['pagen']);

//echo "Итог по переменной == $pagen";
?>


<main role="main">



<?php if($pagen!='PageError!')
{
	?>

        <!--start PAGINATION BLOCK-->
      <?php page_count_number($pagen,$collect[collect_bezdna]); ?>
        <!--end PAGINATION BLOCK-->



        <!--start QUITE BLOCK-->
        <?php	$i=0; post_page_bezdna($pagen, $collect); ?>
        <!--end QUOTE BLOCK-->

        <!--start PAGINATION BLOCK-->
        <?php page_count_number($pagen, $collect[collect_bezdna]); ?>
        <!--end PAGINATION BLOCK-->
<?php }
	else
	{
		echo "Страница не существует";

	}

	?>
    </main>


<?php include("footer.php");?>