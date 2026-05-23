<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Очистка и проверка данных
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $message = trim($_POST['message'] ?? '');
    
    $errors = [];
    if (empty($name)) $errors[] = "Имя обязательно";
    if (empty($email)) $errors[] = "Email обязателен";
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Некорректный email";
    if (empty($message)) $errors[] = "Сообщение обязательно";
    
    if (!empty($errors)) {
        echo "<h3>Ошибка при отправке:</h3><ul>";
        foreach ($errors as $error) echo "<li>" . htmlspecialchars($error) . "</li>";
        echo "</ul><a href='contacts.html'>Вернуться назад</a>";
        exit;
    }
    
    // Безопасное экранирование
    $safe_name = htmlspecialchars($name);
    $safe_email = htmlspecialchars($email);
    $safe_message = nl2br(htmlspecialchars($message));
    
    // Кому и тема
    $to = "mffeniks@yandex.ru";
    $subject = "=?UTF-8?B?" . base64_encode("Заявка с сайта мебельной компании СВК") . "?=";
    
    // Текст письма (plain)
    $body_text = "Поступила новая заявка!\n\nИмя: $safe_name\nEmail: $safe_email\nСообщение:\n$safe_message";
    
    // HTML-версия
    $body_html = "<html><head><style>body{font-family:Arial;}</style></head><body>
                  <h2>Новая заявка</h2>
                  <p><strong>Имя:</strong> $safe_name</p>
                  <p><strong>Email:</strong> $safe_email</p>
                  <p><strong>Сообщение:</strong><br>$safe_message</p>
                  </body></html>";
    
    $boundary = "-----=" . md5(rand());
    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: multipart/alternative; boundary=\"$boundary\"\r\n";
    $headers .= "From: no-reply@мебельныйзавод-свк.ru\r\n";
    $headers .= "Reply-To: $safe_email\r\n";
    
    $body = "--$boundary\r\n";
    $body .= "Content-Type: text/plain; charset=UTF-8\r\n\r\n$body_text\r\n\r\n";
    $body .= "--$boundary\r\n";
    $body .= "Content-Type: text/html; charset=UTF-8\r\n\r\n$body_html\r\n\r\n";
    $body .= "--$boundary--";
    
    if (mail($to, $subject, $body, $headers)) {
        header("Location: thanks.html");
        exit;
    } else {
        echo "❌ Ошибка при отправке. Попробуйте позже.<br><a href='contacts.html'>Вернуться</a>";
    }
} else {
    header("Location: contacts.html");
    exit;
}
?>