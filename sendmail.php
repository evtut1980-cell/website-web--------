<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Получаем данные из формы
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];
    
    // Кому отправляем письмо
    $to = "mffeniks@yandex.ru";
    
    // Тема письма
    $subject = "Заявка с сайта мебельной компании";
    
    // Текст письма
    $body = "Поступила новая заявка!\n\n";
    $body .= "Имя: " . $name . "\n";
    $body .= "Email: " . $email . "\n";
    $body .= "Сообщение:\n" . $message . "\n";
    
    // Заголовки письма
    $headers = "From: " . $email . "\r\n";
    $headers .= "Reply-To: " . $email . "\r\n";
    
    // Отправляем письмо
    if (mail($to, $subject, $body, $headers)) {
        // Если успешно — перенаправляем на страницу спасибо
        header("Location: thanks.html");
    } else {
        // Если ошибка — показываем сообщение
        echo "Ошибка при отправке. Попробуйте позже.";
    }
} else {
    // Если кто-то зашёл напрямую — вернуть на главную
    header("Location: contacts.html");
}
?>