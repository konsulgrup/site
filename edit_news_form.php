<?php

// Включить библиотеки функций для этого приложения
require_once('konsulgrup_fns.php'); 
session_start();

do_html_header('Редактирование статьи');
if (check_admin_user()) {
  if ($news = get_the_news($_GET['id'])) {
    display_news_form($news);
  } else {
    echo 'Невозможно получить сведения о статье.<br />';
  }
  do_html_url('admin.php', 'Назад в меню администрирования');
} else {
  echo 'Вам не разрешен доступ в область администратора.';
}

do_html_footer();

?>
