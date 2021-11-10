<?php


header("Content-Type: text/html; charset=utf-8");

mb_internal_encoding("UTF-8");


// Проверим гугл каптчу, отправим POST запрос гуглу и получим результат

$gipadress=$_SERVER['REMOTE_ADDR'];
$grecaptcha=$_POST['g-recaptcha-response']; 
$postdata = http_build_query(
	array(
		'secret' => '6Le6YisUAAAAAHSFmq-yt_XimV9wN9o3UE_8psHn',
		'response' => $grecaptcha,
		'remoteip' => $gipadress
	)
);
$opts = array('http' =>
	array(
		'method'  => 'POST',
		'header'  => 'Content-type: application/x-www-form-urlencoded',
		'content' => $postdata
	)
);


$gcontents = stream_context_create($opts);

$gresults = file_get_contents('https://www.google.com/recaptcha/api/siteverify', false, $gcontents);

$jsonresults = json_decode($gresults); 			

if ($jsonresults->{'success'}===false ) {  



			session_start();
			mb_internal_encoding("UTF-8"); // определяем кодировку
			header("Content-Type: text/html; charset=utf-8"); // определяем кодировку
			include "title.php";
			include "header.php";
			include "menu_top.php";
 			?>

			<div class="eo_block">
 			<br>
			<h1><b>Электронные обращения юридического лица в КЖУП "Светочь"</b></h1> 
   			<br><h2>Не правильно введен проверочный код!</h2>
   			<br><h2><a href="eo.php" OnClick="history.back();">Назад</a></h2> <!-- вернуться на страницу назад php -->

			</div>
	
			
			<?php
			include "footer_top.php";
			include "footer.php";



} 

else if ($jsonresults->{'success'}=== true )

{

// *******************************************************Начало**********************************************************************************Код формы!

//Ответ на электронное обращение

				$email_user_otvet = htmlspecialchars($_POST['user_email']);
				$subject_otvet = 'КЖУП Светочь г. Светлогорск'; 
				$text_otvet = 'Ваше обращение принято к рассмотрению. Ответ на Ваше обращение будет отправлен в установленные законадательством сроки!'; 

				// $headers = "MIME-Version: 1.0\r\n";
   				// $headers .= "Content-type:  text/html; charset=iso-8859-1\r\n";
			 	// $headers .= "From: КЖУП СВЕТОЧЬ <info@svsvetoch.by>\r\n";

				// $header = "From: КЖУП СВЕТОЧЬ <info@svsvetoch.by>";

				$headers =  'From: info@svsvetoch.by' . "\r\n" .
    						'Reply-To: info@svsvetoch.by' . "\r\n" .
    						'X-Mailer: PHP/' . phpversion();

//Формируем текст сообщения

				$email_user = 'kzhup.svetoch@mail.ru';
				$subject_user = "ЭЛЕКТРОННОЕ ОБРАЩЕНИЕ - SVSVETOCH! Тема обращения:" . htmlspecialchars($_POST['subject']);
				$text_user = 

				"\r\n Наименование организации: " . htmlspecialchars($_POST['user_name']) . 
 				"\r\n Адрес организации: " . htmlspecialchars($_POST['user_url']) .
 				"\r\n Контактный телефон: " . htmlspecialchars($_POST['user_tel']) . 
 				"\r\n Контактный E-mail: " . htmlspecialchars($_POST['user_email']) . 
 				"\r\n Тема обращения: " . htmlspecialchars($_POST['subject']) . 
 				"\r\n Изложите суть обращения: " . htmlspecialchars($_POST['text']);

 				mail('eo.kzhup.svetoch@mail.ru', $subject_user, $text_user, $headers); //Дополнительное письмо проверки

				if(mail($email_user, $subject_user, $text_user, $headers) && mail($email_user_otvet, $subject_otvet, $text_otvet, $headers))

  		
  		 	{
		
			
			session_start();
			mb_internal_encoding("UTF-8"); // определяем кодировку
			header("Content-Type: text/html; charset=utf-8"); // определяем кодировку
			include "title.php";
			include "header.php";
			include "menu_top.php";
 			?>

			<div class="eo_block">
 			<br>
			<h1><b>Электронные обращения юридического лица в КЖУП "Светочь"</b></h1> 
   			<br><h2>Ваше сообщение отправленно!</h2>
   			<br><h2><a href="http://svsvetoch.by">&larr; На главную</a></h2>
			</div>

			<?php
			include "footer_top.php";
			include "footer.php";
			

		}
	else
		{

		
   			session_start();
			mb_internal_encoding("UTF-8"); // определяем кодировку
			header("Content-Type: text/html; charset=utf-8"); // определяем кодировку
			include "title.php";
			include "header.php";
			include "menu_top.php";
 			?>

			<div class="eo_block">
 			<br>
			<h1><b>Электронные обращения юридического лица в КЖУП "Светочь"</b></h1> 
   			<br><h2>Ваше сообщение не отправленно! Пожалуйста свяжитесь с нами по Email: Shmuradko_Igor@mail.ru</h2>

   			<?php>
			mail('Shmuradko_Igor@mail.ru', 'Ошибка формы', 'Светочь бай')
			?>

			</div>

			<?php
			include "footer_top.php";
			include "footer.php";
		
		}

// *******************************************************Конец**********************************************************************************Код формы!

}


//print_r($_POST);

// echo '<hr>';

// echo "Ваша фамилия, собственное имя, отчество: " . $_POST['user_name'] . '<br>';
// echo "Ваш адрес места жительства (места пребывания): " . $_POST['user_url'] . '<br>';
// echo "Ваш контактный телефон:" . $_POST['user_tel'] . '<br>';
// echo "Ваш E-mail:" . $_POST['user_email'] . '<br>';
// echo "Тема обращения:" . $_POST['subject'] . '<br>';
// echo "Изложите суть обращения:" . $_POST['text'] . '<br>';
// echo "Файл"  . $_POST['fileAttach'] . '<br>';


// echo '<hr>';

