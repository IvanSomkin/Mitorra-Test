<?php

if ($_POST['sign-in-submit']) {

  // Подключаемся к БД через другой скрипт
  include 'php-task-db.php';

  // Считываем поля из формы запроса
  $login = $_POST['login'];
  $password = $_POST['password'];

  // Получаем хэш пароля пользователя, если тот существует
  $sql = "SELECT user.hashed_password FROM user WHERE user.login = '" . $login . "'";
  $result = $db->query($sql);
  if (mysqli_num_rows($result) == 0) {
    exit('
    <p>Пользователь с таким логином не обнаружен!</p>
    <button onclick="location.href=\'/php-task-8-entry.php\'" type="button">Вернуться на страницу входа</button>
    ');
  }

  // Переводим результат в массив
  $resultArr = $result->fetch_array();

  // Сверяем введённый пароль с хранящимся через хэширование
  $verify = password_verify($password, $resultArr['hashed_password']);
  if (!$verify) {
    exit('
    <p>Введён неправильный пароль!</p>
    <button onclick="location.href=\'/php-task-8-entry.php\'" type="button">Вернуться на страницу входа</button>
    ');
  }
}

?>

<!DOCTYPE html>
<html>

<body>
  <form method="POST" action="/php-task-8-ga-code.php">
    <h2>Введите код из GoogleAuthenticator:</h2>
    <!-- Скрытно прикрепляем логин для дальнейшей операции-->
    <input type="hidden" name="login" value="<?= $login ?>">
    <p><input type="text" name="code"></p>
    <p><input type="submit" name="ga-code-submit" value="Ввести">
  </form>
</body>

</html>