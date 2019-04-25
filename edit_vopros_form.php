<?php

// Включить библиотеки функций для этого приложения
require_once('konsulgrup_fns.php'); 
session_start();

do_html_header('Редактирование вопроса');
if (check_admin_user()) {
  if ($voprosy = get_vopros($_GET['id'])) {	 
	display_vopros_form($voprosy);
  } else {
    echo 'Невозможно получить сведения о вопросе.<br />';
  }
  do_html_url('admin.php', 'Назад в меню администрирования');
} else {
  echo 'Вам не разрешен доступ в область администратора.';
}

do_html_footer();

?>
