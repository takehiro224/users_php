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