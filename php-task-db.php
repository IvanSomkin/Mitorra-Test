<?php

// Добавляем данные подключения к БД из переменных среды
$dbHost = getenv('MITORRA_TASK_DATABASE_HOST');
$dbUsername = getenv('MITORRA_TASK_DATABASE_USERNAME');
$dbPassword = getenv('MITORRA_TASK_DATABASE_PASSWORD');
$dbName = getenv('MITORRA_TASK_DATABASE_NAME');

// Устанавливаем и проверяем соединение с БД с помощью класса MySQLi
try {
  $db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);
} catch (exception $e) {
  exit('Connection failed! ' . $e->getMessage());
}
