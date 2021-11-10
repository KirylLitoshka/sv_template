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

<h1><b>Электронные обращения граждан в КЖУП "Светочь"</b></h1> 
   
       
        <br>



        <h2>
        

<form method="post" action="sendZ.php" enctype="multipart/form-data">
<label for="inputfile">Выберите файл</label>
<input type="file" id="inputfile" name="inputfile"></br>
<input type="submit" value="Загрузить">



         </h2>
</div>

<?php
include "footer_top.php";
?> 

<?php
include "footer.php";
?> 

