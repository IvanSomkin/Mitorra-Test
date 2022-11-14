<?php

if ($_POST['ga-code-submit']) {

  // Подключаемся к БД через другой скрипт
  include 'php-task-db.php';

  // Считываем поля из формы запроса
  $login = $_POST['login'];
  $code = $_POST['code'];

  // Ищем пользователя в БД, проверяем, что он всё ещё существует
  $sql = "SELECT * FROM user WHERE user.login = '$login'";
  $result = $db->query($sql);
  if (mysqli_num_rows($result) == 0) {
    exit('
    <p>Пользователя с таким логином больше не существует!</p>
    <button onclick="location.href=\'/php-task-8-entry.php\'" type="button">Вернуться на страницу входа</button>
    ');
  }

  // Получаем секретный ключ GoogleAuthenticator пользователя
  $secret = $result->fetch_array()['ga_secret'];

  // Подключаем класс PHPGangsta_GoogleAuthenticator
  // Проверяем полученный код из приложения через секретный ключ
  require_once './require/GoogleAuthenticator/GoogleAuthenticator.php';
  $ga = new PHPGangsta_GoogleAuthenticator();
  $checkResult = $ga->verifyCode($secret, $code, 6);
  if ($checkResult) {
    exit('
    <h3>Код введён верно! Вы зашли успешно!</h3>
    <button onclick="location.href=\'/php-task-8-entry.php\'" type="button">Вернуться на страницу входа</button>
    ');
  } else {
    exit('
    <h3>Код введён неверно!</h3>
    <button onclick="location.href=\'/php-task-8-entry.php\'" type="button">Вернуться на страницу входа</button>
    ');
  }
}
