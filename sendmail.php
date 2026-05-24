<?php
$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$message = $_POST['message'] ?? '';

// Либеральная проверка email: разрешаем localhost и обычные email
if (!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match('/^[^@]+@localhost$/', $email)) {
    die("Ошибка при отправке:\n- Некорректный email\n\n<a href='javascript:history.back()'>Вернуться назад</a>");
}

$log = "--- " . date('Y-m-d H:i:s') . " ---\n";
$log .= "Имя: $name\nEmail: $email\nСообщение: $message\n\n";

file_put_contents('mail_log.txt', $log, FILE_APPEND);

echo "✅ Данные сохранены. <a href='index.html'>Вернуться на сайт</a>";
?>