<?php

// Включить библиотеки функций для этого приложения
require_once('konsulgrup_fns.php'); 
session_start();

if ($_POST['username'] && $_POST['passwd']) {
  // Пользователь только что попытался войти в систему
  $username = $_POST['username'];
  $passwd = $_POST['passwd'];

  if (login($username, $passwd)) {
    // Если пользователь записан в базе данных, зарегистрировать его идентификатор
    $_SESSION['admin_user'] = $username;
  } else {
    // Неудачный вход в систему
    do_html_header('Проблема:');
    echo "<p>Вход в систему невозможен.<br />
          Для просмотра этой страницы необходимо войти в систему.</p>";
    do_html_url("login.php", "Вход");
    do_html_footer();
    exit;
  }      
}

do_html_header("Администрирование");
if (check_admin_user()) {
  display_admin_menu();
} else {
  echo "<p>У вас нет прав для доступа на страницу администрирования.</p>";
}

do_html_footer();
?>
