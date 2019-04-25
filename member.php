<?php
require_once('konsulgrup_fns.php');
session_start();
// Создать короткие имена переменных
$username = $_POST['username'];
$passwd = $_POST['passwd'];

if ($username && $passwd) {
// Пользователь только что попытался войти в систему
  try {
    login($username, $passwd);
    // Если пользователь записан в базе данных, 
    // зарегистрировать его идентификатор
    $_SESSION['valid_user'] = $username;
  }
  catch (Exception $e) {
    // Неудачный вход в систему
    do_html_header('Проблема:');
    //echo 'Вход в систему невозможен.Для просмотра этой страница необходимо войти в систему.';
	  echo $e->getMessage();
    do_html_url('login.php', 'Вход');
    do_html_footer();
    exit;
  }      
} 
do_html_header('Домашняя страница');
check_valid_user();
/*if ($url_array = get_user_urls($_SESSION['valid_user'])) {
  display_user_urls($url_array);
}
*/
// Вывести меню опций
display_user_menu();

do_html_footer();
?>