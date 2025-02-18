<?php
session_start();

define('BOT_TOKEN', '7811267061:AAHOwQDUboQLau6cfpaAPJIq0Rro36TSj90'); // Замените на ваш токен бота

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tg_user = json_decode(urldecode($_COOKIE['tg_user']), true);
    
    if ($tg_user === null) {
        die('Ошибка: не удалось получить данные пользователя.');
    }

    $first_name = htmlspecialchars($tg_user['first_name']);
    $last_name = htmlspecialchars($tg_user['last_name']);
    $username = htmlspecialchars($tg_user['username']);

    // Отправка сообщения в Telegram
    $message = "Вы авторизовались на NeurochanArt через @$username. Сайту известны Ваше имя и фотография.";
    $chat_id = $tg_user['id']; // ID пользователя Telegram
    file_get_contents("https://api.telegram.org/bot" . BOT_TOKEN . "/sendMessage?chat_id=$chat_id&text=" . urlencode($message));

    header('Location: login_example.php'); // Перенаправляем на страницу входа
    exit();
}
?>
