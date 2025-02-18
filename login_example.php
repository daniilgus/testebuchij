<?php

define('BOT_USERNAME', 'neurochanreg_bot'); // Имя вашего бота

function getTelegramUserData() {
    if (isset($_COOKIE['tg_user'])) {
        $auth_data_json = urldecode($_COOKIE['tg_user']);
        $auth_data = json_decode($auth_data_json, true);
        return $auth_data;
    }
    return false;
}

if (isset($_GET['logout'])) {
    setcookie('tg_user', '', time() - 3600, "/"); // Удаляем cookie
    header('Location: login_example.php'); // Перенаправляем на страницу входа
    exit();
}

$tg_user = getTelegramUserData();
if ($tg_user !== false) {
    $first_name = htmlspecialchars($tg_user['first_name']);
    $last_name = htmlspecialchars($tg_user['last_name']);
    $username = isset($tg_user['username']) ? htmlspecialchars($tg_user['username']) : '';
    $photo_url = isset($tg_user['photo_url']) ? htmlspecialchars($tg_user['photo_url']) : '';

    $html = "<h1>Привет, <a href=\"https://t.me/{$username}\">{$first_name} {$last_name}</a>!</h1>";
    if ($photo_url) {
        $html .= "<img src=\"{$photo_url}\">";
    }
    $html .= "<p><a href=\"?logout=1\">Выйти</a></p>";
} else {
    $bot_username = BOT_USERNAME;
    $html = <<<HTML
<h1>Здравствуйте, аноним!</h1>
<script async src="https://telegram.org/js/telegram-widget.js?2" data-telegram-login="{$bot_username}" data-size="large" data-auth-url="check_authorization.php" data-request-access="write"></script>
HTML;
}

echo <<<HTML
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Пример авторизации через Telegram</title>
</head>
<body><center>{$html}</center></body>
</html>
HTML;

?>
