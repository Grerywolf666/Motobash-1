<?php 
include("header.php"); 
?>

<?php
var_dump($_REQUEST[usertext]);
echo nl2br( "<br>TEXT<br> $_REQUEST[usertext]<br><br>");
?>
<form action="test.php" method="POST" name="addform">
<p><label>Ваш e-mail: <input type="text" name="usermail" autofocus maxlength="50"></label></p>
<p><textarea name="usertext" cols="50" rows="6"></textarea></p>
<p><input type="submit" name="newpost" value="Отправить на рассмотрение"></p>
</form></html>






<?php
 include("footer.php");
 ?>
