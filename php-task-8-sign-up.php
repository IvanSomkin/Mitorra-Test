<?php

if ($_POST['sign-up-submit']) {

  // Подключаемся к БД через другой скрипт
  include 'php-task-db.php';

  // Считываем поля из формы запроса
  $login = $_POST['login'];

  // Хэшируем пароль для хранения в БД
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

  // Проверяем, не занят ли логин
  $sql = "SELECT * FROM user WHERE user.login = '" . $login . "'";
  $result = $db->query($sql);
  if (mysqli_num_rows($result) != 0) {
    exit('
    <p>Пользователь с таким логином уже зарегистрирован</p>
    <button onclick="location.href=\'/php-task-8-entry.php\'" type="button">Вернуться на страницу входа</button>
    ');
  }

  // Подключаем класс PHPGangsta_GoogleAuthenticator
  // Создаём секретный ключ для проверки кодов из мобильного приложения
  require_once './require/GoogleAuthenticator/GoogleAuthenticator.php';
  $ga = new PHPGangsta_GoogleAuthenticator();
  $secret = $ga->createSecret();

  // Записываем данные нового пользователя в базу данных
  $sql =
    "INSERT INTO user
    (
      login,
      hashed_password,
      ga_secret
    )
    VALUES
    ('"
    . $login . "','"
    . $password . "','"
    . $secret . "'
    )";
  $result = $db->query($sql);

  // Предлагаем пользователю отсканировать QR-код для получения кодов в приложении
  exit('
  <p>Отсканируйте QR-код, чтобы подключить двухфакторную аутентификацию Google:</p>
  <p><img src="' . $ga->getQRCodeGoogleUrl($login, $secret) . '"></p>
  <button onclick="location.href=\'/php-task-8-entry.php\'" type="button">Вернуться на страницу входа</button>
  ');
}
