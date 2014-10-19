<?php include("header.php");
$collect=mongodb_connect_bezdna ();
$pagen = Whatpagenumber($collect, $_REQUEST['pagen']);?>


<main role="main">

<?php if($pagen!='PageError!')
{
	?>

        <!--start PAGINATION BLOCK-->
      <?php page_count_number($pagen,$collect); ?>
        <!--end PAGINATION BLOCK-->



        <!--start QUITE BLOCK-->
        <?php	$i=0; post_page_bezdna($pagen, $collect); ?>
        <!--end QUOTE BLOCK-->

        <!--start PAGINATION BLOCK-->
        <?php page_count_number($pagen, $collect); ?>
        <!--end PAGINATION BLOCK-->
<?php }
	else
	{
		echo "Страница не существует";

	}

	?>
    </main>


<?php include("footer.php");?>