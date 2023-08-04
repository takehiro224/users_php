<?php
declare(strict_types=1);

class Database
{
    // インスタンス(Singlton)
    private static PDO $pdo;

    // コンストラクタ
    private function __construct() {}

    /**
     * PDOインスタンス取得
     *
     * @return PDO
     */
    private static function getInstance(): PDO
    {
        if(!isset(self::$pdo)) {
            /** 
             * 1. <データベース種別>:host=<ホスト名>;dbname=<使用するDB名>;charset=utf8
             * 2. DBユーザー名 
             * 3. DBパスワード
            */
            $dsnBase = "%s:host=%s;dbname=%s;charset=utf8";
            $dsn = sprintf($dsnBase, DB_KIND, DB_HOST, DB_NAME);
            self::$pdo = new PDO($dsn, DB_USER, DB_PASS);
        }
        return self::$pdo;
    }

    /**
     * トランザクション開始
     *
     * @return void
     */
    public static function beginTransaction(): void
    {
        if(self::getInstance()->inTransaction()) {
            // 現在トランザクション中であれば終了
            return;
        } else {
            // トランザクション中でない場合はトランザクションを開始
            self::getInstance()->beginTransaction();
        }
    }

    /**
     * コミット実行
     *
     * @return void
     */
    public static function commit(): void
    {
        if(self::getInstance()->inTransaction()) {
            // トランザクション中の場合コミット
            self::getInstance()->commit();
        } else {
            // トランザクション中ではない場合は終了
            return;
        }
    }

    /**
     * ロールバック実行
     *
     * @return void
     */
    public static function rollback(): void
    {
        if(self::getInstance()->inTransaction()) {
            // トランザクション中の場合ロールバック
            self::getInstance()->rollBack();
        } else {
            // トランザクション中ではない場合は終了
            return;
        }
    }

    /**
     * SQLの実行結果を返す(結果が1行の場合)
     *
     * @param string $sql SQL文
     * @param array $param SQLパラメータ
     * @return array | bool 実行結果
     */
    public static function fetch(string $sql, array $param = []): array | bool
    {
        $stmt = self::getInstance()->prepare($sql);
        $stmt->execute($param);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * SQLの実行結果を返す(結果が複数行の場合)
     *
     * @param string $sql SQL文
     * @param array $param SQLパラメータ
     * @return array 実行結果(複数)
     */
    public static function fetchAll(string $sql, array $param = []): array
    {
        $stmt = self::getInstance()->prepare($sql);
        $stmt->execute($param);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * SQLを実行する
     *
     * @param string $sql SQL文
     * @param array $param SQLパラメータ
     * @return boolean SQL実行結果
     */
    public static function execute(string $sql, array $param = []): bool
    {
        $stmt = self::getInstance()->prepare($sql);
        return $stmt->execute($param);
    }
}
?>