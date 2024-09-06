<?php
session_start();
require_once '../classes/UserLogic.php';
require_once '../functions.php';

//　ログインしているか判定し、していなかったら新規登録画面へ返す
$result = UserLogic::checkLogin();

if (!$result) {
  $_SESSION['login_err'] = 'ユーザを登録してログインしてください！';
  header('Location: signup_form.php');
  return;
}

$login_user = $_SESSION['login_gomi'];


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Funny-Gommy</title>
</head>
<header><p><?php echo h($login_user['name']) ?>さん、ようこそ!</p></header>
<body>
    <style>
            .title{
                display: flex;
                align-items: flex-start;
            }
    </style>
    <table width="400" style="margin: left 100px;" bgcolor="silver">
        <div class="title">
            <tr>
                <td>ゴミ箱ID</td> <td>充填率</td> <td>住所</td>
            <tr>
                <td>1</td><td bgcolor="red">87%</td><td><a href="jusyo1.php">神戸市中央区山本通</a></td>
            </tr>           
            <tr>
                <td>2</td><td bgcolor="palegreen">57%</td><td><a href="jusyo2.php">神戸市中央区</a></td>
            </tr>
            
            </tr>


            
        </div>
    
    
        
    </table>
    
<br><br>
    <a href="status.php">ゴミ箱ステータス</a>
    <form action="logout.php" method="POST">
                        <input type="submit" name="logout" value="ログアウト">
                        </form>
<br><br>
<a href="analysis.php">分析</a>

<script>document.addEventListener('DOMContentLoaded', (event) => {
    console.log(`DOMContentLoadedイベントが発生しました。`);
});</script>
</body>
</html>