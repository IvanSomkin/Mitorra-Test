<?php

if ($_POST['ga-code-submit']) {

  include 'php-task-db.php';

  $login = $_POST['login'];
  $code = $_POST['code'];
  $sql = "SELECT * FROM user WHERE user.login = '$login'";
  $result = $db->query($sql);
  $secret = $result->fetch_array()['ga_secret'];

  require_once './require/GoogleAuthenticator/GoogleAuthenticator.php';
  $ga = new PHPGangsta_GoogleAuthenticator();
  $checkResult = $ga->verifyCode($secret, $code, 6);
  if ($checkResult) {
    echo '<h3>Код введён верно! Вы зашли успешно!</h3>';
  } else {
    echo '<h3>Код введён неверно!</h3>';
  }
  echo '<button onclick="location.href=\'/php-task-8-entry.php\'" type="button">Вернуться на страницу входа</button>';
}
