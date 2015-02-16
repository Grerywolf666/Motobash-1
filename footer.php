
    <nav class="bottom">
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
    <footer class="footer">
        <div class="wrapper">
            <div class="information">
                <p class="copyright">
                    Идея проекта: <strong>bash.org</strong><br/>
                    Реализация и плюшки: <a class="company" href="//www.motoviewer.ru/" target="_blank" title="Блог о мотоциклах">motoviewer.ru</a>
                </p>

                <p class="age">Использование сайта подразумевает, что вам есть 18 лет и вас уже можно.</p>

                <p class="contact-us">
                    <a href="/adv" title="Для рекламодателей">Информация для рекламодателей</a>.
                    По другим вопросам вам <a href="/contacts">сюды</a>.
                </p>
            </div>
        </div>
    </footer>
    <script src="scripts/script.js"></script>
</body>
</html>