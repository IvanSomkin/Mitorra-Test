<?php

// Подключаемся к БД через другой скрипт
include 'php-task-db.php';

// Увеличиваем максимальноевремя выполнения для большой нагрузки БД
ini_set('max_execution_time', '300');

// Читаем csv файл на диске и кладём в массив
if (($file = fopen("assets/test.csv", "r")) !== FALSE) {

  // Считываем заголовки
  $headers = fgetcsv($file, 1000, ";");

  // Читаем строчки csv-файла и записываем в БД
  while (($data = fgetcsv($file, 1000, ";")) !== FALSE) {
    $category_id = $data[0];
    $category_name = $data[1];
    $product_id = $data[2];
    $product_name = $data[3];
    $product_quantity = $data[4];
    $product_price = $data[5];

    // Составляем SQL-запрос:
    // при отсутсвии ключа - добавляем ряд
    // при наличии ключа - обновляем ряд
    $sql =
      "INSERT INTO product
      (
        category_id,
        category_name, 
        product_id,
        product_name,
        product_quantity,
        product_price
      )
      VALUES
      ('"
      . $category_id . "','"
      . $category_name . "','"
      . $product_id . "','"
      . $product_name . "','"
      . $product_quantity . "','"
      . $product_price .
      "')
      ON DUPLICATE KEY UPDATE 
      category_id='" . $category_id . "',
      category_name='" . $category_name . "',
      product_id='" . $product_id . "',
      product_name='" . $product_name . "',
      product_quantity='" . $product_quantity . "',
      product_price='" . $product_price . "';";
    $result = $db->query($sql);
  }
  fclose($file);
}
