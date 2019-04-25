<?
function login($username, $password) {
  // ѕровер¤ет, записаны ли в базе данных переданные им¤ пользовател¤ и пароль.
  // ≈сли это так, возвращает значение true, в противном случае -- false.

  // ѕодключитьс¤ к базе данных
  $conn = db_connect();
  if (!$conn) {
    return 0;
  }

  // ѕроверить уникальность имени пользовател¤
  $result = $conn->query("select * from admin 
                         where username='$username'
                         and password = sha1('$password')");
  if (!$result) {
    return 0;
  }
  
  if ($result->num_rows > 0) {
    return 1;
  } else {
    return 0;
  }
}

function check_valid_user() {
  // Определяет, вошел ли пользователь в систему и, 
  // если нет, выводит соответствующее уведомление

  global $valid_user;
  if (isset($_SESSION['valid_user'])) {
    echo 'Вы вошли в систему под именем '
      .stripslashes($_SESSION['valid_user']).'.';
    echo "<br />";
  } else {
    // Пользователь не вошел в систему
    do_html_heading("Проблема:");
    echo "Вы не вошли в систему.<br />";
    do_html_url('login.php', 'Вход');
    do_html_footer();
    exit;
  }
}
function check_admin_user() {
  // ѕровер¤ет, вошел ли посетитель, и уведомл¤ет, если нет
  if (isset($_SESSION['admin_user'])) {
    return true;
  } else {
    return false;
  }
}