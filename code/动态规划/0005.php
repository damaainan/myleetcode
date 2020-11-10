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
 *
 * 动态规划
 *
 * 时间复杂度：O(n^2)
 * 空间复杂度：O(n^2)
 */
function deal(string $str):string{
    $start_time = microtime(true);
    $start_memory = memory_get_usage(true);
    /***************代码开始*********************/
    if (strlen($str) == 0 ) return -1;
    if (strlen($str) == 1 ) return $str;
    $res = "";

    $len = strlen($str);
    $dp = array_fill(0, $len+2, array_fill(0, $len+2, 0));
    for ($i=1; $i <= $len; $i++) {
        for ($j=0; $j < $len; $j++) {
            $end = $j + $i - 1;
            if ($end >= $len) {
                break;
            }
            $dp[$j][$end] = ($i == 1 || $i == 2 || $dp[$j+1][$end-1]) && $str[$j] == $str[$end];
            if($dp[$j][$end] && $i > strlen($res)){
                $res = substr($str, $j, $i);
            }
        }
    }


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
    return $res;
}
echo(deal("babad"));
echo "\r\n";
echo(deal("cbbd"));

/**
 * 中心扩展法
 * 时间复杂度：O(n^2)
 * 空间复杂度：O(1)
 */
function deal2(string $str):string{
    $start_time = microtime(true);
    $start_memory = memory_get_usage(true);
    /***************代码开始*********************/
    $res = "";
    $len = strlen($str);
    $end = 2 * $len - 1;
    for ($i=0; $i < $end; $i++) {
        $mid = $i / 2;
        $p = (int)floor($mid);
        $q = (int)ceil($mid);

        while ($p>=0 && $q < $len) {
            if($str[$p] != $str[$q]) break;
            $p--;
            $q++;
        }
        $l = $q- $p - 1;
        if($l > strlen($res))
            $res = substr($str, $p+1, $l);
    }



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
    return $res;
}
echo(deal2("babad"));
echo "\r\n";
echo(deal2("cbbd"));

/**
 * 马拉车算法  Manacher
 * 时间复杂度：O(n)
 * 空间复杂度：O(n)
 */
function deal3(string $str):string{
    $start_time = microtime(true);
    $start_memory = memory_get_usage(true);
    /***************代码开始*********************/
    $res = "";
    $len = strlen($str);

    if ($str == "") return "";
    $len = strlen($str);
    if($len == 1 || $str == strrev($str)) return $str;

    $mlen = 1;
    $start = 0;
    for ($i=1; $i < $len; $i++) {
        $even = substr($str, $i-$mlen, $mlen+1);
        $odd = substr($str, $i-$mlen-1, $mlen+2);

        if($i - $mlen - 1 >= 0 && $odd == strrev($odd)){
            $start = $i - $mlen - 1;
            $mlen += 2;
            continue;
        }
        if($i-$mlen >= 0 && $even == strrev($even)){
            $start = $i - $mlen;
            $mlen += 1;
            continue;
        }
    }
    $res = substr($str, $start, $mlen);




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
    return $res;
}
echo(deal3("babad"));
echo "\r\n";
echo(deal3("cbbd"));

/**
 * 思路是，因为题目要的最长回文，所以不用验证更短的子串了。

或者说，就是以尾座标为标志进行验证，也不用担心错过更长的结果。效果是只需遍历一次。时间空间都是双百
 */
function deal4(string $str):string{
    $start_time = microtime(true);
    $start_memory = memory_get_usage(true);
    /***************代码开始*********************/
    $res = "";
    $len = strlen($str);

    if ($str == "") return "";
    $len = strlen($str);
    if($len == 1 || $str == strrev($str)) return $str;

    $mlen = 1;
    $start = 0;
    for ($i=1; $i < $len; $i++) {
        $even = substr($str, $i-$mlen, $mlen+1);
        $odd = substr($str, $i-$mlen-1, $mlen+2);

        if($i - $mlen - 1 >= 0 && $odd == strrev($odd)){
            $start = $i - $mlen - 1;
            $mlen += 2;
            continue;
        }
        if($i-$mlen >= 0 && $even == strrev($even)){
            $start = $i - $mlen;
            $mlen += 1;
            continue;
        }
    }
    $res = substr($str, $start, $mlen);




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
    return $res;
}
echo(deal4("babad"));
echo "\r\n";
echo(deal4("cbbd"));