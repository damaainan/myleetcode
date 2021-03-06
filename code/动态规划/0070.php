<?php declare(strict_types=1);
/*
70. 爬楼梯
难度
简单

假设你正在爬楼梯。需要 n 阶你才能到达楼顶。

每次你可以爬 1 或 2 个台阶。你有多少种不同的方法可以爬到楼顶呢？

注意：给定 n 是一个正整数。

示例 1：

输入： 2
输出： 2
解释： 有两种方法可以爬到楼顶。
1.  1 阶 + 1 阶
2.  2 阶
示例 2：

输入： 3
输出： 3
解释： 有三种方法可以爬到楼顶。
1.  1 阶 + 1 阶 + 1 阶
2.  1 阶 + 2 阶
3.  2 阶 + 1 阶
通过次数318,155提交次数625,425
*/
function deal(int $n):int{
	$start_time = microtime(true);
	/***************代码开始*********************/
	$dp = array_fill(0, $n, 0);
	$dp[0] = 1;
	$dp[1] = 2;
	for ($i=2; $i < $n; $i++) { 
		$dp[$i] = $dp[$i-1] + $dp[$i - 2];
	}
	$res = array_pop($dp);
	/***************代码结束*******************/
	/***********性能监控***********************/ 
	$end_time = microtime(true);
	$need_time = $end_time - $start_time;
	print_r("耗时:" . $need_time . "\r\n");
	/*******************************************/
	return $res;
}
echo deal(2);
echo "\r\n\r\n";
echo deal(3);