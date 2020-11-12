<?php declare(strict_types=1);
/*
32. 最长有效括号

困难

给定一个只包含 '(' 和 ')' 的字符串，找出最长的包含有效括号的子串的长度。

示例 1:

输入: "(()"
输出: 2
解释: 最长有效括号子串为 "()"
示例 2:

输入: ")()())"
输出: 4
解释: 最长有效括号子串为 "()()"
通过次数111,222提交次数326,676
*/
function deal(string $str) :int {
    $start_time = microtime(true);
    $start_memory = memory_get_usage(true);
    /***************代码开始*********************/
    $arr[] = -1; // 0 时
    $max = 0;
    for ($i=0; $i < strlen($str); $i++) {
        if($str[$i] == "("){
            $arr[] = $i;
        }else{
            array_pop($arr);
            if(count($arr) == 0){
                $arr[] = $i;
            }else{
                $max = max($max, $i - $arr[count($arr) - 1]);
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
    return $max;
}
echo deal("(()");
echo "\r\n";
echo deal(")()())");