<?php
include("functions.php");
$collect=mongodb_connect_bezdna ();
<<<<<<< HEAD
if(like_accept($_COOKIE[$_REQUEST[number]], $_REQUEST[number]))
 {
=======
>>>>>>> 7698273afb9633d496e1692eb16b51456ba8df9f

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
<<<<<<< HEAD
}
=======
    header("Location: index.php"); exit();
>>>>>>> 7698273afb9633d496e1692eb16b51456ba8df9f


?>



<?//php include("footer.php");?>