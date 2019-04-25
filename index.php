<?
require_once("konsulgrup_fns.php");
session_start();
do_html_header("Помощь юриста");
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
display_landing_text();
?>
	</div>
<?
display_form_zayavka();
?>
</div>			
<? 
display_vygody(); 
display_sodeystvie();
do_html_footer();
?>
