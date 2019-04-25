<?php

// Включить библиотеки функций для этого приложения
require_once('konsulgrup_fns.php'); 
session_start();

do_html_header("Добавление новости");
if (check_admin_user()) { 
  if (filled_out($_POST)) {    
    $title = $_POST['title'];
	$date = $_POST['date'];
    $text = $_POST['text'];
	
    if(insert_news($title, $text, $date)) {
      echo "<p>Новость <em>".stripslashes($title)."</em> добавлена в базу данных.</p>";
    } else {
      echo "<p>Новость <em>".stripslashes($title).
           "</em> не может быть добавлена в базу данных.</p>";
    }
  } else {
    echo "<p>Вы заполнили не все поля формы. Пожалуйста, повторите попытку.</p>";
  }

  do_html_url('admin.php', 'Назад в меню администрирования');
} else {
  echo "<p>У вас нет прав для доступа на страницу администрирования.</p>"; 
}

do_html_footer();
?>
