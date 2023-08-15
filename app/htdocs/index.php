<?php
declare(strict_types=1);

// 共通部分の読込
require_once(dirname(__DIR__) . "/library/common.php");

startWriteLog("");

if(isPostMethod()) {
    // header("Location: " . "htdocs/" ."login.php");
    header("Location: " . "htdocs/login.php");
}

require_once(TEMPLATE_DIR . "index.php");

?>