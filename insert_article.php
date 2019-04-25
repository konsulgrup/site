<?php

// Включить библиотеки функций для этого приложения
require_once('konsulgrup_fns.php'); 
session_start();

do_html_header("Добавление статьи");
if (check_admin_user()) { 
  if (filled_out($_POST)) {    
    $title = $_POST['title'];
    $descript = $_POST['descript'];
    $catid = $_POST['catid'];
    $text = $_POST['text'];


    if(insert_article($title, $descript, $catid, $text)) {
      echo "<p>Статья <em>".stripslashes($title)."</em> добавлена в базу данных.</p>";
    } else {
echo "<p>Статья <em>".stripslashes($title).
           "</em> не может быть добавлена в базу данных.</p>";
    }
  } else {
    echo "<p>Вы заполнили не все поля формы. Пожалуйста, повторите попытку.</p>";
echo "title is ".$_POST['title']."<br />";      
echo "descript is ".$_POST['descript']."<br />";      
echo "catid is ".$_POST['catid']."<br />";      
echo "text is ".$_POST['text']."<br />";      
  }

  do_html_url('admin.php', 'Назад в меню администрирования');
} else {
  echo "<p>У вас нет прав для доступа на страницу администрирования.</p>"; 
}

do_html_footer();
?>
