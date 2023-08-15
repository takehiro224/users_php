<?php
declare(strict_types=1);

// 共通部分の読込
require_once(dirname(__DIR__) . "/library/common.php");

// ログインしていない場合はログイン画面へ遷移
if(!Auth::isLoggedIn()) {
    redirect("login.php");
}

writeLog("【表示】検索画面");

$errorMessage = '';
$successMessage = "";

$id = '';
$nameKana = '';
$gender = '';

$count = 0;
$data = '';
$title = "社員検索";


// POST送信判定
if(isPostMethod()) {

    // POSTデータを取得する
    $deleteId = isset($_POST['id']) ? $_POST['id'] : '';

    // 削除処理
    $isDelete = (isset($_POST['delete']) && $_POST['delete'] === '1') ? true : false;
    if($isDelete) {
        writeLog("【開始】社員情報削除");
        try {
            // throw new Exception("エラーサンプル");
            if (!validateRequired($deleteId)) { //空白でないか
                throw new Exception("社員番号が不正です。");
            }
            if (!validateId($deleteId)) { //6桁の数値か
                throw new Exception("社員番号が不正です。");
            }
            if (!Users::isExists($deleteId)) {
                throw new Exception("社員番号が不正です。");
            }
            //トランザクション開始
            DataBase::beginTransaction();
            //社員情報の削除
            Users::deleteById($deleteId);
            //コミット
            DataBase::commit();
    
            $successMessage = "削除完了しました。";
            writeLog("【終了】社員情報削除");

        } catch (Exception $e) {
            $errorMessage = $e->getMessage() . '<br>';
            $title = "エラー";
            writeLog("【エラー】社員情報削除");
        } finally {
            // 件数取得SQLの実行
            $count = Users::searchCount('', '', '');

            // 社員情報取得SQLの実行   
            $data = Users::searchData('', '', '');
        }
    }
}

// GET送信判定
if(isGetMethod()) {
    // 「検索ボタン」タップ時の処理
    writeLog("【開始】社員情報検索");
    $id = $_GET['id'] ?? '';
    $nameKana = $_GET['name_kana'] ?? '';
    $gender = $_GET['gender'] ?? '';

    // 件数取得SQLの実行
    $count = Users::searchCount($id, $nameKana, $gender);

    // 社員情報取得SQLの実行   
    $data = Users::searchData($id, $nameKana, $gender);
    writeLog("【終了】社員情報検索");
}


// search画面を読込
require_once(TEMPLATE_DIR . "search.php");

?>