<?php
declare(strict_types=1);

class Users
{
    /**
     * 社員の存在チェック
     *
     * @param string $id 社員番号
     * @return boolean true: 存在する
     */
    public static function isExists(string $id): bool
    {
        $sql = "SELECT COUNT(*) AS count FROM users WHERE id = :id";
        $param = ["id" => $id];
        $count = Database::fetch($sql, $param);
        if($count["count"] >= 1) {
            return true;
        }
        return false;
    }

    /**
     * 社員情報を取得する
     *
     * @param string $id
     * @return array
     */
    public static function getById(string $id): array
    {
        $sql = "SELECT * FROM users WHERE id = :id";
        $param = ["id" => $id];
        return Database::fetch($sql, $param);
    }

    /**
     * 社員情報を削除する
     *
     * @param string $id 社員番号
     * @return boolean SQL実行結果
     */
    public static function deleteById(string $id): bool
    {
        $sql = "DELETE FROM users WHERE id = :id";
        $param = ["id" => $id];
        return Database::execute($sql, $param);
    }

    /**
     * 検索条件SQL生成
     *
     * @param string $id 社員番号
     * @param string $nameKana 氏名カナ
     * @param string $gender 性別
     * @return array 検索条件SQL
     */
    private static function getSearchWhereSqlAndParam(string $id, string $nameKana, string $gender): array
    {
        $whereSql = '';
        $param = [];

        // 検索条件に社員番号が入力されている場合はSQLの条件式に社員番号を追加
        if($id !== '') {
            $whereSql .= 'AND id = :id ';
            $param['id'] = $id;
        }
        // 検索条件に社員名カナが入力されている場合はSQLの条件式に社員名カナを追加
        if($nameKana !== '') {
            $whereSql .= 'AND name_kana = :name_kana ';
            $param['name_kana'] = $nameKana . '%';
        }
        // 検索条件に性別が入力されている場合はSQLの条件式に性別を追加
        if ($gender !== '') {
            $whereSql .= 'AND gender = :gender ';
            $param['gender'] = $gender;
        }
        return [$whereSql, $param];
    }


    /**
     * 検索条件に合致した社員件数を取得
     *
     * @param string $id 社員番号
     * @param string $nameKana 氏名カナ
     * @param string $gender 性別
     * @return int 社員件数
     */
    public static function searchCount(string $id, string $nameKana, string $gender): int
    {
        list($whereSql, $param) = self::getSearchWhereSqlAndParam($id, $nameKana, $gender);
        $sql = "SELECT COUNT(*) AS count FROM users WHERE 1 = 1 {$whereSql}";
        $count = Database::fetch($sql, $param);
        return $count["count"];
    }

    /**
     * 検索条件に合致した社員情報を取得する
     *
     * @param string $id 社員番号
     * @param string $nameKana 氏名カナ
     * @param string $gender 性別
     * @return array 社員情報
     */
    public static function searchData(string $id, string $nameKana, string $gender): array
    {
        list($whereSql, $param) = self::getSearchWhereSqlAndParam($id, $nameKana, $gender);       
        $sql = "SELECT * FROM users WHERE 1 = 1 {$whereSql} ORDER BY id";
        return Database::fetchAll($sql, $param);
    }
}