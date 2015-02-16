<?php 
<<<<<<< HEAD
try{
$ur="mongodb://MotoBash:MR_xeniper993A_@mc.grosvold.ru:27117/motobashdb";
//$ur="mongodb://wolfadmin:motoadmin@ds053090.mongolab.com:53090/motobashdb";
    $Connection = new Mongo($ur);

=======
$Connection = new Mongo("mongodb://localhost:27017");
>>>>>>> 7698273afb9633d496e1692eb16b51456ba8df9f
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
<<<<<<< HEAD
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
            <div class="search-input">
                <input type="button" value="search" class="search icon"/>
                <input type="search" class="text empty" placeholder="найти..."/>
            </div>
        </div>
    </header>
    <nav>
        <div class="wrapper">
            <a class="menu active" href="#">новые</a>
            <a class="menu" href="#">случайные</a>
            <a class="menu" href="#">лучшие</a>
            <a class="menu" href="#">по рейтингу</a>
            <a class="menu" href="#">+ добавить</a>
            <a class="menu" href="#">Свалка</a>
            <a class="menu" href="#">
                топ свалки
                <span class="count">127</span>
            </a>
        </div>
    </nav>
<?php include("functions.php");?>
    <main>
=======
    ?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Motobash</title>
    <meta name="description" content="Мотоциклетный искрометный юмор" />
    <meta name="keywords" content="мото, moto, юмор, байк, байкеры шутят, мотоцикл прикол, мотоциклисты жгут" />
    <link rel="prev" href="#prev-page-link" />
    <link rel="next" href="#next-page-link" />
    <link rel="stylesheet" href="styles/index.css" />
</head>
<body>
    <div id="wrapper" class="wrapper">

        <!--start HEADER BLOCK-->
        <header role="banner" id="header" class="header">

            <h1 data-href="/" class="headline">MotoBash — отборный мотоюмор</h1>

            <!--start SOCIAL LINKS BLOCK-->
            <div id="our-feed" class="our-feed">
                <a class="instagramm" href="#instagramm" rel="nofollow me">Motoviewer в Instagramm</a>
                <a class="vk" href="#vk" rel="nofollow me">Motoviewer в VK</a>
                <a class="feed" href="#rss" rel="nofollow">RSS лента MotoBash</a>
            </div>
            <!--end SOCIAL LINKS BLOCK-->

            <!--start SEARCH FORM BLOCK-->
            <div id="search-form" class="search-form">
                <form role="search" action="search.php" method="POST">
                    <label for="search">Поиск: </label>
                    <input name="search" placeholder="Ключевое слово или номер цитаты" id="search" type="search"/>
                    <button type="submit" name="search-submit">Искать</button>
                </form>
            </div>
            <!--end SEARCH FORM BLOCK-->

            <section id="intro" class="intro">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                <p>Consequatur nobis quis sapiente soluta velit? Qui, reiciendis.</p>
            </section>

            <!--start MAIN NAVIGATION BLOCK-->
            <nav id="main-menu" class="main-menu" role="navigation">
                <ul>
                    <li><a href="/" title="Последние одобренные цитаты">последние</a></li>
                    <li><a href="/random.php" title="Случайно выбранная цитата">случайная</a></li>
                    <li><a href="/best.php" title="Цитаты, бережно отобранные админами сайта">лучшие</a></li>
                    <li><a href="/top.php" title="Цитаты, набравшие наибольшее количество плюсов">по рейтингу</a></li>
                    <li><a href="/newpost.php" title="Есть интересная история? Присылай!">добавить</a></li>
                    <li><a href="/garaj.php" title="Все цитаты, добавленные на сайт">Бездна</a></li>
                    <li><a href="/top_garaj.php" title="Лучшие цитаты, добавленные вами">топ Бездны</a></li>
                </ul>
            </nav>
            <!--end MAIN NAVIGATION BLOCK-->
        </header>
<?php include("functions.php");?>
    <!--end HEADER BLOCK-->
>>>>>>> 7698273afb9633d496e1692eb16b51456ba8df9f
