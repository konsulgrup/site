<?php

// Включить библиотеки функций для этого приложения
require_once('konsulgrup_fns.php'); 
session_start();

do_html_header("Добавление новости");
if (check_admin_user()) { 
  if (filled_out($_POST)) {    
    $vopros = $_POST['vopros'];
	$otvet = $_POST['otvet'];
    $name = $_POST['name'];
	
    if(insert_vopros($vopros, $otvet, $name)) {
      echo "<p>Вопрос <em>".stripslashes($title)."</em> добавлен в базу данных.</p>";
    } else {
      echo "<p>Вопрос <em>".stripslashes($title).
           "</em> не может быть добавлен в базу данных.</p>";
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
