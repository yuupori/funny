<?php
session_start();
require_once '../classes/UserLogic.php';

$result = UserLogic::checkLogin();
if($result) {
  header('Location: home.php');
  return;
}

$err = $_SESSION;

$_SESSION = array();
session_destroy();

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style1.css">
  <title>ログイン画面</title>
</head>
<body>

    <?php if (isset($err['msg'])) : ?>
        <p><?php echo $err['msg']; ?></p>
    <?php endif; ?>
  <form action="login.php" method="POST">
  <p>
    <label for="email">管理者ID</label><br>
    <input type="email" name="email" placeholder="メールアドレス">
    <?php if (isset($err['email'])) : ?>
        <p><?php echo $err['email']; ?></p>
    <?php endif; ?>
  </p>
  <p>
    <label for="password">パスワード (英数8文字以上)</label><br>
    <input type="password" name="password" placeholder="パスワード">
    <?php if (isset($err['password'])) : ?>
        <p><?php echo $err['password']; ?></p>
    <?php endif; ?>
  </p>
  <p>
    <input type="submit" value="ログイン">
  </p>
  </form>
  <a href="signup_form.php">新規登録はこちら</a><br>
  <a href="loginpage.php">ホーム画面に戻る</a>
</body>
</html>
