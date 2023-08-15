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

    /**
     * 社員情報を登録する
     *
     * @param string $id 社員番号
     * @param string $name 氏名
     * @param string $nameKana 氏名カナ
     * @param string $birthday 誕生日
     * @param string $gender 性別
     * @param string $organization 部署
     * @param string $post 役職
     * @param string $startDate 入社年月日
     * @param string $tel 電話番号
     * @param string $mailAddress メールアドレス
     * @return bool SQL実行結果
     */
    public static function insert(
        string $id,
        string $name,
        string $nameKana,
        string $birthday,
        string $gender,
        string $organization,
        string $post,
        string $startDate,
        string $tel,
        string $mailAddress
    ): bool
    {
        // SQLを作成
        $sql  = "INSERT INTO users ( ";
        $sql .= "  id, ";
        $sql .= "  name, ";
        $sql .= "  name_kana, ";
        $sql .= "  birthday, ";
        $sql .= "  gender, ";
        $sql .= "  organization, ";
        $sql .= "  post, ";
        $sql .= "  start_date, ";
        $sql .= "  tel, ";
        $sql .= "  mail_address, ";
        $sql .= "  created, ";
        $sql .= "  updated ";
        $sql .= ") VALUES (";
        $sql .= "  :id, ";
        $sql .= "  :name, ";
        $sql .= "  :name_kana, ";
        $sql .= "  :birthday, ";
        $sql .= "  :gender, ";
        $sql .= "  :organization, ";
        $sql .= "  :post, ";
        $sql .= "  :start_date, ";
        $sql .= "  :tel, ";
        $sql .= "  :mail_address, ";
        $sql .= "  NOW(), "; //作成日時
        $sql .= "  NOW() ";  //更新日時
        $sql .= ")";

        // パラメータを格納
        $param = [
            "id" => $id,
            "name" => $name,
            "name_kana" => $nameKana,
            "birthday" => $birthday,
            "gender" => $gender,
            "organization" => $organization,
            "post" => $post,
            "start_date" => $startDate,
            "tel" => $tel,
            "mail_address" => $mailAddress,
        ];

        // SQLを実行し結果を返却
        return DataBase::execute($sql, $param);
    }

    /**
     * 社員情報を更新する
     *
     * @param string $id 社員番号
     * @param string $name 氏名
     * @param string $nameKana 氏名カナ
     * @param string $birthday 誕生日
     * @param string $gender 性別
     * @param string $organization 部署
     * @param string $post 役職
     * @param string $startDate 入社年月日
     * @param string $tel 電話番号
     * @param string $mailAddress メールアドレス
     * @return bool SQL実行結果
     */
    public static function update(
        string $id,
        string $name,
        string $nameKana,
        string $birthday,
        string $gender,
        string $organization,
        string $post,
        string $startDate,
        string $tel,
        string $mailAddress
    ): bool {
        $sql  = "UPDATE users ";
        $sql .= "SET name = :name, ";
        $sql .= "  name_kana = :name_kana, ";
        $sql .= "  birthday = :birthday, ";
        $sql .= "  gender = :gender, ";
        $sql .= "  organization = :organization, ";
        $sql .= "  post = :post, ";
        $sql .= "  start_date = :start_date, ";
        $sql .= "  tel = :tel, ";
        $sql .= "  mail_address = :mail_address, ";
        $sql .= "  updated = NOW() "; //更新日時
        $sql .= "WHERE id = :id ";

        $param = [
            "id" => $id,
            "name" => $name,
            "name_kana" => $nameKana,
            "birthday" => $birthday,
            "gender" => $gender,
            "organization" => $organization,
            "post" => $post,
            "start_date" => $startDate,
            "tel" => $tel,
            "mail_address" => $mailAddress,
        ];
        return DataBase::execute($sql, $param);
    }
}