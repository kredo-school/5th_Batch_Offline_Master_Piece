<?php
if (!function_exists('highlightKeyword')) {
    function highlightKeyword($text, $keyword)
    {
        if (!$keyword) {
            return e($text); // キーワードがない場合はそのまま表示
        }

        // キーワード部分をハイライト
        return preg_replace(
            '/(' . preg_quote($keyword, '/') . ')/i',
            '<span style="background-color: #E1FFEB;">$1</span>',
            e($text)
        );
    }
}
?>
