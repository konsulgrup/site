<?php

// Включить библиотеки функций для этого приложения
require_once('konsulgrup_fns.php'); 
session_start();

do_html_header('Обновление сведений о новости');
if (check_admin_user()) { 
  if (filled_out($_POST)) {
	$id=$_POST['id'];
    $title = $_POST['title'];
    $text = $_POST['text'];
	$date = $_POST['date'];  	  
    if (update_news($id,$title, $text,$date)) {
      echo 'Сведения о статье обновлены.<br />';
    } else {
      echo 'Невозможно обновить новость.<br />';
    }
  } else {
    echo 'Вы ввели не все данные.  Пожалуйста, повторите попытку.';
  }
  do_html_url('admin.php', 'Назад в меню администрирования');
} else {
  echo 'Вам не разрешен доступ на эту страницу.';
}

do_html_footer();

?>
