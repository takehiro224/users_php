<?php 
/**
 * ログイン機能を提供するクラス
 */
class Auth {

    /**
     * IDからユーザーデータを取得する
     *
     * @param string $id ログインID
     * @return array | bool SQL実行結果配列
     */
    public static function getAccountByLoginId(string $id): array | bool
    {
        $sql = "SELECT * FROM login_accounts WHERE login_id = :login_id";
        $param = ["login_id", $id];
        return Database::fetch($sql, $param);
    }

    /**
     * ログイン実行
     *
     * @param string $id ログインID
     * @param string $password パスワード
     * @return boolean ログイン結果
     */
    public static function login(string $id, string $password): bool
    {
        // DBへIDに紐づくデータを取得する
        $account = self::getAccountByLoginId($id);
        if(empty($account["id"])) { 
            // DBに指定のIDのデータがないためにfalse
            return false;
        }
        $result = password_verify($password, $account["password"]);
        if($result === false) {
            // IDに紐づくパスワードが一致しなかったためにfalse
            return false;
        }
        Session::regenerate();
        Session::set("id", $account["id"]);
        Session::set("login_id", $account["login_id"]);
        Session::set("name", $account["name"]);
        // ログイン成功
        return true;
    }






}


?>