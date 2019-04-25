<?php

// Включить файлы функций для этого приложения
require_once('konsulgrup_fns.php');
session_start();

// Начать html-вывод
do_html_header('Добавление закладок');

check_valid_user();
display_add_news_form();

display_user_menu();
do_html_footer();

?>
