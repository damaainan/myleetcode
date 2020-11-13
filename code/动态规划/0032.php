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
/*
解题思路

这里考虑使用栈来解决，思路类似于判定括号对是否匹配。

从前往后遍历字符串
一、入栈条件为1.栈为空 2.当前字符是'(' 3.栈顶符号位')'，因为三种条件都没办法消去成对的括号。
二、计算结果：符合消去成对括号时，拿当前下标减去栈顶下标即可

作者：dz-lee
链接：https://leetcode-cn.com/problems/longest-valid-parentheses/solution/jian-dan-yi-li-jie-yong-zhan-chu-li-python3-by-dz-/
来源：力扣（LeetCode）
著作权归作者所有。商业转载请联系作者获得授权，非商业转载请注明出处。
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


function deal2(string $str) :int {
    $start_time = microtime(true);
    $start_memory = memory_get_usage(true);
    /***************代码开始*********************/
    $len = strlen($str);
    $dp = array_fill(0, $len, 0);
    $max = 0;

    for ($i=1; $i < $len; $i++) {
        if($str[$i] == ")"){
            if($str[$i-1] == '('){
                $dp[$i] = 2;
                if($i - 2 > 0){
                    $dp[$i] = $dp[$i-2] + $dp[$i];
                }
            }else if($dp[$i-1]>0){
                if(($i-$dp[$i-1]-1) >= 0 && $str[$i - $dp[$i-1]-1] == '('){
                    $dp[$i] = $dp[$i-1]+2;
                    if($i - $dp[$i-1] - 2 >= 0){
                        $dp[$i] = $dp[$i] + $dp[$i - $dp[$i - 1] - 2];
                    }
                }
            }
        }
        $max = max($max, $dp[$i]);
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
echo deal2("(()");
echo "\r\n";
echo deal2(")()())");

