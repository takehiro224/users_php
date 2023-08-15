<?php
declare(strict_types=1);

// 共通部分の読込
require_once(dirname(__DIR__) . "/library/common.php");

writeLog("【表示】ログイン画面");

$loginId = "";
$password = "";
$errorMessage = "";

// POSTメソッドか判定: ログイン実行
if(isPostMethod()) {
    $loginId = $_POST["login_id"] ?? "";
    $password = $_POST["password"] ?? "";
    if(Auth::login($loginId, $password)) {
        // ログイン成功
        redirect("search.php");
    } else {
        // ログイン失敗
        $errorMessage .= "ログインID、又はパスワードに誤りがあります。";
    }
}

require_once(TEMPLATE_DIR . "login.php");
?>