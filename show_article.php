<?
require_once("konsulgrup_fns.php");
session_start();
/* 
  if(isset($_SESSION['admin_user'])) {
    display_button("admin.php", "admin-menu", "Меню администрирования");
  }
*/
 $id = $_GET['id'];

  // Извлечь из базы данных информацию о конкретной статье
$article = get_the_article($id);
 do_html_header($article['title']);

  // Установить URL для кнопки "Продолжить"
  $target = "index.php";
  if ($article['catid']) {
    $target = "show_cat.php?catid=".$article['catid'];
  }
 if (check_admin_user()) {
    display_button("edit_article_form.php?id=" . $id, 
                   "edit-item", "Редактировать статью");
    display_button("admin.php", "admin-menu", "Меню администрирования");
    display_button($target, "continue", "Продолжить");
  } else {
$cat_array = get_categories();
display_categories($cat_array);		
$voprosy_array = get_voprosy();
display_voprosy_menu($voprosy_array);
$news_array = get_news();
display_news_menu($news_array);
  
//display_form_toggle();
	 display_form_zayavka();
 




  }
 display_the_article($article);
do_html_footer();
?>
