<?php
declare(strict_types=1);

/**
 * 必須チェック
 *
 * @param string $str
 * @return boolean true: OK, false: 未入力
 */
function validateRequired(string $str): bool
{
    if($str === '') {
        return false;
    }
    return true;
}

/**
 * 数値判定
 *
 * @param string $str
 * @return boolean true: 数値のみ
 */
function validateNumeric(string $str): bool
{
    if(preg_match('/\A[0-9]+\z/', $str)) {
        return true;
    }
    return false;
}

/**
 * 最大文字数判定
 *
 * @param string $str 被判定文字列
 * @param integer $length 最大文字数
 * @return boolean true: 最大文字数内
 */
function validateMaxlength(string $str, int $length): bool
{
    return mb_strlen($str, "UTF-8") <= $length;
}

/**
 * 指定文字数チェック
 *
 * @param string $str
 * @param integer $minLength 最小文字数
 * @param integer $maxLength 最大文字数
 * @return boolean true: 指定文字数内に収まっている
 */
function validateBetweenLength(string $str, int $minLength, int $maxLength): bool
{
    $length = mb_strlen($str, "UTF-8");
    return ($length >= $minLength && $length <= $maxLength);
}

/**
 * 社員番号チェック
 *
 * @param string $str 社員番号
 * @return boolean true: 社員番号として適切
 */
function validateId(string $str): bool
{
    if(validateNumeric($str) && validateBetweenLength($str, 6, 6)) {
        return true;
    }
    return false;
}

/**
 * 日付フォーマットチェック(yyyy-MM-dd)
 *
 * @param string $str
 * @return boolean true: 日付として正しい
 */
function validateDate(string $str): bool
{
    // 日付のフォーマットになっているか判定
    if(preg_match('/\A[0-9]{4}-[0-9]{2}-[0-9]{2}\z/', $str)) {
        list($year, $month, $day) = explode('-', $str);
        if(checkdate((int)$year, (int)$month, (int)$day)) {
            return true;
        }
        return false;
    }
    return false;
}

/**
 * 電話番号チェック(15桁以内の数値かどうか)
 *
 * @param string $str
 * @return boolean true: 電話番号(15桁以内)
 */
function validateTel(string $str): bool
{
    if(validateNumeric($str) && validateMaxlength($str, 15)) {
        return true;
    }
    return false;
}

/**
 * メールアドレスフォーマットチェック
 *
 * @param string $str
 * @return boolean true: メールアドレスとして正しい
 */
function validateMailAddress(string $str): bool
{
    if(preg_match('/\A([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}\z/iD', $str)) {
        return true;
    }
    return false;
}

/**
 * 性別チェック
 *
 * @param string $str
 * @return boolean true: 性別がリストと合致している
 */
function validateGender(string $str): bool
{
    if(in_array($str, GENDER_LISTS)) {
        return true;
    }
    return false;
}

/**
 * 部署チェック
 *
 * @param string $str
 * @return boolean
 */
function validateOrganization(string $str): bool
{
    if(in_array($str, ORGANIZATION_LISTS)) {
        return true;
    }
    return false;
}

/**
 * 役職チェック
 *
 * @param string $str
 * @return boolean
 */
function validatePost(string $str): bool
{
    if(in_array($str, POST_LISTS)) {
        return true;
    }
    return false;
}