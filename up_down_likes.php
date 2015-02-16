<?php
include("functions.php");
$collect=mongodb_connect_bezdna ();
if(like_accept($_COOKIE[$_REQUEST[number]], $_REQUEST[number]))
 {


if($_REQUEST[submit]=="+")
{
	$show_like=$_REQUEST[number];
	
    
    setcookie("$show_like", "$show_like", time()+3600*24*30*12, "/");
    $like=up_like($_REQUEST[number], $collect[collect_bezdna], TRUE);
    $otvet=array(success=TRUE,
        id=$show_like,
        rating=$like,)
    echo json_encode($otvet);    
}
elseif ($_REQUEST[submit]=="-") {
    $show_like=$_REQUEST[number];
    $like=up_like($_REQUEST[number], $collect[collect_bezdna], FALSE);
    setcookie("$show_like", "$show_like", time()+3600*24*30*12, "/");
    
    $otvet=array(success=TRUE,
        id=$show_like,
        rating=$like,)
    echo json_encode($otvet);
    }
else
{
        echo "failed";
}
}
else
{
    echo "failed";
}

?>


