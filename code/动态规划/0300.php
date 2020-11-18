<?php declare(strict_types=1);
/*
300. 最长上升子序列
难度
中等

给定一个无序的整数数组，找到其中最长上升子序列的长度。

示例:

输入: [10,9,2,5,3,7,101,18]
输出: 4 
解释: 最长的上升子序列是 [2,3,7,101]，它的长度是 4。
说明:

可能会有多种最长上升子序列的组合，你只需要输出对应的长度即可。
你算法的时间复杂度应该为 O(n2) 。
进阶: 你能将算法的时间复杂度降低到 O(n log n) 吗?

通过次数169,117提交次数372,713
*/
function deal(array $nums):int{
	$start_time = microtime(true);
    /***************代码开始*********************/
    $len = count($nums);
    if ($len <= 1){
        return $len;
    }
    $dp = array_fill(0,$len + 1, 1); // 初始值为 1 
    // $dp[0] = 1;
	for ($i=1; $i < $len; $i++) { 
        for ($j=0; $j < $i; $j++) { 
            if($nums[$i] > $nums[$j]){
                $dp[$i] = max($dp[$i], $dp[$j]+1);
            }
        }
    }
    $res = max($dp);

	/***************代码结束*******************/
	/***********性能监控***********************/ 
	$end_time = microtime(true);
	$need_time = $end_time - $start_time;
	print_r("耗时:" . $need_time . "\r\n");
	/*******************************************/
	return $res;
}
echo deal([10,9,2,5,3,7,101,18]);
echo "\r\n\r\n";