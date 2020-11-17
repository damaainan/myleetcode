<?php declare(strict_types=1);
/*
63. 不同路径 II
难度
中等


一个机器人位于一个 m x n 网格的左上角 （起始点在下图中标记为“Start” ）。

机器人每次只能向下或者向右移动一步。机器人试图达到网格的右下角（在下图中标记为“Finish”）。

现在考虑网格中有障碍物。那么从左上角到右下角将会有多少条不同的路径？



网格中的障碍物和空位置分别用 1 和 0 来表示。

 

示例 1：


输入：obstacleGrid = [[0,0,0],[0,1,0],[0,0,0]]
输出：2
解释：
3x3 网格的正中间有一个障碍物。
从左上角到右下角一共有 2 条不同的路径：
1. 向右 -> 向右 -> 向下 -> 向下
2. 向下 -> 向下 -> 向右 -> 向右
示例 2：


输入：obstacleGrid = [[0,1],[0,0]]
输出：1
 

提示：

m == obstacleGrid.length
n == obstacleGrid[i].length
1 <= m, n <= 100
obstacleGrid[i][j] 为 0 或 1
通过次数108,974提交次数294,274
*/
function deal(array $obstacleGrid):int{
	$start_time = microtime(true);
	$start_memory = memory_get_usage(true);
	/***************代码开始*********************/
	$m = count($obstacleGrid);
	$n = count($obstacleGrid[0]);
	$dp = array_fill(0, $n, 0);
	$dp[0] = 1;

	for ($i=0; $i < $m; $i++) { 
		for ($j=1; $j < $n; $j++) { 
			if ($obstacleGrid[$i][$j] == 0){
				$dp[$j] = $dp[$j] + $dp[$j - 1];
			}
		}
	}
	$res = $dp[count($dp)-2];

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

echo deal([[0,0,0],[0,1,0],[0,0,0]]);