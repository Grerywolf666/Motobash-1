<?php
include("functions.php");
$collect=mongodb_connect_bezdna ();

if($_REQUEST[submit]=="+")
{
	$show_like=$_REQUEST[number];
	
    
    setcookie("$show_like", "$show_like", time()+3600*24*30*12, "/");
    up_like($_REQUEST[number], $collect[collect_bezdna], TRUE);
}
elseif ($_REQUEST[submit]=="-") {
	$show_like=$_REQUEST[number];
    up_like($_REQUEST[number], $collect[collect_bezdna], FALSE);
    setcookie("$show_like", "$show_like", time()+3600*24*30*12, "/");
    //echo "<br><br>Пост лажа<br><br>";
    }
    else
    {
       // echo "<br><br> че то не то <br><br>";
    }
    header("Location: index.php"); exit();


?>



<?//php include("footer.php");?>