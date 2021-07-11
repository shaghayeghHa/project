<?php


if (!isset($_GET['id'])) {

  header("Location: /test/index.php");

  return;
}



$link = mysqli_connect('localhost:3306', 'root', '');

if (!$link) {

  echo 'could not connect : ' . mysqli_connect_error();
  exit;
}



mysqli_select_db($link, 'test');

$stmt = mysqli_prepare($link, "delete from users3 where id = ?");

$id = (int) $_GET['id'];

mysqli_stmt_bind_param($stmt, 'i', $id);

mysqli_stmt_execute($stmt);

header("Location: /test/index.php");

return;
