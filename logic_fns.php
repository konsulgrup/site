<?
function get_news() {
  // Извлекает из базы данных все сохраненные пользователем URL-адреса
  $conn = db_connect();
if ($_SERVER['REQUEST_URI']!="/show_all_news.php"){   
$result = $conn->query( "select * from news order by date desc limit 3");}
	else {
		$result = $conn->query( "select *
                           from news order by date desc");}
	
 if (!$result) {
    return false;
  }
  $num_cats = $result->num_rows;
  if ($num_cats == 0) {
    return false;
  }
  $result = db_result_to_array($result);
  return $result; 
};
function get_the_news($id) {
  // Выполняет запрос в базу данных детальной информации о книге
  if (!$id || $id == '') {
    return false;
	 
  }
  $conn = db_connect();
  $query = "select * from news where id='".$id."'";
  $result = @$conn->query($query);
  if (!$result) {
	return false;
  }
  $result = @$result->fetch_assoc();

  return $result;
}
function get_categories() {
  // Эапросить в базе данных список категорий
  $conn = db_connect();
  $query = 'select catid, catname from categories'; 
  $result = @$conn->query($query);
  if (!$result) {
    return false;
  }
  $num_cats = $result->num_rows;
  if ($num_cats == 0) {
    return false;
  }
  $result = db_result_to_array($result);
  return $result; 
}
function get_category_name($catid) {
  // Запросить в базе данных имя категории для данного идентификатора категории
  $catid = intval($catid);
  $conn = db_connect();
  $query = "select catname from categories where catid='".$catid."'";
  $result = $conn->query($query);
  if (!$result) {
    return false;
  }
  $num_cats = $result->num_rows;
  if ($num_cats == 0) {
    return false;
  }
  $row = $result->fetch_object();
  return $row->catname;
}
function get_articles($catid) {
  // Выполняет запрос в базу данных книг определенной категории
  if (!$catid || $catid=='') {
    return false;
  }
  $conn = db_connect();
  $query = "select * from articles where catid='".$catid."'";
  $result = @$conn->query($query);
  if (!$result) {
    return false;
  }
  $num_articles = @$result->num_rows;
  if ($num_articles == 0) {
    return false;
  }
  $result = db_result_to_array($result);
  return $result;
}
function get_the_article($id) {
  // Выполняет запрос в базу данных детальной информации о книге
  if (!$id || $id == '') {
    return false;
	 
  }
  $conn = db_connect();
  $query = "select * from articles where id='".$id."'";
  $result = @$conn->query($query);
  if (!$result) {
	return false;
  }
  $result = @$result->fetch_assoc();

  return $result;
}
function get_voprosy() {
  // Извлекает из базы данных все сохраненные пользователем URL-адреса
  $conn = db_connect();
if ($_SERVER['REQUEST_URI']!="/show_all_voprosy.php"){   
$result = $conn->query( "select * from voprosy limit 3");}
	else {
		$result = $conn->query( "select *
                           from voprosy");
	}
	
 if (!$result) {
    return false;
  }
  $num_cats = $result->num_rows;
  if ($num_cats == 0) {

	  return false;
  }
  $result = db_result_to_array($result);

  return $result; 
};
function get_vopros($id) {
  // Выполняет запрос в базу данных детальной информации о книге
  if (!$id || $id == '') {
    return false;
	 
  }
  $conn = db_connect();
  $query = "select * from voprosy where id='".$id."'";
  $result = @$conn->query($query);
  if (!$result) {
	return false;
  }
  $result = @$result->fetch_assoc();

  return $result;
}
?>