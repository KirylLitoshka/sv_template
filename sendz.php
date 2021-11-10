
<?php

header("Content-Type: text/html; charset=utf-8");

mb_internal_encoding("UTF-8");











if(isset($_FILES) && $_FILES['inputfile']['error'] == 0){ // Проверяем, загрузил ли пользователь файл



            //$destiation_dir = dirname(__FILE__) .'/'.$_FILES['inputfile']['name'];

            $destiation_dir = dirname(__FILE__); // Директория для размещения файла
            
            //$destiation_dir = '/var/www/user1126/data/www/uploads-file'; // Директория для размещения файла
            
            move_uploaded_file($_FILES['inputfile']['tmp_name'], $destiation_dir ); // Перемещаем файл в желаемую директорию

            echo 'Файл успешно загружен'; // Оповещаем пользователя об успешной загрузке файла



                                                        
                                                        }
else{
echo 'No File Uploaded'; // Оповещаем пользователя о том, что файл не был загружен
}




echo '<hr>';

print_r($_FILES);

echo '<hr>';

$der = dirname(__FILE__);


echo $der;
echo '<hr>';

echo $destiation_dir;



// echo "Ваша фамилия, собственное имя, отчество: " . $_POST['user_name'] . '<br>';
// echo "Ваш адрес места жительства (места пребывания): " . $_POST['user_url'] . '<br>';
// echo "Ваш контактный телефон:" . $_POST['user_tel'] . '<br>';
// echo "Ваш E-mail:" . $_POST['user_email'] . '<br>';
// echo "Тема обращения:" . $_POST['subject'] . '<br>';
// echo "Изложите суть обращения:" . $_POST['text'] . '<br>';
// echo "Файл"  . $_POST['fileAttach'] . '<br>';


// echo '<hr>';

?>