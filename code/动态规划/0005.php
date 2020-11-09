<?php declare(strict_types=1);
/*
给定一个字符串 s，找到 s 中最长的回文子串。你可以假设 s 的最大长度为 1000。

示例 1：

输入: "babad"
输出: "bab"
注意: "aba" 也是一个有效答案。
示例 2：

输入: "cbbd"
输出: "bb"
*/
/**
 * 最长回文子串
 * @return [type] [description]
 */
function deal(string $str):string{
    $start_time = microtime(true);
    $start_memory = memory_get_usage(true);
    /***************代码开始*********************/
    if (len($str) == 0 ) return -1;
    if (len($str) == 1 ) return $str;



    /***************代码结束*******************/
    /***********性能监控***********************/
    $end_time = microtime(true);
    $need_time = $end_time - $start_time;
    $end_memory = memory_get_usage(true);
    $memory_peak = memory_get_peak_usage(true);
    print_r("耗时:" . $need_time . "\r\n");
    print_r("开始内存:" . $start_memory . "\r\n");
    print_r("结束内存:" . $end_memory . "\r\n");
    print_r("峰值内存:" . $memory_peak . "\r\n");
    /*******************************************/
    return ;
}
echo(deal("babad"));
echo "****";
echo(deal("cbbd"));