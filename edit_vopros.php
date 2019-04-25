<?php

// Включить библиотеки функций для этого приложения
require_once('konsulgrup_fns.php'); 
session_start();

do_html_header('Обновление вопроса');
if (check_admin_user()) { 
  if (filled_out($_POST)) {
	$id=$_POST['id'];
    $vopros = $_POST['vopros'];
    $otvet = $_POST['otvet'];
	$name = $_POST['name'];  
    if (update_vopros($id,$vopros, $otvet,$name)) {
      echo 'Вопрос  обновлен.<br />';
    } else {
      echo 'Невозможно обновить вопрос.<br />';
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
