<?php 
declare(strict_types=1);

class Session {

    /**
     * Sessionに値を設定する
     *
     * @param string $key
     * @param mixed $value 
     * @return void
     */
    public static function set(string $key, mixed $value): void
    {
        $_SESSION[$key] = $value;
    }

    /**
     * Sessionから指定のKeyの値を取得する
     *
     * @param string $key
     * @return mixed
     */
    public static function get(string $key): mixed
    {
        $value = null;
        if(isset($_SESSION[$key])) {
            $value = $_SERVER[$key];
        }
        return $value;
    }

    /**
     * sessionを開始する
     *
     * @param なし
     * @return なし
     */
    public static function start(): void
    {
        session_start();
    }

    /**
     * sessionに登録されたデータを全て破棄する
     *
     * @param なし
     * @return なし
     */
    public static function destroy(): void
    {
        // セッション変数の削除
        $_SESSION = [];
        
        session_destroy();
    }

    /**
     * 現在のsession_idを新しく生成したものと置き換える
     *
     * @param なし
     * @return なし
     */
    public static function regenerate(): void
    {
        session_regenerate_id(true);
    }

}
?>