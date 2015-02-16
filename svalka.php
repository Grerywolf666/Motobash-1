<?php include("header.php");
$collect=mongodb_connect_bezdna ();
//$collect_main=mongodb_connect_main ();
$pagen = Whatpagenumber($collect[collect_bezdna], $_REQUEST['pagen'],"new");
$status="new";

//echo "Итог по переменной == $pagen";
?>





<?php if($pagen!='PageError!')
{
	?>

        <!--start PAGINATION BLOCK-->
      <?php page_count_number($pagen,$collect[collect_bezdna], "new"); ?>
        <!--end PAGINATION BLOCK-->



        <!--start QUITE BLOCK-->
        <?php	$i=0; post_page_bezdna($pagen, $collect, "new", $show_admin); ?>
        <!--end QUOTE BLOCK-->

        <!--start PAGINATION BLOCK-->
        <?php page_count_number($pagen, $collect[collect_bezdna], "new"); ?>
        <!--end PAGINATION BLOCK-->
<?php }
	else
	{
		echo "<br><br>Здесь еще нет постов. Добавьте еще =)<br>";

	}

	?>


<?php include("footer.php");?>