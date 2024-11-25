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
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログインページ</title>
    <link rel="stylesheet" href="styles1.css">
</head>
<body>

<?php if (isset($err['msg'])) : ?>
    <p><?php echo $err['msg']; ?></p>
<?php endif; ?>

<div class="login-container">
    <h1>Smash</h1>
    <h2>管理者ログイン</h2>

    <form action="home.php" method="POST" id="adminLoginForm">
        <div class="form-group">
            <label for="email">管理者ID:</label>
            <input type="email" name="email" id="email" placeholder="管理者IDを入力" required>
            <?php if (isset($err['email'])) : ?>
                <p><?php echo $err['email']; ?></p>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="password">パスワード:</label>
            <input type="password" name="password" id="password" placeholder="パスワードを入力" required>
            <?php if (isset($err['password'])) : ?>
                <p><?php echo $err['password']; ?></p>
            <?php endif; ?>
        </div>

        <button type="submit">ログイン</button>
    </form>

    <div id="adminMessage" class="message"></div>
</div>

<script>
document.getElementById('adminLoginForm').addEventListener('submit', function (event) {
    event.preventDefault(); // フォームのデフォルト送信を防ぐ

    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;

    // サーバーに実際のデータを送信する処理
    if (!email || !password) {
        alert('管理者IDとパスワードを入力してください。');
    } else {
        this.submit(); // デフォルトのフォーム送信を実行してPHP側でログイン処理を行う
    }
});
</script>

</body>
</html>
