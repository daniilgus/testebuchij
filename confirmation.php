<?php
session_start();

function getTelegramUserData() {
    if (isset($_COOKIE['tg_user'])) {
        return json_decode(urldecode($_COOKIE['tg_user']), true);
    }
    return false;
}

$tg_user = getTelegramUserData();
if ($tg_user === false) {
    header('Location: login_example.php'); // Если пользователь не авторизован, перенаправляем
    exit();
}

// Отображаем данные пользователя
$first_name = htmlspecialchars($tg_user['first_name']);
$last_name = htmlspecialchars($tg_user['last_name']);
$username = htmlspecialchars($tg_user['username']);
$photo_url = htmlspecialchars($tg_user['photo_url']);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Подтверждение</title>
</head>
<body>
    <h1>Подтверждение авторизации</h1>
    <p>Вы авторизовались как: <strong><?php echo "$first_name $last_name"; ?></strong></p>
    <img src="<?php echo $photo_url; ?>" alt="Аватар" />
    <form action="finalize_auth.php" method="post">
        <button type="submit">Подтвердить</button>
    </form>
</body>
</html>
