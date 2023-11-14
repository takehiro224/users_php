<?php
declare(strict_types=1);

// 共通部分の読込
require_once(dirname(__DIR__) . "/library/common.php");

startWriteLog("");

if(isPostMethod()) {
    // htdocs/login.phpを実行 => template/login.phpを表示
    header("Location: " . "htdocs/login.php");
}
// template/index.phpを表示
require_once(TEMPLATE_DIR . "index.php");

?>