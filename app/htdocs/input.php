<?php
declare(strict_types=1);
// 共通処理読込
require_once(dirname(__DIR__) . '/library/common.php');

// ログインしていない場合はログイン画面へ遷移
if(!Auth::isLoggedIn()) {
    redirect("login.php");
}

$title = "社員登録";

$id = '';
$name = '';
$nameKana = '';
$birthday = '';
$gender = '';
$organization = '';
$post = '';
$startDate = '';
$tel = '';
$mailAddress = '';
$errorMessage = '';
$successMessage = '';
$isEdit = false;
$isSave = false;

/**
 * POST通信
 * A. (編集表示)「search.php画面」で「編集」ボタン: edit=1 
 * B. (新規登録)「input.php画面」で「登録」ボタン: edit=, save=1
 * C. (編集登録)「input.php画面」で「登録」ボタン: edit=1, save=1
 */
if (isPostMethod()) {
    
    // 「input.php画面」で「登録」ボタンが押されたかの判定
    $isSave = (isset($_POST['save']) && $_POST['save'] === "1") ? true : false;
    
    // 「search.php画面」で「編集」ボタンが押されたかの判定
    $isEdit = (isset($_POST["edit"]) && $_POST["edit"] === "1") ? true : false;

    // POSTデータを取得する
    $id = $_POST['id'] ?? '';
    $name = $_POST['name'] ?? '';
    $nameKana = $_POST['name_kana'] ?? '';
    $birthday = $_POST['birthday'] ?? '';
    $gender = $_POST['gender'] ?? '';
    $organization = $_POST['organization'] ?? '';
    $post = $_POST['post'] ?? '';
    $startDate = $_POST['start_date'] ?? '';
    $tel = $_POST['tel'] ?? '';
    $mailAddress = $_POST['mail_address'] ?? '';

    try {

        if($isEdit && $isSave) { // C. (編集登録)「input.php画面」で「登録」ボタン
            // 「社員番号」が空白でないか => ABC
            if (!validateRequired($id)) {
                throw new Exception("エラーが発生しました。もう一度やり直してください。");
            }
            // 「社員番号」が6桁か => ABC
            if (!validateId($id)) {
                $errorMessage .= 'エラーが発生しました。もう一度やり直してください。<br>';
            }
            // 「社員番号」が存在するか => AC
            if (!Users::isExists($id)) {
                $errorMessage .= 'エラーが発生しました。もう一度やり直してください。<br>';
            }
            // 「社員名」が空白でないか
            if (!validateRequired($name)) { //空白でないか
                $errorMessage .= '社員名を入力してください。<br>';
            }
            // 「社員名」が50文字以内か => BC
            if (!validateMaxLength($name, 50)) { //50文字以内か
                $errorMessage .= '社員名は50文字以内で入力してください。<br>';
            }
            // 「社員名カナ」が空白でないか => BC
            if (!validateRequired($nameKana)) { //空白でないか
                $errorMessage .= '社員名カナを入力してください。<br>';
            }
            // 「社員名カナ」が50文字以内か => BC
            if (!validateMaxLength($nameKana, 50)) { //50文字以内か
                $errorMessage .= '社員名カナは50文字以内で入力してください。<br>';
            }
            // 「生年月日」が空白でないか => BC
            if (!validateRequired($birthday)) { //空白でないか
                $errorMessage .= '生年月日を入力してください。<br>';
            }
            if (!validateDate($birthday)) {
                $errorMessage .= '生年月日を正しく入力してください。<br>';
            }
            // 「性別」が男性or女性か => BC
            if (!validateGender($gender)) {
                $errorMessage .= '性別を選択してください。<br>';
            }
            // 「部署」が選択肢に合致するか => BC
            if (!validateOrganization($organization)) {
                $errorMessage .= '部署を選択してください。<br>';
            }
            // 「役職」が選択肢に合致するか => BC
            if (!validatePost($post)) {
                $errorMessage .= '役職を選択してください。<br>';
            }
            // 「入社年月日」が空白でないか => BC
            if (!validateRequired($startDate)) { //空白でないか
                $errorMessage .= '入社年月日を入力してください。<br>';
            }
            // 「入社年月日」が正しい日付か => BC
            if (!validateDate($startDate)) {
                $errorMessage .= '入社年月日を正しく入力してください。<br>';
            }
            // 「電話番号」が空白でないか => BC
            if (!validateRequired($tel)) { //空白でないか
                $errorMessage .= '電話番号を入力してください。<br>';
            }
            // 「電話番号」が15桁の数値か => BC
            if (!validateTel($tel)) { //15桁以内の数値か
                $errorMessage .= '電話番号は15桁以内の数値で入力してください。<br>';
            }
            // 「メールアドレス」が空白でないか => BC
            if (!validateRequired($mailAddress)) { //空白でないか
                $errorMessage .= 'メールアドレスを入力してください。<br>';
            }
            // 「メールアドレス」の形式が正しいか => BC
            if (!validateMailAddress($mailAddress)) { //メールアドレス形式か
                $errorMessage .= 'メールアドレスを正しく入力してください。<br>';
            }

            // 更新処理 => C
            Users::update(
                $id,
                $name,
                $nameKana,
                $birthday,
                $gender,
                $organization,
                $post,
                $startDate,
                $tel,
                $mailAddress,
            );

        } elseif($isEdit) { // A. (編集表示)「search.php画面」で「編集」ボタン
            // 「社員番号」が空白でないか => ABC
            if (!validateRequired($id)) {
                // $errorMessage .= 'エラーが発生しました。もう一度やり直してください。<br>';
                throw new Exception("ユーザー情報を取得できませんでした");
            }
            // 「社員番号」が6桁か => ABC
            if (!validateId($id)) {
                $errorMessage .= 'ユーザー情報が不正';
            }
            // 「社員番号」が存在するか => AC
            if (!Users::isExists($id)) {
                $errorMessage .= 'ユーザー情報が存在しません';
            }
            // 社員情報取得
            $user = Users::getById($id);
            $id = $user['id'];
            $name = $user['name'];
            $nameKana = $user['name_kana'];
            $birthday = $user['birthday'];
            $gender = $user['gender'];
            $organization = $user['organization'];
            $post = $user['post'];
            $startDate = $user['start_date'];
            $tel = $user['tel'];
            $mailAddress = $user['mail_address'];

        } elseif($isSave) { // B. (新規登録)「input.php画面」で「登録」ボタン
            // 「社員番号」が空白でないか => ABC
            if (!validateRequired($id)) {
                $errorMessage .= 'エラーが発生しました。もう一度やり直してください。<br>';
            }
            // 「社員番号」が6桁か => ABC
            if (!validateId($id)) {
                $errorMessage .= 'エラーが発生しました。もう一度やり直してください。<br>';
            }
            // 「社員番号」が存在しないか
            if (Users::isExists($id)) {
                $errorMessage .= '登録不可のIDです';
            }
            // 「社員名」が空白でないか
            if (!validateRequired($name)) { //空白でないか
                $errorMessage .= '社員名を入力してください。<br>';
            }
            // 「社員名」が50文字以内か => BC
            if (!validateMaxLength($name, 50)) { //50文字以内か
                $errorMessage .= '社員名は50文字以内で入力してください。<br>';
            }
            // 「社員名カナ」が空白でないか => BC
            if (!validateRequired($nameKana)) { //空白でないか
                $errorMessage .= '社員名カナを入力してください。<br>';
            }
            // 「社員名カナ」が50文字以内か => BC
            if (!validateMaxLength($nameKana, 50)) { //50文字以内か
                $errorMessage .= '社員名カナは50文字以内で入力してください。<br>';
            }
            // 「生年月日」が空白でないか => BC
            if (!validateRequired($birthday)) { //空白でないか
                $errorMessage .= '生年月日を入力してください。<br>';
            }
            if (!validateDate($birthday)) {
                $errorMessage .= '生年月日を正しく入力してください。<br>';
            }
            // 「性別」が男性or女性か => BC
            if (!validateGender($gender)) {
                $errorMessage .= '性別を選択してください。<br>';
            }
            // 「部署」が選択肢に合致するか => BC
            if (!validateOrganization($organization)) {
                $errorMessage .= '部署を選択してください。<br>';
            }
            // 「役職」が選択肢に合致するか => BC
            if (!validatePost($post)) {
                $errorMessage .= '役職を選択してください。<br>';
            }
            // 「入社年月日」が空白でないか => BC
            if (!validateRequired($startDate)) { //空白でないか
                $errorMessage .= '入社年月日を入力してください。<br>';
            }
            // 「入社年月日」が正しい日付か => BC
            if (!validateDate($startDate)) {
                $errorMessage .= '入社年月日を正しく入力してください。<br>';
            }
            // 「電話番号」が空白でないか => BC
            if (!validateRequired($tel)) { //空白でないか
                $errorMessage .= '電話番号を入力してください。<br>';
            }
            // 「電話番号」が15桁の数値か => BC
            if (!validateTel($tel)) { //15桁以内の数値か
                $errorMessage .= '電話番号は15桁以内の数値で入力してください。<br>';
            }
            // 「メールアドレス」が空白でないか => BC
            if (!validateRequired($mailAddress)) { //空白でないか
                $errorMessage .= 'メールアドレスを入力してください。<br>';
            }
            // 「メールアドレス」の形式が正しいか => BC
            if (!validateMailAddress($mailAddress)) { //メールアドレス形式か
                $errorMessage .= 'メールアドレスを正しく入力してください。<br>';
            }
            // 登録処理 => B
            Users::insert(
                $id,
                $name,
                $nameKana,
                $birthday,
                $gender,
                $organization,
                $post,
                $startDate,
                $tel,
                $mailAddress,
            );
            
        }
    } catch (Exception $e) {
        $title = "エラー";
        $errorMessage = $e->getMessage();
        // TODO: エラー画面表示 
        // require_once(TEMPLATE_DIR . "error.php");
        // exit; //処理終了
    }

}

// 「search.php画面」で「社員登録」ボタンが押された場合 => 特に何もせず、空欄のある画面を表示する


// テンプレートの読込
require_once(TEMPLATE_DIR . "input.php");

?>