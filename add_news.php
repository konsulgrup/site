<?php
 require_once('konsulgrup_fns.php');
 session_start();
 // Создать короткие имена переменных
 $news_header = $_POST['news_header'];
 $news_text = $_POST['news_text'];
 $news_date = $_POST['news_date'];
 
 do_html_header('Добавление новостей');

 try {
   check_valid_user();
   if (!filled_out($_POST)) {
     throw new Exception('Форма заполнена не полностью.');
   }

 
   // Попытаться добавить закладку
   add_news($news_header,$news_text,$news_date);
   echo 'Новость добавлена.';

   // Получить закладки, сохраненные данным пользователем
   if ($news_array = get_news())
     display_news($news_array);
  }
  catch (Exception $e) {
    echo $e->getMessage();
  }

  display_user_menu(); 
  do_html_footer();
?>
