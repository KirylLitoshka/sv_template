<?php 

session_start();

mb_internal_encoding("UTF-8"); // определяем кодировку
header("Content-Type: text/html; charset=utf-8"); // определяем кодировку

?>

<?php
include "title.php";
?> 

<?php
include "header.php";
?> 

<?php
include "menu_top.php";
?>  


<div class="eo_block">

 <br>

<h1><b>Электронные обращения в КЖУП "Светочь"</b></h1> 

<p class="notification" style="
    width: 400px;
    text-align: center;
    padding: 20px 0;
    font-weight: bold;">
    Уважаемые граждане, в целях получения своевременного ответа на электронные обращения просим Вас не указывать при регистрации почтовый ящик расположенный на сервисе tut.by в связи с 
    <a href="http://mininform.gov.by/news/all/ogranichenie-dostupa-k-internet-resursam-tut-by/" target="_blank">блокировкой интернет-ресурса!</a>
</p>
   
       
 <br>

 <h2>
        
 <form enctype="multipart/form-data" method="post" id="form" action="eo_start_new2.php" >


<!-- <input class="V2" type="radio"  name="v1" value="v1">Электронное обращение граждан</a> -->






 <p>Наименование организации:</p>                                  <input required placeholder="" name="user_name" type="text" >
 <p>Адрес организации:</p>                                         <input required placeholder="" name="user_url" type="text" >
 <p>Контактный телефон:</p>                                        <input required placeholder="" name="user_tel" type="text" >
 <p>Контактный E-mail:</p>                                         <input required placeholder="" name="user_email" type="email" >
 <p>Тема обращения:</p>                                            <input required placeholder="" name="subject" type="text" >
 <p>Изложите суть обращения:</p>                                   <textarea required name="text"></textarea>

 <p>Прикрепить файлы (Размер файла не должен превышать 5Мб)</p>    <input type="file" accept="" name="myfile[]" multiple id="myfile">
 


 <div class="g-recaptcha" data-sitekey="6LcPhewZAAAAAPmju7KTIm5XydF-le0mlBiVT3lx"></div>

 <p><input value="Отправить" type="submit"></p>
</form>


</h2>
</div>

<?php
include "footer_top.php";
?> 

<?php
include "footer.php";
?> 

<script src="jquery-3.4.0.min.js"></script>
<script>
// Отправка данных на сервер
$('#form').trigger('reset');
$(function() {
  'use strict';
  $('#form').on('submit', function(e) {
    e.preventDefault();
    $.ajax({
      url: 'eo_start_new2.php',
      type: 'POST',
      contentType: false,
      processData: false,
      data: new FormData(this),
      success: function(msg) {
        console.log(msg);
        if (msg == 'ok') {
          alert('Сообщение отправлено');
          $('#form').trigger('reset'); // очистка формы
        } else {
          alert('ОШИБКА - Внимательно заполните все строки');
        }
      }
    });
  });
});
</script>

