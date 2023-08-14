<?php
/**
 * POST通信かを判定する
 *
 * @return boolean true:POST通信／false:POST通信以外
 */
function isPostMethod(): bool
{
    return mb_strtolower($_SERVER['REQUEST_METHOD']) === 'post';
}

/**
 * GET通信判定
 *
 * @return boolean true:GET通信／false:GET通信以外
 */
function isGetMethod(): bool
{
    return mb_strtolower($_SERVER['REQUEST_METHOD']) === 'get';
}

/**
 * 強制リダイレクト
 * 画面遷移で利用する
 *
 * @param string $url
 * @return void
 */
function redirect(string $url): void
    {
        header("Location: {$url}");
    }
?>