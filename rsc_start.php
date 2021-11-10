<?php


header("Content-Type: text/html; charset=utf-8");

mb_internal_encoding("UTF-8");


// Проверим гугл каптчу, отправим POST запрос гуглу и получим результат

$gipadress=$_SERVER['REMOTE_ADDR'];
$grecaptcha=$_POST['g-recaptcha-response']; 
$postdata = http_build_query(
	array(
		'secret' => '6LcPhewZAAAAAAWZakT_Ey6lWL3eOdtDm66DZ3Ju',
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

			<div class="rsc_block">
 			<br>
			<h1><b>Заявление на электронное извещение РСЦ КЖУП "Светочь"</b></h1> 
   			<br><h2>Не правильно введен проверочный код!</h2>
   			<br><h2><a href="rscsvsvetoch.php" OnClick="history.back();">Назад</a></h2> <!-- вернуться на страницу назад php -->

			</div>
	
			
			<?php
			include "footer_top.php";
			include "footer.php";



} 

else if ($jsonresults->{'success'}=== true )

{

// *******************************************************Начало****************************************************************************Код формы!

// Подключаемся к базе данных

$connection = mysqli_connect('localhost', 'svsvetoc_rsc', '12345', 'svsvetoc_rsc');

// Определяем кодировку

mysqli_set_charset($connection, "utf8");

// Запись обращения в базу даннных

	$date_rsc = date("Y-m-d H:i:s");
	$user_name = htmlspecialchars($_POST['user_name']);
	$user_url = htmlspecialchars($_POST['user_url']);
	$user_id = htmlspecialchars($_POST['user_id']);
	$user_tel = htmlspecialchars($_POST['user_tel']);
	$user_email = htmlspecialchars($_POST['user_email']);
	

// Записываем в базу

mysqli_query ($connection, 	"INSERT INTO `rsc` (`id`, `date_rsc`, `user_name`, `user_url`, `user_tel`, `user_id`, `user_email`)
							 	         VALUES (NULL, '$date_rsc', '$user_name', '$user_url', '$user_tel', '$user_id', '$user_email')");




//Ответ на электронное обращение

				$email_user_otvet = stripslashes($_POST['user_email']);
				$subject_otvet = 'Расчетно-справочный центр г. Светлогорск'; 
				$text_otvet = 'Ваше заявка на электронное извещение принята!'; 

//Формируем текст сообщения

				$headers =  'From: rsc@svsvetoch.by' . "\r\n" .
    						'Reply-To: rsc@svsvetoch.by' . "\r\n" .
    						'X-Mailer: PHP/' . phpversion();


				$email_user = 'rsc@svsvetoch.by';
				$subject_user = "Заявка на электронное извещение" . htmlspecialchars($_POST['subject']);
				$text_user = 

				"\r\nЗаявление" .
				"\r\n" .
                "\r\nПрошу предоставить мне ежемесячно извещения о размере платы за жилищно-коммунальные услуги и платы за пользование жилым помещением, в электронном виде на e-mail, предоставление указанных извещений на бумажном носителе прошу прекратить." .
                "\r\n" .
				"\r\n ФИО - " . htmlspecialchars($_POST['user_name']) . 
 				"\r\n АДРЕС - " . htmlspecialchars($_POST['user_url']) .
 				"\r\n ТЕЛЕФОН - " . htmlspecialchars($_POST['user_tel']) . 
 				"\r\n ЛИЦЕВОЙ СЧЕТ - " . htmlspecialchars($_POST['user_id']) . 
 				"\r\n E-mail - " . htmlspecialchars($_POST['user_email']);

 				mail('eo.kzhup.svetoch@mail.ru', $subject_user, $text_user, $headers); //Дополнительное письмо проверки

				if(mail($email_user, $subject_user, $text_user, $headers) && mail($email_user_otvet, $subject_otvet, $text_otvet, $headers))

  		
  		 	{
		
			
			session_start();
			mb_internal_encoding("UTF-8"); // определяем кодировку
			header("Content-Type: text/html; charset=utf-8"); // определяем кодировку
			
 			?>

			<!DOCTYPE html>
			<html lang="en">
			<head>
			<meta charset="UTF-8">
    		<meta name="viewport" content="width=device-width, initial-scale=1">
			<title>Расчетно-справочный центр г. Светлогорск</title>
			<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
			<link rel="stylesheet" type="text/css" href="main.css">
	   		</head>
			<body>	

			<link rel="stylesheet" type="text/css" href="main.css">
			<div class="wrapper">
 			<br>
			<p>Расчетно-справочный центр г. Светлогорск
   			<br>Ваша заявка принята!
   			<br>
   			<br><a href="rscsvsvetoch.php">&larr; <b>На главную</b></a></p>
			</div>
		    </body>
			</html>

			<?php
				

		}
	else
		{

		
   			session_start();
			mb_internal_encoding("UTF-8"); // определяем кодировку
			header("Content-Type: text/html; charset=utf-8"); // определяем кодировку
			
 			?>
			<link rel="stylesheet" type="text/css" href="main.css">
			<div class="wrapper">
 			<br>
			<h1><b>Электронные обращения граждан в КЖУП "Светочь"</b></h1> 
   			<br><h2>Ваше сообщение не отправленно! Пожалуйста свяжитесь с нами по Email: it@svsvetoch.by</h2>

   			<?php
			mail('it@svsvetoch.by', 'Ошибка формы', 'Светочь бай', $headers)
			?>

			</div>

			<?php
					
		}

// *******************************************************Конец**********************************************************************************Код формы!

}



