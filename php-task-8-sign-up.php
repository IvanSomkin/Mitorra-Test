<?php

if ($_POST['sign-up-submit']) {

  include 'php-task-db.php';

  $login = $_POST['login'];
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

  $sql = "SELECT * FROM user WHERE user.login = '" . $login . "'";
  $result = $db->query($sql);
  if (mysqli_num_rows($result) != 0) {
    exit('
    <p>Пользователь с таким логином уже зарегистрирован</p>
    <button onclick="location.href=\'/php-task-8-entry.php\'" type="button">Вернуться на страницу входа</button>
    ');
  }

  require_once './require/GoogleAuthenticator/GoogleAuthenticator.php';
  $ga = new PHPGangsta_GoogleAuthenticator();
  $secret = $ga->createSecret();
  $login = $_POST['login'];

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

  exit('
  <p>Отсканируйте QR-код, чтобы подключить двухфакторную аутентификацию Google:</p>
  <p><img src="' . $ga->getQRCodeGoogleUrl($login, $secret) . '"></p>
  <button onclick="location.href=\'/php-task-8-entry.php\'" type="button">Вернуться на страницу входа</button>
  ');
}
