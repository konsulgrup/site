<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
// Включить библиотеки функций для этого приложения
require_once('konsulgrup_fns.php'); 
session_start();

do_html_header('Обновление сведений о статье');
if (check_admin_user()) { 
  if (filled_out($_POST)) {
	$id=$_POST['id'];
    $title = $_POST['title'];
    $descript = $_POST['descript'];
    $catid = $_POST['catid'];
    $text = $_POST['text'];
	  $isbn = $_POST['isbn'];

    if (update_article($id,$title,$isbn, $descript, $catid, $text)) {
      echo 'Сведения о статье обновлены.<br />';
    } else {
      echo 'Невозможно обновить сведения о статье.<br />';
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
