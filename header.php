﻿<!doctype html>
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
                    <li><a href="#" title="Случайно выбранная цитата">случайная</a></li>
                    <li><a href="#" title="Цитаты, бережно отобранные админами сайта">лучшие</a></li>
                    <li><a href="#" title="Цитаты, набравшие наибольшее количество плюсов">по рейтингу</a></li>
                    <li><a href="/newpost.php" title="Есть интересная история? Присылай!">добавить</a></li>
                    <li><a href="/garaj.php" title="Все цитаты, добавленные на сайт">Бездна</a></li>
                    <li><a href="#" title="Лучшие цитаты, добавленные вами">топ Бездны</a></li>
                </ul>
            </nav>
            <!--end MAIN NAVIGATION BLOCK-->
        </header>
<?php include("functions.php");?>
    <!--end HEADER BLOCK-->