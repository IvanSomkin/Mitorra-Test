<!DOCTYPE html>
<html>

<head>
  <style>
    body {
      text-align: center;
    }
  </style>
</head>

<body>
  <!-- Форма входа -->
  <form method="POST" action="/php-task-8-sign-in.php">
    <h1>Вход</h1>
    <h2>Логин</h2>
    <p><input type="text" name="login"></p>
    <h2>Пароль</h2>
    <p><input type="password" name="password"></p>
    <p><input type="submit" name="sign-in-submit" value="Войти">
  </form>
  <!-- Форма регистрации -->
  <form method="POST" action="/php-task-8-sign-up.php">
    <h1>Регистрация</h1>
    <h2>Логин</h2>
    <p><input type="text" name="login"></p>
    <h2>Пароль</h2>
    <p><input type="password" name="password"></p>
    <p><input type="submit" name="sign-up-submit" value="Зарегистрироваться">
  </form>
</body>

</html>