<?php

// Получаем информацию с полей формы
$name = $_POST['name'];
$surname = $_POST['surname'];
$email = $_POST['email'];
$telephone = $_POST['telephone'];
$message = $_POST['message'];

// На всякий случай преобразуем в HTML сущности спец.символы
$name = htmlspecialchars($name);
$surname = htmlspecialchars($surname);
$email = htmlspecialchars($email);
$city = htmlspecialchars($city);
$telephone = htmlspecialchars($telephone);
$theme = htmlspecialchars($theme);
$message = htmlspecialchars($message);

// Декодируем
$name = urldecode($name);
$surname = urldecode($surname);
$email = urldecode($email);
$city = urldecode($city);
$telephone = urldecode($telephone);
$theme = urldecode($theme);
$message = urldecode($message);

// Работа с файлом

$name_of_uploaded_file = $_FILES['uploaded_file']['name'];
$type_of_uploaded_file  = $_FILES['uploaded_file']['type'];
$size_of_uploaded_file = $_FILES['uploaded_file']['size'];
$tmp_path = $_FILES['uploaded_file']['tmp_name'];

// убираем пробелы и подписываем
$name = "Имя :".trim($name);
$surname = "Фамилия :" .trim($surname);
$email = "Почта :" .trim($email);
$city = "Город :" .trim($city);
$telephone = "Телефон :" .trim($telephone);
$theme = "Тема :" .trim($theme);
$message = "Сообщение :" .trim($message);
$subject = "Test file";
$from = "test@seoven.ru";
$mailTo = "$email";

// Заполняем заголовки
$separator = "---";
$headers = "MIME-Version: 1.0\r\n";
$headers .= "From: " . $from . "\n";
$headers .= "Reply-To: " . $from . "\n"; 
$headers .= "Content-Type: multipart/mixed; boundary=\"$separator\"";

// Формируем сообщение
$mes  = "<br>Новое сообщение: <br> 
        $name<br> 
        $surname<br>
        $email<br>
        $city<br>
        $telephone<br>
        $theme<br>
        $message"."\n\n";

// Собираем сообщение Сначала текст

$body_Mail = "--$separator\n";
$body_Mail .= "Content-type: text/html; charset=\"utf-8\"\n";
$body_Mail .= "Content-Transfer-Encoding: 7bit\n\n";
$body_Mail .= $mes ."\n\n";

// Затем добавляем файл
$body_Mail .= "--$separator\n";
// $body_Mail .= "Content-Type: \"$type_of_uploaded_file\"; \n";
$body_Mail .= "Content-Type: multipart/form-data; name=\"$name_of_uploaded_file\"\n";
$body_Mail .= "Content-Transfer-Encoding: base64\n";
$body_Mail .= "Content-Disposition: attachment; filename=\"$name_of_uploaded_file\"\n\n";
$body_Mail .= chunk_split(base64_encode(file_get_contents($tmp_path)))."\n\n";
$body_Mail .= "--$separator\n";

if(mail($mailTo,$subject, $body_Mail, $headers)) {}
    echo "Ваше письмо отправлено!";
} else {
    echo "Письмо не отправлено";
}

?>
