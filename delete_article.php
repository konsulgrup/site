<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
// Включить библиотеки функций для этого приложения
require_once('konsulgrup_fns.php'); 
session_start();

do_html_header('Удаление статья');
if (check_admin_user()) {
  if (isset($_POST['id'])) {
    $id = $_POST['id'];
    if (delete_article($id)) {
      echo 'Статья удалена.<br />';
    } else {
      echo 'Статья не может быть удалена.<br />';
    }
  } else {
    echo 'Для удаления статьи необходимо ввести ее id.' .
         ' Пожалуйста, повторите попытку.<br />';
  }
  do_html_url('admin.php', 'Назад в меню администрирования');
} else {
  echo 'Вам не разрешен доступ на эту страницу.';
}

do_html_footer();

?>