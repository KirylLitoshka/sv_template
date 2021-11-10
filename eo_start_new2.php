<?php


header("Content-Type: text/html; charset=utf-8");
mb_internal_encoding("UTF-8");


// Файлы phpmailer

require 'phpmailer/phpmailer.php';
require 'phpmailer/smtp.php';
require 'phpmailer/exception.php';


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

            <div class="eo_block">
            <br>
            <h1><b>Электронные обращения в КЖУП "Светочь"</b></h1> 
            <br><h2>Не правильно введен проверочный код!</h2>
            <br><h2><a href="eo.php" OnClick="history.back();">Назад</a></h2> <!-- вернуться на страницу назад php -->

            </div>
    
            
            <?php
            include "footer_top.php";
            include "footer.php";

}

else if ($jsonresults->{'success'}=== true )

{

// Переменные, которые отправляет пользователь

$date_eo = date("Y-m-d H:i:s");

$user_name = htmlspecialchars($_POST['user_name']);
$user_url = htmlspecialchars($_POST['user_url']);
$user_tel = htmlspecialchars($_POST['user_tel']);
$user_email = htmlspecialchars($_POST['user_email']);
$subject = htmlspecialchars($_POST['subject']);
$user_text = htmlspecialchars($_POST['text']);



$mail = new PHPMailer\PHPMailer\PHPMailer();


try {
    $msg = "ok";
    $mail->isSMTP();   
    $mail->CharSet = "UTF-8";                                          
    $mail->SMTPAuth   = true;

    // Настройки вашей почты
    $mail->Host       = 'mail.g-cloud.by'; // SMTP сервера GMAIL
    $mail->Username   = 'obr@svsvetoch.by'; // Логин на почте
    $mail->Password   = 'VMaTnc2JTh'; // Пароль на почте
    $mail->SMTPSecure = 'tsl';
    $mail->Port       = 587;
    
    $mail->setFrom('obr@svsvetoch.by', 'КЖУП СВЕТОЧЬ'); // Адрес самой почты и имя отправителя
    
    // Получатель письма

    $mail->addAddress('obr@svsvetoch.by');   
    $mail->addAddress('eo.kzhup.svetoch@mail.ru');  


    // Определяем временную категорию для файлов на сервере
    $tmpurl = '/var/www/user3015/data/www/uploads-file/';



    // Прикрипление файлов к письму

if (!empty($_FILES['myfile']['name'][0])) {
    for ($ct = 0; $ct < count($_FILES['myfile']['tmp_name']); $ct++) {
        
        $uploadfile = tempnam($tmpurl, sha1($_FILES['myfile']['name'][$ct]));
        $filename = $_FILES['myfile']['name'][$ct];

        if (move_uploaded_file($_FILES['myfile']['tmp_name'][$ct], $uploadfile)) {
            $mail->addAttachment($uploadfile, $filename);
        } else {
            $msg .= 'Неудалось прикрепить файл ' . $uploadfile;
        }
    }   
}

        // -----------------------
        // Само письмо
        // -----------------------
        $mail->isHTML(true);
    
        $mail->Subject = 'ЭЛЕКТРОННОЕ ОБРАЩЕНИЕ';
        

        $mail->Body    = 

                         "      <b> Наименование организации:</b>" . htmlspecialchars($_POST['user_name']) . 
                         " <br/><b> Адрес организации:</b>" . htmlspecialchars($_POST['user_url']) .
                         " <br/><b> Контактный телефон:</b>" . htmlspecialchars($_POST['user_tel']) . 
                         " <br/><b> Контактный E-mail:</b>" . htmlspecialchars($_POST['user_email']) . 
                         " <br/><b> Тема обращения:</b>" . htmlspecialchars($_POST['subject']) . 
                         " <br/><b> Изложите суть обращения:</b>" . htmlspecialchars($_POST['text']);





//Ответ на электронное обращение

    $headers =  'From: obr@svsvetoch.by' . "\r\n" .
                'Reply-To: obr@svsvetoch.by' . "\r\n" .
                'X-Mailer: PHP/' . phpversion();                     

    $email_user_otvet = stripslashes($_POST['user_email']);
    $subject_otvet = 'КЖУП Светочь г. Светлогорск'; 
    $text_otvet = 'Ваше обращение принято к рассмотрению. Ответ на Ваше обращение будет отправлен в установленные законодательством сроки!'; 


    mail($email_user_otvet, $subject_otvet, $text_otvet, $headers);




// Проверяем отравленность сообщения

if ($mail->send()) {
    echo "$msg";
} else {
echo "Сообщение не было отправлено. Неверно указаны настройки вашей почты";
}
} catch (Exception $e) {
    echo "Сообщение не было отправлено. Причина ошибки: {$mail->ErrorInfo}";
}

}