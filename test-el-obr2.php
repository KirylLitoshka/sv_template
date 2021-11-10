<?php 

session_start();

mb_internal_encoding("UTF-8"); // определяем кодировку
header("Content-Type: text/html; charset=utf-8"); // определяем кодировку

?>

<?php include "title.php"; ?> 
<?php include "header.php"; ?> 
<?php include "menu_top.php"; ?>  


<div class="eo_block">

 <br>

<h1><b>Электронные обращения в КЖУП "Светочь"</b></h1> 
   
       
 <br>

 <form> 
  <p>Please select your preferred contact method:</p>
  <div>
    <input type="radio" id="contactChoice1"
           name="contact" value="email">
    <label for="contactChoice1">Email</label>
    <input type="radio" id="contactChoice2"
           name="contact" value="phone">
    <label for="contactChoice2">Phone</label>
    <input type="radio" id="contactChoice3"
           name="contact" value="mail">
    <label for="contactChoice3">Mail</label>
  </div>
  <div>
    <button type="submit">Submit</button>
  </div>
</form>

</div>

<?php include "footer_top.php";?> 
<?php include "footer.php";?> 

<script>


  alert(elem.value); // 1


</script>