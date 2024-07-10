<?php
session_start();
require_once '../classes/UserLogic1.php';
require_once '../functions1.php';

//　ログインしているか判定し、していなかったら新規登録画面へ返す
$result = UserLogic::checkLogin();

if (!$result) {
  $_SESSION['login_err'] = 'ユーザを登録してログインしてください！';
  header('Location: signup_form1.php');
  return;
}

$login_user = $_SESSION['login_gomi1'];


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>従業員用</h1>
</body>
</html>