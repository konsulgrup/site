<?php
function do_html_header($title){
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo $title;?></title>
<link rel="icon" type="image/png" href="img/favicon.png" />
<link href="css/normalize.css" rel="stylesheet" type="text/css">
<link href="css/jquery-ui.min.css" rel="stylesheet" type="text/css">
<link href="css/base.css" rel="stylesheet" type="text/css">
<script src="js/jquery-2.2.3.min.js"></script>
<script src="js/jquery-ui.min.js"></script>
<script src="js/jquery.validate.min.js"></script>
<script src="js/mobileRU.js"></script>
	</head>

<body >
	<div class=container>
	<header>
		<div class=banner>			
			<a href="index.php"><div class=home></div></a>
			<div class=logo>		
				<p>консул·групп</p>
				<p>юридические услуги</p>
			</div>	
			<span class=kontakt>
				Горячая линия <a href="tel:+74991131120"><p>(499)113-112-0</p></a> пн-сб 9:00 - 21:00
			</span>
						
		</div>
	</header>
<main>
		<?php 
								/*if($title) {
	do_html_heading($title);
	}*/
} //end of do_html_header
function do_html_footer() {
  // Вывести нижний колонтитул HTML
?> 
		</main>
	<footer>
		<p>Консул-Групп.Все права защищены. 2008</p>	
		<?
		  if(isset($_SESSION['admin_user'])) {
    display_button("admin.php", "admin-menu", "Меню администрирования");			  
  } ?>
	</footer>
</div> <!-- container -->
<script>

$(document).ready(function(){
	$('.form-toggle a').click(function(){
		//var checkedValue = $('.form-div').css('display');
		//$('.form-div').show();
		$(".form-div").toggle();
	});
	$('.landing-text').tabs({
		show: 'fade',
  	hide: 'fade'
	});
	$(".date").datepicker({
	dateFormat:'yy-mm-dd'
	});
	$("#hello").dialog({
		autoOpen: false,
		position: { my: "center top", at: "center top", of: 'main' }
	});
	$("#phone").addClass('required');
	var validator = $('#zayavka').validate({
		rules: {
			name: {
				required:true,				
				minlength:2
			},	
			email:{				
				email:true
			},
			phone: {
				mobileRU:true
			},
			text:{
				required:true,
				minlength:20
			}
			},
		messages:{
			name:{
				required:"Пожалуйста, введите Ваше имя",
				minlength:"Имя не может состоять из одного символа"
			},
			email:{
				required:"Введите адрес электронной почты"
			},
			phone:{
				required:"Ввведите телефон в формате +7ХХХХХХХ"
			},
			text: {
				required:"Вы не описали проблему!",
				minlength:"Описание слишком короткое"
			}
			}
	}); //end of validate
	//$('input:first').focus();
	$('#zayavka').buttonset();
	$("#email").hide();	
	$('input[name="back"]').change(function(){
		validator.resetForm();
		var checkedValue = $('input[name="back"]:checked').val();
		if(checkedValue == 'phone') {
			$("#email").hide().removeClass('required');;
			$("#phone").show().addClass('required');
		} else {
			$("#phone").hide().removeClass('required');
			$("#email").show().addClass('required');
		}
	}) //end radio change
	$('#zayavka').submit(function(event){	
		event.preventDefault();	
		if (validator.form()) {
		var name = $("#name").val();
		var phone = $("#phone").val();
		var email = $("#email").val();
		var msg = $("#msg").val();
		$(".form-message").load("test.php",{
			name:name,
			email:email,
			phone:phone,
			msg:msg
		}) //end of load
	$("input[type=text], textarea").val("");
		$("#hello").dialog('open');
	
		} //end of if
}) //end form submit

}); //end of ready
		
</script>

	<!-- Yandex.Metrika counter -->
<script type="text/javascript" >
   (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
   m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
   (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

   ym(51194930, "init", {
        clickmap:true,
        trackLinks:true,
        accurateTrackBounce:true,
        webvisor:true
   });
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/51194930" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
	<div id="hello" title="Запрос получен!">
				<p>Ответ на Ваш запрос Вы получите в течение ближайшего часа.</p>
			</div> <!-- hello -->

</body>
</html>
<?php
}
function do_html_heading($heading) {
  // Вывести верхний колонтитул HTML
?>
  <h2><?php echo $heading;?></h2>
<?php
}
function do_html_URL($url, $name) {
  // Вывести URL-адрес в виде ссылки и дескриптор новой строки
?>
  <a href="<?php echo $url;?>"><?php echo $name;?></a>
<?php
}
function display_user_menu() {
?>
  <br />
  <a href="member.php">Главная</a>&nbsp;|&nbsp;
  <a href="add_news_form.php">Добавить новость</a>&nbsp;|&nbsp; 
<?php
  // Опция удаления будет только тогда, когда на странице выведена таблица закладок
  global $bm_table;
  if($bm_table == true)
    echo "<a href='#' onClick='bm_table.submit();'>Удалить закладку</a>&nbsp;|&nbsp;"; 
  else
    echo "<font color='#cccccc'>Удалить закладку</font>&nbsp;|&nbsp;"; 
?>
  <a href="logout.php">Выход</a> 
  <hr />
<?php
}
function display_add_news_form() {
  // Отображает форму для ввода новой новости
?>
  <form name="news_table" action="add_news.php" method="post">
  <table cellpadding=2 cellspacing=0 bgcolor="#cccccc">
    <tr>
      Заголовок новости:
	  </tr>
	  <tr>
        <input type="text" name="news_header" value="" size=30 maxlength=255>
      </tr>		
	<tr>
		  Текст новости:
	</tr>
	<tr>		  
		<textarea name="news_text"></textarea>
	</tr>
<tr>
      Дата:
      </tr>
	  <tr>
        <input type="text" name="news_date" value="" size=10 maxlength=10>
      </tr>
    <tr>
              <input type="submit" value="Добавить новость">
          </tr>
  </table>
  </form>
<?php
}
function display_categories($cat_array) {
   
	if (!is_array($cat_array)) {
    echo "В настоящий момент нет доступных категорий<br />";
    return;
  }
echo "<aside>";
echo "<nav>";  
echo "<ul>";
  foreach ($cat_array as $row) {
	  if(empty($_SESSION['admin_user'])&&empty($skip))  {
   	$skip=true;
	continue;
	  }
	$url = "show_cat.php?catid=".($row['catid']);
    $title = $row['catname']; 
    echo "<li>";
    do_html_url($url, $title); 
    echo "</li>";
  }    
  echo "</ul>";
	echo "</nav>";
  
}
function display_form_toggle(){
	?>

<?
}
function display_form_zayavka(){
	?>
<div class="form-toggle"><a href="#">Задать вопрос онлайн</a>	</div>
<form class="form-div" id="zayavka" method="post" action="test.php">	
			
	<p>Опишите проблему! Наши юристы ответят Вам <u>в течение часа</u>. Для связи необходимо оставить адрес Вашей <u>электронной почты</u> или контактный <u>телефон</u>. Либо Вы всегда можете позвонить нам по номеру: <strong>8(499)113-112-0</strong> </p>
			<input id="name" name="name" type="text" class="feedback-input" placeholder="Имя"/>  
			Выберите способ связи:<br />
			<input id="p" name="back" type="radio" value="phone" checked="checked" ><label for="p">Телефон</label>
			<input id="m" name="back" type="radio" value="email"><label for="m">Эл.почта</label>
			<input id="email" name="email" type="text" class="feedback-input email" placeholder="ваш@почтовый.ящик"/>     
			<input id="phone" name="phone" type="text" class="feedback-input" placeholder="Телефон"/>
			<textarea id="msg" name="text" class="feedback-input" placeholder="Суть проблемы..."></textarea>			
			<input type="submit" value="ОТПРАВИТЬ" id="button-blue"/>
			<p class="form-message"></p>
			<div class="ease"></div>
		</form>


<?
}
function display_vygody() {
	?>


<div class=vygody><p>Обратившись к нам Вам обеспечены</p>
				<figure><img src="img/vyg_eco.png"><figcaption>Экономия <br />Вам не придется платить дважды. Наш опыт позволит привести траты к минимуму</figcaption></figure>
				<figure><img src="img/vyg_rez.png"><figcaption>Результат<br /> Более 1500 положительных решений по суду</figcaption></figure>
				<figure><img src="img/vyg_prof.png"><figcaption>Профессионализм<br /> Команда опытных юристов, готовых решать вопросы любой сложности</figcaption></figure>
				<figure><img src="img/vyg_rep.png"><figcaption>Репутация<br /> Наша цель - ваши рекомендации</figcaption></figure>		
			</div> <!-- vygody-->

<?
}
function display_sodeystvie() {
	?>
<div class=sodeystvie><p>Проект реализован при содействии</p>
				<figure><img src="img/gerb_yusticii.png"><figcaption>Министерства юстиции Российской Федерации</figcaption></figure>
				<figure><img src="img/gerb_potrnadz.png"><figcaption>Роспотребнадзора Российской Федерации</figcaption></figure>
				<figure><img src="img/gerb_moskvy.png"><figcaption>Правительства Москвы</figcaption></figure>
				<figure><img src="img/gerb_nalog.png"><figcaption>Федеральной налоговой службы</figcaption></figure>			
			</div>	<!-- sodeystvie -->
</section> <!-- landing -->
<?
}
function display_main_part() {
	?>
<section class="landing">
<div class="landing-top">
<div class="landing-text">
	<ul>
				  <li><a href="#panel1">О нас</a></li>
				  <li><a href="#panel2">Цены</a></li>
				  <li><a href="#panel3">Наши победы</a></li>
				  </ul>
	<div id="panel1">
		  <img src="img/lawyer.jpg" width="200" height="200" alt=""/>
			<p>Дорогие друзья, мы рады приветсвовать вас на нашем сайте! </p><p> Юридическое бюро КонсулГрупп создано для того чтобы помочь вам решить проблемы в области права. </p><p>За 20 лет работы в сфере юридических услуг наши специлаисты стали настоящими профессионалами. Результат такого подхода - успешные решения по сотням дел различных областей и направлений.  </p>
			<p>Мы ценим наших клиентов, ведь отличная репутация - наша главная цель! Доверьте нам решение ваших проблем!</p>
			<p>Генеральный директор ООО "Консул-групп"</p>
			<p>Хмельницкая Елена</p>
	</div> <!-- panel1-->
	<div id="panel2">
		  
	<table class="inventory" width="100%">
		
		<colgroup>
			<col id="product">
			<col id="price">
		
		</colgroup>
		<tr>
			<th scope="col">Услуга</th>
			<th scope="col">Стоимость</th>
	
		</tr>
		<tr>
			<td> Vitae Quam Lorem</td>
			<td>$19.95</td>
			
		</tr>
		<tr>
			<td> In Tempus Velit</td>
			<td>$14.55</td>
			
		</tr>
		<tr>
			<td>Lorem Ipsum Dolor Sat</td>
			<td>Priceless</td>
			
		</tr>
		<tr>
			<td>Quis Felis Fringilla</td>
			<td>$29.95</td>
			
		</tr>
		<tr>
			<td>Nunc Sem Pharetra</td>
			<td>$75.99</td>
			
		</tr>
		<tr>
			<td>Vel Faucibus Elit</td>
			<td>$82.00</td>
			
		</tr>
		<tr>
			<td> Non Adipiscing Vitae</td>
			<td>$1.95</td>
			
		</tr>
		<tr>
			<td>Aenean Orci Ante</td>
			<td>$17.95</td>
			
		<tr>
			<td>Venenatis Non Adipiscing</td>
			<td>$44.00</td>
			
		</tr>
	</table>
	</div> <!-- panel2-->
	<div id="panel3">
		<br />
<!-- Images used to open the lightbox -->
<div class="row">
  <div class="column">
    <img src="img/img1.jpg" onclick="openModal();currentSlide(1)" class="hover-shadow">
  </div>
  <div class="column">
    <img src="img/img2.jpg" onclick="openModal();currentSlide(2)" class="hover-shadow">
  </div>
  <div class="column">
    <img src="img/img3.jpg" onclick="openModal();currentSlide(3)" class="hover-shadow">
  </div>
  <div class="column">
    <img src="img/img4.jpg" onclick="openModal();currentSlide(4)" class="hover-shadow">
  </div>
</div>

<!-- The Modal/Lightbox -->
<div id="myModal" class="modal">
  <span class="close cursor" onclick="closeModal()">&times;</span>
  <div class="modal-content">

    <div class="mySlides">
      <div class="numbertext">1 / 4</div>
      <img src="img/img1_wide.jpg" style="width:100%">
    </div>

    <div class="mySlides">
      <div class="numbertext">2 / 4</div>
      <img src="img/img2_wide.jpg" style="width:100%">
    </div>

    <div class="mySlides">
      <div class="numbertext">3 / 4</div>
      <img src="img/img3_wide.jpg" style="width:100%">
    </div>

    <div class="mySlides">
      <div class="numbertext">4 / 4</div>
      <img src="img/img4_wide.jpg" style="width:100%">
    </div>

    <!-- Next/previous controls -->
    <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
    <a class="next" onclick="plusSlides(1)">&#10095;</a>

    <!-- Caption text -->
    <div class="caption-container">
      <p id="caption"></p>
    </div>

    <!-- Thumbnail image controls -->
    <div class="column">
      <img class="demo" src="img/img1.jpg" onclick="currentSlide(1)" alt="1">
    </div>

    <div class="column">
      <img class="demo" src="img/img2.jpg" onclick="currentSlide(2)" alt="2">
    </div>

    <div class="column">
      <img class="demo" src="img/img3.jpg" onclick="currentSlide(3)" alt="3">
    </div>

    <div class="column">
      <img class="demo" src="img/img4.jpg" onclick="currentSlide(4)" alt="4">
    </div>
  </div>
</div>
	</div> <!-- panel3-->
	</div> <!-- landing-text-->
	</div> <!-- landing-top -->
		<?
}
function display_articles($article_array) {
  // Выводит все книги, переданные в массиве
	echo "<section class=\"landing\">";
  if (!is_array($article_array)) {
    echo "<br />В настоящий момент нет статей в этой категории<br />";
  } else {
    // Создать таблицу
       
    // Создать строку таблицы для каждой книги 
    foreach ($article_array as $row) {
      $url = "show_article.php?id=".($row['id']);
     
      if (@file_exists('images/'.$row['isbn'].'.jpg')) {
        $title = '<img src=\'images/'.($row['isbn']).'.jpg\' border=0 />';
        do_html_url($url, $title);
      } 
      $title = $row['title'];
     echo '<p>';
		do_html_url($url, $title);
	  echo "<br />";
     echo $row['descript'];
	echo '</p>';
		
    }
  echo "</section>";
  }

}
function display_the_article($article) {
	echo "<article>"; 
  if (is_array($article)) {
    
    // Вывести изображение обложки, если оно имеется 
    if (@file_exists('images/'.($book['isbn']).'.jpg')) {
      $size = GetImageSize('images/'.$book['isbn'].'.jpg');
      if($size[0] > 0 && $size[1] > 0)
        echo '<td><img src=\'images/'.$book['isbn'].'.jpg\' border=0 '.$size[3].'></td>';
    }
    echo "<h1>".$article['title']."</h1>";
    echo $article['text'];
   
  } else
    echo "Невозможно вывести сведения о данной статье.";
echo "</article>";
}
function display_news_menu($news_array) { 
if (!is_array($news_array)) {
    echo "В настоящий момент нет доступных новостей<br /></aside>";
    return;

  }
	echo "<section class=news><p>Новости</p><ul>";
  foreach ($news_array as $row) {
    $url = "show_news.php?id=".($row['id']);
    $title = $row['title']; 
    echo "<li>";
    do_html_url($url, $title); 
    echo "</li>";
  }    
 	echo "</ul>";	
	echo "<strong>";
	do_html_url("show_all_news.php", "Другие новости..."); 
	echo "</strong></section></aside>";
}
function display_news($news_array) {
	if (!is_array($news_array)) {
    echo "В настоящий момент нет доступных новостей<br />";
    return;
  }
  echo "<h1>Последние новости:</h1>";
  foreach ($news_array as $row) {
    $url = "show_news.php?id=".($row['id']);    
	$title = $row['title'];
 
	echo do_html_url($url,"<b>$title</b>");  
	echo "<p>".$row['descript'];
	echo do_html_url($url,"далее...");
	  echo "</p>"; 
  }    
}
function display_the_news($news) {
	echo "<article>"; 
  if (is_array($news)) {
    
    // Вывести изображение обложки, если оно имеется 
    if (@file_exists('images/'.($book['isbn']).'.jpg')) {
      $size = GetImageSize('images/'.$book['isbn'].'.jpg');
      if($size[0] > 0 && $size[1] > 0)
        echo '<td><img src=\'images/'.$book['isbn'].'.jpg\' border=0 '.$size[3].'></td>';
    }
    echo "<h1>".$news['title']."</h1>";
    echo $news['text'];
	  echo "<br />".$news['date'];
   
  } else
    echo "Невозможно вывести сведения о данной статье.";
echo "</article>";
}
function display_voprosy_menu($voprosy_array) { 
if (!is_array($voprosy_array)) {
    echo "В настоящий момент нет доступных вопросов<br />";
    return;
  }
	echo "<section class=news><p>Вопросы</p><ul>";
  foreach ($voprosy_array as $row) {
    $url = "show_vopros.php?id=".($row['id']);
    $title = $row['vopros']; 
    echo "<li>";
    do_html_url($url, $title); 
    echo "</li>";
  }    
 	echo "</ul>";	
	echo "<strong>";
	do_html_url("show_voprosy.php", "Другие вопросы..."); 
	echo "</strong></section>";
}
function display_voprosy($voprosy_array) { 
if (!is_array($voprosy_array)) {
    echo "В настоящий момент нет доступных вопросов<br />";
    return;
  }
  echo "<h1>Отвечают наши юристы</h1>";
  foreach ($voprosy_array as $row) {
    $url = "show_vopros.php?id=".($row['id']);    
	$title = $row['vopros'];
	echo "<b>$title</b>";     
	echo "<p>".$row['otvet'];
	echo do_html_url($url,"далее...");
	  echo "</p>"; 
  }    
}
function display_vopros($vopros) {
	echo "<article>"; 
  if (is_array($vopros)) {
    
    // Вывести изображение обложки, если оно имеется 
    if (@file_exists('images/'.($book['isbn']).'.jpg')) {
      $size = GetImageSize('images/'.$book['isbn'].'.jpg');
      if($size[0] > 0 && $size[1] > 0)
        echo '<td><img src=\'images/'.$book['isbn'].'.jpg\' border=0 '.$size[3].'></td>';
    }
    echo "<h1>".$vopros['vopros']."</h1>";
    echo $vopros['otvet'];
	  echo "<br />".$vopros['name'];
   
  } else
    echo "Невозможно вывести сведения о данной статье.";
echo "</article>";
}
function display_login_form(){
	?>
  <form method="post" action="admin.php">
  <table bgcolor="#cccccc">
    <tr>
      <td>Имя пользователя:</td>
      <td><input type="text" name="username"></td>
    </tr>
    <tr>
      <td>Пароль:</td>
      <td><input type="password" name="passwd"></td>
    </tr>
    <tr>
      <td colspan=2 align="center">
      <input type="submit" value="Войти"></td>
    </tr>
  </table></form>
<?php
}
function display_admin_menu() {
?>
  <br />
  <a href="index.php">Перейти на основной сайт</a><br />
  <a href="insert_category_form.php">Добавить новую категорию</a><br />
  <a href="insert_article_form.php">Добавить новую статью</a><br />
  <a href="insert_news_form.php">Добавить новость</a><br />
  <a href="insert_vopros_form.php">Добавить вопрос</a><br />
<a href="logout.php">Выход</a><br />

  
<?php
}
function display_button($target, $image, $alt) {
  echo "<center><a href=\"$target\"><img src=\"img/$image" .
    ".jpg\" alt=\"$alt\" border=0></a></center>";
}

?>
