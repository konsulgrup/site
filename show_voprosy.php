<?
require_once("konsulgrup_fns.php");
session_start();
do_html_header("Отвечают наши юристы. КонсулГрупп.ру");
/* 
  if(isset($_SESSION['admin_user'])) {
    display_button("admin.php", "admin-menu", "Меню администрирования");
  }
*/
  if(isset($_SESSION['admin_user'])) {
    display_button("index.php", "continue", "Вернуться на главную страницу");
    display_button("admin.php", "admin-menu", "Меню администрирования");
    display_button("edit_category_form.php?catid=" . $catid, 
      "edit-category", "Редактировать категорию");
  } else {
$cat_array = get_categories();
display_categories($cat_array);		
$voprosy_array = get_voprosy();
display_voprosy_menu($voprosy_array);
$news_array = get_news();
display_news_menu($news_array);
  }

?>	
<section class="landing">
<div class="landing-top">
<div class="landing-text">
<?
$voprosy_array = get_voprosy();
display_voprosy($voprosy_array);	
?>
</div>
	<?
if(empty($_SESSION['admin_user'])) {
	display_form_zayavka();
}
	?>
</div>			
<? 

do_html_footer();
?>
