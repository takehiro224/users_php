<?php
declare(strict_types=1);

// 共通部分の読込
require_once(dirname(__DIR__) . "/library/common.php");

// TODO: ログインしていない場合はログイン画面へ遷移

$errorMessage = '';
$successMessage = "";

$id = '';
$nameKana = '';
$gender = '';

$count = 0;
$data = '';
$title = "社員検索";


// TODO: POST送信判定

/**
 * $id
 * $nameKana
 * $gender
 * $count
 * $data
 */
// 検索ボタンタップ時の処理を記載
if(isGetMethod()) {
    $id = $_GET['id'] ?? '';
    $nameKana = $_GET['name_kana'] ?? '';
    $gender = $_GET['gender'] ?? '';

    // TODO: 件数取得SQLの実行
    
    
}


// TODO: 社員情報取得SQLの実行

// search画面を読込
require_once(TEMPLATE_DIR . "search.php");

?>