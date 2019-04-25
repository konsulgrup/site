<?
//categories
function display_category_form($category = '') {
// Отображает форму для ввода категории.
// Эта форма используется для добавления и редактирования категорий.
// Для добавления новой категории вызывайте функцию без параметров. В результате
// $edit примет значение false и форма обратится к insert_category.php.
// Для обновления информации о категории передайте в качестве параметра массив,
// содержащий категорию. Форма заполнится существующими данными и обратится к
// update_category.php. В этом случае также добавится кнопка удаления категории.

  // Если передается существующая категория, продолжить в "режиме редактирования"
  $edit = is_array($category); 
  // Большинство формы представляет собой простой HTML-код с несколькими
  // дополнительными PHP-операторами
?>
  <form method="post" action="<?php
    echo $edit ? 'edit_category.php' : 'insert_category.php';
  ?>"> 
  <table border=0>
  <tr>
    <td>Наименование категории:</td>
    <td><input type="text" name="catname" size=40 maxlength=40 value="<?php
      echo $edit ? $category['catname'] : '';
    ?>"></td>
  </tr>
  <tr>
    <td <?php if (!$edit) echo "colspan=2"; ?> align="center">
      <?php if ($edit)
        echo '<input type="hidden" name="catid" value="' .
             $category['catid'] . '">';
      ?>
      <input type="submit" value="<?php
        echo $edit ? 'Обновить' : 'Добавить';
      ?> категорию"></form>
    </td>
    <?php if ($edit) {
      // Разрешить удаление существующих категорий 
          echo '<td>';
          echo '<form method="post" action="delete_category.php">';
          echo '<input type="hidden" name="catid" value="'.$category['catid'].'">';
          echo '<input type="submit" value="Удалить категорию">';
          echo '</form></td>';
    } ?>
  </tr>
  </table>
<?php
}
function insert_category($catname){
   $conn = db_connect();

   // Проверить, не существует ли уже такая категория
   $query = "select *
             from categories
             where catname='$catname'";
   $result = $conn->query($query);
   if (!$result || $result->num_rows!=0)
     return false;  

   // Добавить новую категорию 
   $query = "insert into categories values
            ('', '$catname')"; 
   $result = $conn->query($query);
   if (!$result)
     return false;
   else
     return true;
}
function update_category($catid, $catname){
   $conn = db_connect();
   $query = "update categories
             set catname='$catname'
             where catid='$catid'";
   $result = @$conn->query($query);
   if (!$result)
     return false;
   else
     return true; 
}
function delete_category($catid){
   $conn = db_connect();
   
   // Проверить, есть ли книги в категории, 
   // во избежание аномалий удаления 
   $query = "select *
             from articles
             where catid='$catid'";
   $result = @$conn->query($query);
   if (!$result || @$result->num_rows>0)
     return false;

   $query = "delete from categories 
             where catid='$catid'";
   $result = @$conn->query($query);
   if (!$result)
     return false;
   else
     return true; 
}
//articles
function display_article_form($article = '') {
  $edit = is_array($article);
// echo "edit is $edit";
?>
  <form method="post" action="<?php
    echo $edit ? 'edit_article.php' : 'insert_article.php';
  ?>">
  <table border="0">
   <tr>
      <td>Название:</td>
      <td><input type="text" name="title" value="<?php
        echo $edit ? $article['title'] : '';
      ?>" /></td>
    </tr>
    <tr>
      <td>Описание:</td>
      <td><textarea rows="5" cols="100" name="descript" maxlength="200"><?php echo $edit ? $article['descript'] : ''; ?></textarea></td>
    </tr>
    <tr>
      <td>Категория:</td>
      <td>
        <select name="catid">
          <?php
            // Прочитать из базы данных список возможных категорий
            $cat_array = get_categories();
            foreach ($cat_array as $thiscat) {
              echo "<option value=\"".$thiscat['catid']."\"";
              // Если книга существует, поместить ее в текущую категорию
              if (($edit) && ($thiscat['catid'] == $article['catid'])) {
                echo " selected";
              }
              echo ">".$thiscat['catname']."</option>";
            }
          ?>
        </select>
      </td>
    </tr>
    
    <tr>
      <td>Текст:</td>
		 
      <td><textarea rows="20" cols="100" name="text"><?php echo $edit ? $article['text'] : ''; ?></textarea></td>
    </tr>
    <tr>
      <td <?php 
if (!$edit) { echo "colspan=2"; }?> align="center">
 
        <input type="submit" value="<?php
          echo $edit ? 'Обновить':'Добавить';
        ?> статью " />
	  <input type="hidden" name="id"
                  value="<? echo $article['id'] ?>"; /></form>
      </td>
        <?php 
          if ($edit) {  
            echo "<td>
                  <form method=\"post\" action=\"delete_article.php\">
                  <input type=\"hidden\" name=\"id\"
                  value=\"".$article['id']."\" />
                  <input type=\"submit\" value=\"Удалить статью\"/>
                  </form></td>";
          }
        ?>
      </td>
    </tr>
  </table>
  
<?php
}
function insert_article($title, $descript, $catid, $text){
   $conn = db_connect();

   /* Проверить, не существует ли уже такая книга
   $query = "select *
             from articles 
             where id='$id'";

   $result = $conn->query($query);
   if (!$result || $result->num_rows!=0)
     return false;
 */
   // Добавить новую книгу
   $query = "insert into articles values
            ('', '$title', '$descript', '$catid', '$text')";
  
   $result = $conn->query($query);
   if (!$result)
     return false;
   else
     return true;
}
function update_article($id,$title, $descript, $catid, $text){
   $conn = db_connect();
//echo "ooo id is $id, title is $title, descript is $descript, catid is $catid, text is $text </br>";
   $query = "update articles
             set title ='$title',
             descript = '$descript',
             catid = '$catid',
             text = '$text'
             where id='$id'";

 
	$result = $conn->query($query);

   if (!$result) {  
   
	   return false;
   }
   else
     return true; 
}
function delete_article($id){
   $conn = db_connect();

   $query = "delete from articles
             where id='$id'";
   $result = $conn->query($query);
	
   if (!$result)
     return false;
   else
     return true;
}

function display_news_form($news = '') {

  $edit = is_array($news);

?>
  <form method="post" action="<?php
    echo $edit ? 'edit_news.php' : 'insert_news.php';
  ?>">
  <table border="0">
   <tr>
      <td>Название:</td>
      <td><input type="text" name="title" value="<?php
        echo $edit ? $news['title'] : '';
      ?>" /></td>
    </tr> 
    
    <tr>
      <td>Текст:</td>
		 
      <td><textarea rows="5" cols="100" name="text"><?php echo $edit ? $news['text'] : ''; ?></textarea></td>
    </tr>
	<tr>
      <td>Дата:</td>
      <td><input type="text" name="date" value="<?php
        echo $edit ? $news['date'] : '';
      ?>" class="date" /></td>
    </tr>   
    <tr>
      <td <?php if (!$edit) { echo "colspan=2"; }?> align="center">
 
        <input type="submit" value="<?php
          echo $edit ? 'Обновить':'Добавить';
        ?> новость " />
      </td>
        <?php 
          if ($edit) {  
            echo "<td>
                  <form method=\"post\" action=\"delete_news.php\">
                  <input type=\"hidden\" name=\"id\"
                  value=\"".$news['id']."\" />
                  <input type=\"submit\" value=\"Удалить новость\"/>
                  </form></td>";
          }
        ?>
      </td>
    </tr>
  </table>
  </form>
<?php
}
function insert_news($title, $text, $date){
   $conn = db_connect();

   /* Проверить, не существует ли уже такая книга
   $query = "select *
             from articles 
             where id='$id'";

   $result = $conn->query($query);
   if (!$result || $result->num_rows!=0)
     return false;
 */
   // Добавить новую книгу
  
$query = "insert into news values
            ('', '$title', '$text', '$date')";
  
   $result = $conn->query($query);
   if (!$result)
     return false;
   else
     return true;
}
function update_news($id,$title, $text, $date){
   $conn = db_connect();

   $query = "update news
             set title ='$title',
             text = '$text',
             date = '$date'
             where id='$id'";

   $result = @$conn->query($query);
   if (!$result)
     return false;
   else
     return true; 
}
function delete_news($id){
   $conn = db_connect();

   $query = "delete from news
             where id='$id'";
   $result = @$conn->query($query);
   if (!$result)
     return false;
   else
     return true;
}

function display_vopros_form($vopros = '') { 
  $edit = is_array($vopros); 
?>
  <form method="post" action="<?php
    echo $edit ? 'edit_vopros.php' : 'insert_vopros.php';
  ?>">
  <table border="0">
   <tr>
	   <td>Вопрос:</td>
     <td><textarea rows="10" cols="100" name="vopros"><?php echo $edit ? $vopros['vopros'] : ''; ?></textarea></td>
    </tr>     
    <tr>
      <td>Ответ:</td>
		 
      <td><textarea rows="5" cols="100" name="otvet"><?php echo $edit ? $vopros['otvet'] : ''; ?></textarea></td>
    </tr>
	<tr>
      <td>Имя:</td>
      <td><input type="text" name="name" value="<?php
        echo $edit ? $vopros['name'] : '';
      ?>" /></td>
    </tr>   
    <tr>
      <td <?php if (!$edit) { echo "colspan=2"; }?> align="center">
 
        <input type="submit" value="<?php
          echo $edit ? 'Обновить':'Добавить';
        ?> вопрос" />
      </form></td>
        <?php 
          if ($edit) {  
            echo "<td>
                  <form method=\"post\" action=\"delete_vopros.php\">
                  <input type=\"hidden\" name=\"id\"
                  value=\"".$vopros['id']."\" />
                  <input type=\"submit\" value=\"Удалить вопрос\"/>
                  </form></td>";
          }
        ?>
      </td>
    </tr>
  </table>
  
<?php
}
function insert_vopros($vopros, $otvet, $name){
   $conn = db_connect();

   /* Проверить, не существует ли уже такая книга
   $query = "select *
             from articles 
             where id='$id'";

   $result = $conn->query($query);
   if (!$result || $result->num_rows!=0)
     return false;
 */
   // Добавить новую книгу
  
$query = "insert into voprosy values
            ('', '$vopros', '$otvet', '$name')";
  
   $result = $conn->query($query);
   if (!$result)
     return false;
   else
     return true;
}
function update_vopros($id,$vopros, $otvet, $name){
   $conn = db_connect();

   $query = "update voprosy
             set vopros ='$vopros',
             otvet = '$otvet',
             name = '$name'
             where id='$id'";

   $result = @$conn->query($query);
   if (!$result)
     return false;
   else
     return true; 
}
function delete_vopros($id){
   $conn = db_connect();

   $query = "delete from voprosy
             where id='$id'";
   $result = @$conn->query($query);
   if (!$result)
     return false;
   else
     return true;
}
