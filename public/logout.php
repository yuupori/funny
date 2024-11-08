<?php
session_start();
require_once '../classes/UserLogic.php';

if (!$logout = filter_input(INPUT_POST, 'logout')) {
  exit('不正なリクエストです。');
}

//　ログインしているか判定し、セッションが切れていたらログインしてくださいとメッセージを出す。
$result = UserLogic::checkLogin();

if (!$result) {
  exit('セッションが切れましたので、ログインし直してください。');
}

// ログアウトする
UserLogic::logout();

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styles.css">
  <title>ログアウト</title>
</head>
<header>
          <img src="https://i.pinimg.com/736x/08/7e/3e/087e3e1b7ca50b89160a6b5262c04e7f.jpg" alt="Smashロゴ" class="logo">
            <h1>Smash</h1>
        </header>
<body>
<h2>ログアウト</h2>
<p>またのご利用お待ちしております...</p>
<a href="loginpage.php">ログイン画面へ</a>
</body>
</html>