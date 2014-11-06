<?php include("header.php");
$collect=mongodb_connect_bezdna ();
?>

<main role="main">

<?php if($_REQUEST[delete])
{
    $n=(int)$_REQUEST[post_numb_in_base];
    $filt=array( "numb"=> $n);

    $collect[collect_bezdna]-> remove($filt);
    echo "<br><br> Пост успешно удален<br><br>";





    
    }
    else
    {
        echo "Страница не существует";

    }

    ?>
    </main>


<?php include("footer.php");?>