<?

session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Расчетно-справочный центр г. Светлогорск</title>
	<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
	<link rel="stylesheet" type="text/css" href="rscmain.css">
	
    <script src='https://www.google.com/recaptcha/api.js'></script> <!-- капча гугл -->
</head>
<body>
    <div class="wrapper">

    <div class="text-a"> 
    <p>    
    <b>Расчетно-справочный центр г. Светлогорск</b></p>
    <p> <br> 
    Уважаемые собственники (наниматели государственного жилого фонда, члены организации застройщиков, дольщики) жилых помещений, находящихся в городе Светлогорске!</p>
    <p>
    Информируем Вас о том, что в соответствии с пунктом 1 Положения о порядке расчетов и внесения платы за жилищно-коммунальные услуги и платы за пользование жилыми помещениями государственного жилищного фонда, утвержденного постановлением Совета Министров Республики Беларусь от 12.06.2014 № 571, Вы вправе оформить предоставление извещений о размере платы за жилищно-коммунальные услуги и пользование жилым помещением в электронном виде на адрес Вашей электронной почты.</p>
    <br>
    </div>
    <div class="text-z">
    <p><b>Заявление</b></p>
    <br>
    <p><b>Прошу предоставить мне ежемесячно извещения о размере платы за жилищно-коммунальные услуги и платы за пользование жилым помещением, в электронном виде на e-mail, предоставление указанных извещений на бумажном носителе прошу прекратить.</b></p>
    </div>
    <div class="form">
    <form  method="post" class="form" action="/rsc_start.php">
	<br>
    <label>Ф.И.О (собственника или нанимателя):</label>
    <br>
    <input type="text"  placeholder=" Иванов Иван Иванович" class = "input text"  maxlength="99" required name="user_name" />
    <br>

    <label>Ваш адрес места жительства (места пребывания):</label>
    <br>
    <input type="text"  placeholder=" г. Светлогорск ул. (м-н) Молодежный д. 1 кв. 1"  class = "text" maxlength="99" required name="user_url" />
    <br>

    <label>Ваш лицевой счёт</label>
    <br>
    <input type="text" placeholder=" 480ХХХХХХХХ" maxlength="11" class = "text" required name="user_id" />
    <br>


    <label>Ваш контактный телефон:</label>
    <br>
    <input type="text" placeholder=" 80ХХХХХХХХХ" class = "text"  maxlength="11" required name="user_tel" />
    <br>


  	<label>Ваш E-mail:</label>
    <br>
    <input type="email" placeholder=" example@mail.ru"  pattern="[a-zA-Z0-9!#$%&'*+\/=?^_`{|}~.-]+@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*"class = "text" required name="user_email" />
    <br>
 
	<br>
 
    <div class="g-recaptcha" data-sitekey="6LcPhewZAAAAAPmju7KTIm5XydF-le0mlBiVT3lx"></div>

    <br>

    <input type="submit" class="btn" value="Отправить" />
        
               
    </form> 
   </div>


	<!-- Значение №1: <input type="text" id="num1" value="">
    Результат: <input type="text" id="num2" value="">
    <button id="button-1" >Go</button>
	<button id="button-2" >Update</button> -->

    <p><br>
    <p><br>
    <p><br>

    </div>

    
<script src="//ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>


</body>
</html>