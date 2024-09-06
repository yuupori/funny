<?php
session_start();
require_once '../classes/UserLogic1.php';


$result = UserLogic::checkLogin();
if($result) {
  header('Location: home1.php');
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
    <link rel="stylesheet" href="style.css">
    <title>Funny-Gommy</title>
</head>
<body bgcolor="skyblue">



    <div class="tab_wrap">
    <input id="tab1" type="radio" name="tab_btn" checked>
    <input id="tab2" type="radio" name="tab_btn">
                

    <div class="tab_area">
        <label class="tab1_label" for="tab1">管理者</label>
        <label class="tab2_label" for="tab2">従業員</label>
    </div>

    <div class="panel_area">
        
        <?php if (isset($err['msg'])) : ?>
        <p><?php echo $err['msg']; ?></p>
        <?php endif; ?>
        <form action="login.php" method="POST">
        <p>
        <div id="panel1" class="tab_panel">
            <center><h2>管理者</h2></center>
        <p><label for="email">メールアドレス</label><br>
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
        <input type="submit" value="ログイン1">
        </p>
                    
                    
    </div>
                    
    <div class="panel_area1">
        <?php if (isset($err['msg'])) : ?>
        <p><?php echo $err['msg']; ?></p>
        <?php endif; ?>
        <form action="../public1/login1.php" method="POST">
        <p>
        <div id="panel2" class="tab_panel">
            <center><h2>従業員</h2></center>
        <p><label for="email">メールアドレス</label><br>
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
    </div>
    </div>
            

           
           
            
            
          
        <br><br><br><br><br>
      
      <!-- Header End -->

      
  
    


 
    
</body>

  
</html>