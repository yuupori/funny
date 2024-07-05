<?php
session_start();

require_once '../functions.php';
require_once '../classes/UserLogic.php';

$result = UserLogic::checkLogin();
if($result) {
  header('Location: home.php');
  return;
}

$login_err = isset($_SESSION['login_err']) ? $_SESSION['login_err'] : null;
unset($_SESSION['login_err']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style1.css">
  <title>新規登録</title>
</head>
<body>
  

<?php if (isset($login_err)) : ?>
    <p><?php echo $login_err; ?></p>
<?php endif; ?>
  <form action="register.php" method="POST">
  <p>
    <label for="username">ユーザ名</label><br>
    <input type="text" name="username" placeholder="ユーザ名">
  </p>
  <p>
    <label for="email">メールアドレス</label><br>
    <input type="email" name="email" placeholder="メールアドレス">
  </p>
  <p>
    <label for="password">パスワード (英数8文字以上)</label><br>
    <input type="password" name="password" placeholder="パスワード">
  </p>
  <p>
    <label for="password_conf">パスワード確認</label><br>
    <input type="password" name="password_conf" placeholder="パスワード確認">
  </p>
  <input type="hidden" name="csrf_token" value="<?php echo h(setToken()); ?>">
  <p>
    <input type="submit" value="新規登録">
  </p>
  </form>
  <a href="login_form.php">ログイン画面はこちら</a><br>
  <a href="start.php">ホーム画面に戻る</a>
  
</body>
</html>