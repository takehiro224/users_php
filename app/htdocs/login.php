<?php
declare(strict_types=1);

// 共通部分の読込
require_once(dirname(__DIR__) . "/library/common.php");

$message = "";

// POSTメソッドか判定: ログイン実行
if(isPostMethod()) {
    $loginId = $_POST["login_id"] ?? "";
    $password = $_POST["password"] ?? "";
}

require_once(TEMPLATE_DIR . "login.php");
?>