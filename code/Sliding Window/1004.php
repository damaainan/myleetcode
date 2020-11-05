<?php declare(strict_types=1);
/*
给定一个由若干 0 和 1 组成的数组 A，我们最多可以将 K 个值从 0 变成 1 。

返回仅包含 1 的最长（连续）子数组的长度。



示例 1：

输入：A = [1,1,1,0,0,0,1,1,1,1,0], K = 2
输出：6
解释：
[1,1,1,0,0,1,1,1,1,1,1]
粗体数字从 0 翻转到 1，最长的子数组长度为 6。
示例 2：

输入：A = [0,0,1,1,0,0,1,1,1,0,1,1,0,0,0,1,1,1,1], K = 3
输出：10
解释：
[0,0,1,1,1,1,1,1,1,1,1,1,0,0,0,1,1,1,1]
粗体数字从 0 翻转到 1，最长的子数组长度为 10。


提示：

1 <= A.length <= 20000
0 <= K <= A.length
A[i] 为 0 或 1

*/
/**
 * 最大连续1的个数 III
 * @param  array $arr
 * @param  int $k
 * @return int
 */
function deal(array $arr, int $k):int{
    $start_time = microtime(true);
    $start_memory = memory_get_usage(true);
    /***************代码开始*********************/
    $len = count($arr);
    $i = 0;
    $j = 0;
    $res = 0;

    for ($i=0; $i < $len; $i++) {
        if($arr[$i] == 0){
            if($k > 0){
                $k--;
            }else{
                $res = max($res, $i-$j);
                while($arr[$j++] == 1){};
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
    return max($res, $i-$j);
}

echo deal([1,1,1,0,0,0,1,1,1,1,0], 2);
echo "\n*************\n";
echo deal([0,0,1,1,0,0,1,1,1,0,1,1,0,0,0,1,1,1,1], 3);
echo "\n*************\n";
echo deal([1,1,1,0,0,0,1,1,1,1,0,0,1,1,1,1], 2);