<?php

require_once '../dbconnect.php';

class UserLogic
{
  /**
   * ユーザを登録する
   * @param array $gomiData
   * @return bool $result
   */
  public static function createUser($gomiData)
  {
    $result = false;

    $sql = 'INSERT INTO gomi_login (name, email, password) VALUES (?, ?, ?)';

    // ユーザデータを配列に入れる
    $arr = [];
    $arr[] = $gomiData['username'];
    $arr[] = $gomiData['email'];
    $arr[] = password_hash($gomiData['password'], PASSWORD_DEFAULT);

    try {
      $stmt = connect()->prepare($sql);
      $result = $stmt->execute($arr);
      return $result;
    } catch(\Exception $e) {
      echo $e; // エラーを出力
      error_log($e, 3, '../error.log'); //ログを出力
      return $result;
    }
  }

  /**
   * ログイン処理
   * @param string $email
   * @param string $password
   * @return bool $result
   */
  public static function login($email, $password)
  {
    // 結果
    $result = false;
    // ユーザをemailから検索して取得
    $gomi = self::getUserByEmail($email);

    if (!$gomi) {
      $_SESSION['msg'] = 'emailが一致しません。';
      return $result;
    }

    //　パスワードの照会
    if (password_verify($password, $gomi['password'])) {
      //ログイン成功
      session_regenerate_id(true);
      $_SESSION['login_gomi'] = $gomi;
      $result = true;
      return $result;
    }

    $_SESSION['msg'] = 'パスワードが一致しません。';
    return $result;
  }

  /**
   * emailからユーザを取得
   * @param string $email
   * @return array|bool $gomi|false
   */
  public static function getUserByEmail($email)
  {
    // SQLの準備
    // SQLの実行
    // SQLの結果を返す
    $sql = 'SELECT * FROM gomi_login WHERE email = ?';

    // emailを配列に入れる
    $arr = [];
    $arr[] = $email;

    try {
      $stmt = connect()->prepare($sql);
      $stmt->execute($arr);
      // SQLの結果を返す
      $gomi = $stmt->fetch();
      return $gomi;
    } catch(\Exception $e) {
      return false;
    }
  }

  
  public static function checkLogin()
  {
    $result = false;

    // セッションにログインユーザが入っていなかったらfalse
    if (isset($_SESSION['login_gomi']) && $_SESSION['login_gomi']['id'] > 0) {
      return $result = true;
    }

    return $result;

  }

  /**
   * ログアウト処理
   */
  public static function logout()
  {
    $_SESSION = array();
    session_destroy();
  }

}

