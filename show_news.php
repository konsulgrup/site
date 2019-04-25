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

  $news = get_the_news($id);
  do_html_header($news['title']);


  // Установить URL для кнопки "Продолжить"
  $target = "index.php";
 
 if (check_admin_user()) {
    display_button("edit_news_form.php?id=" . $id, 
                   "edit-item", "Редактировать новость");
    display_button("admin.php", "admin-menu", "Меню администрирования");
    display_button($target, "continue", "Продолжить");
  } else {
$cat_array = get_categories();
display_categories($cat_array);		
$voprosy_array = get_voprosy();
display_voprosy_menu($voprosy_array);
$news_array = get_news();
display_news_menu($news_array);
?>	
<section class="landing">
<div class="landing-top">
<div class="landing-text">
<?
  display_the_news($news);
?>
	</div>
<?
display_form_zayavka();
?>
</div>			
<? 

  }

do_html_footer();
?>
