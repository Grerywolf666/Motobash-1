<?php include("header.php");
$collect=mongodb_connect_bezdna ();
//$collect_main=mongodb_connect_main ();
if($_REQUEST[submit]=="+")
{
    up_like($_REQUEST[number], $collect[collect_bezdna], TRUE);
    echo "<br><br> Апнут<br><br>";
}
elseif ($_REQUEST[submit]=="-") {
    up_like($_REQUEST[number], $collect[collect_bezdna], FALSE);
    echo "<br><br>Пост лажа<br><br>";
    }
    else
    {
        echo "<br><br> че то не то <br><br>";
    }

?>



<?php include("footer.php");?>