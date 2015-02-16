<?php 
try{
$ur="mongodb://MotoBash:MR_xeniper993A_@mc.grosvold.ru:27117/motobashdb";
//$ur="mongodb://wolfadmin:motoadmin@ds053090.mongolab.com:53090/motobashdb";
    $Connection = new Mongo($ur);

    if(isset($_COOKIE['id']) and isset($_COOKIE['hash']))
    {
        
        $db = $Connection -> motobashdb ->security;
        $filt=array(hash=> $_COOKIE['hash']);
        $access=$db->findOne($filt);
        if(($access[_id]!=$_COOKIE['id']) or ($access[hash]!=$_COOKIE['hash']))
        {
            header("Location: exit_admin.php?exit_admin=true"); exit();
            
        }
        else
        {

            
            echo "Режим Админа";
            ?>
            <form  action="/exit_admin.php" method="POST">
            <input name="exit_admin" type="submit" value="Exit">

            </form>
            <?php 
            $show_admin=true;


        }

        } 
    }
    catch(MongoConnectionException $e)
{
    die("Failed to connect to database ");
}
 
    ?>
<!doctype html>
<html lang="ru-RU">
<head>
    <meta charset="UTF-8">
    <title>Motobash</title>
    <meta name="description" content="Мотоциклетный искрометный юмор" />
    <meta name="keywords" content="мото, moto, юмор, байк, байкеры шутят, мотоцикл прикол, мотоциклисты жгут" />
    <style>
        @import "css/main.css?2";
    </style>
</head>
<body>
    <header class="header">
        <div class="wrapper">
            <div class="logo">
                <img src="img/logo.png" alt="MotoBash by Motoviewer"/>
                <p class="slogan">Отборный мотоюмор ;)</p>
            </div>
            <div class="socials">
                <a class="vk icon social" href="//vk.com/motoviewer">vk</a>
                <a class="tw icon social" href="//twitter.com/motoviewer">tw</a>
                <a class="ig icon social" href="//instagram.com/motoviewer">ig</a>
                <a class="rss icon social" href="/rss">rss</a>
            </div>
            <form class="search-input" action="search.php" method="POST">
                <input type="button" value="search" class="search icon"/>
                <input type="search" name="search" id="search" class="text empty" placeholder="найти..."/>

            </form>
        </div>
    </header>
    <nav>
        <div class="wrapper"> 
            <a class="menu <? if($_SERVER[REQUEST_URI]=='/'){ ?> active <? }   ?>" href="/">новые</a>
            <a class="menu <? if($_SERVER[REQUEST_URI]=='/random.php'){ ?> active <? }   ?>" href="/random.php">случайные</a>
            <a class="menu <? if($_SERVER[REQUEST_URI]=='/best.php'){ ?> active <? }   ?>" href="/best.php">лучшие</a>
            <a class="menu <? if($_SERVER[REQUEST_URI]=='/top.php'){ ?> active <? }   ?>" href="/top.php">по рейтингу</a>
            <a class="menu <? if($_SERVER[REQUEST_URI]=='/newpost.php'){ ?> active <? }   ?>" href="/newpost.php">+ добавить</a>
            <a class="menu <? if($_SERVER[REQUEST_URI]=='/svalka.php'){ ?> active <? }   ?>" href="/svalka.php">Свалка</a>
            <a class="menu <? if($_SERVER[REQUEST_URI]=='/top_svalka.php'){ ?> active <? }   ?>" href="/top_svalka.php">
                топ свалки
                <span class="count">127</span>
            </a>
        </div>
    </nav>
<?php include("functions.php");?>
    <main>