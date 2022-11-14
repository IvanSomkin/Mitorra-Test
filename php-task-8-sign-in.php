<?php

if ($_POST['sign-in-submit']) {

  include 'php-task-db.php';

  $login = $_POST['login'];
  $password = $_POST['password'];
  $sql = "SELECT user.hashed_password FROM user WHERE user.login = '" . $login . "'";
  $result = $db->query($sql);
  if (mysqli_num_rows($result) == 0) {
    exit('
    <p>Пользователь с таким логином не обнаружен!</p>
    <button onclick="location.href=\'/php-task-8-entry.php\'" type="button">Вернуться на страницу входа</button>
    ');
  }

  $resultArr = $db->query($sql)->fetch_array();
  $verify = password_verify($password, $resultArr['hashed_password']);
  if (!$verify) {
    exit('Введён неправильный пароль!');
  }
}

?>

<!DOCTYPE html>
<html>

<body>
  <form method="POST" action="/php-task-8-ga-code.php">
    <h2>Введите код из GoogleAuthenticator:</h2>
    <input type="hidden" name="login" value="<?= $login ?>">
    <p><input type="text" name="code"></p>
    <p><input type="submit" name="ga-code-submit" value="Зарегистрироваться">
  </form>
</body>

</html>