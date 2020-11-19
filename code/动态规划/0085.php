<?php declare(strict_types=1);
/*
85. 最大矩形
难度
困难

649

给定一个仅包含 0 和 1 、大小为 rows x cols 的二维二进制矩阵，找出只包含 1 的最大矩形，并返回其面积。

[["1","0","1","0","0"],
 ["1","0","1","1","1"],
 ["1","1","1","1","1"],
 ["1","0","0","1","0"]]

示例 1：


输入：matrix = [["1","0","1","0","0"],["1","0","1","1","1"],["1","1","1","1","1"],["1","0","0","1","0"]]
输出：6
解释：最大矩形如上图所示。
示例 2：

输入：matrix = []
输出：0
示例 3：

输入：matrix = [["0"]]
输出：0
示例 4：

输入：matrix = [["1"]]
输出：1
示例 5：

输入：matrix = [["0","0"]]
输出：0
 

提示：

rows == matrix.length
cols == matrix.length
0 <= row, cols <= 200
matrix[i][j] 为 '0' 或 '1'
通过次数46,646提交次数96,129
*/
/*
动态规划

heights[i][j]代表[i，j]的高度
heights[i][j] = matrix[i][j]=='1'? heights[i-1][j] + 1:0

dp[i][j][k] 代表以[i,j]为右下角，高度为k可以组成的面积
dp[i][j][k] = dp[i][j-1][k] + k  

作者：leeyupeng
链接：https://leetcode-cn.com/problems/maximal-rectangle/solution/dong-tai-gui-hua-by-leeyupeng-5/
来源：力扣（LeetCode）
著作权归作者所有。商业转载请联系作者获得授权，非商业转载请注明出处。
*/
function deal(array $matrix):int{
	$start_time = microtime(true);
	/***************代码开始*********************/
	$n = count($matrix);
	if ($n == 0){return 0;}
	$m = count($matrix[0]);
	$heights = array_fill(0, $n+1, array_fill(0, $m + 1, 0));
	$dp = array_fill(0, $n+1, array_fill(0, $m + 1, array_fill(0, $n+1, 0)));
	$res = 0;

	for ($i=1; $i <= $n; $i++) { 
		for ($j=1; $j <= $m; $j++) { 
			if($matrix[$i-1][$j-1]== '0'){
				continue;
			}
			$heights[$i][$j] = $heights[$i-1][$j] + 1;
			for ($k=1; $k <= $heights[$i][$j]; $k++) { 
				$dp[$i][$j][$k] = $dp[$i][$j-1][$k] + $k;
				$res = max($res, $dp[$i][$j][$k]);
			}
		}
	}

	/***************代码结束*******************/
	/***********性能监控***********************/ 
	$end_time = microtime(true);
	$need_time = $end_time - $start_time;
	print_r("耗时:" . $need_time . "\r\n");
	/*******************************************/
	return $res;
}
echo deal([["1","0","1","0","0"],["1","0","1","1","1"],["1","1","1","1","1"],["1","0","0","1","0"]]);
echo "\r\n\r\n";
echo deal([]);
echo "\r\n\r\n";
echo deal([["0"]]);
echo "\r\n\r\n";
echo deal([["1"]]);
echo "\r\n\r\n";
echo deal([["0","0"]]);
echo "\r\n\r\n";

// 单调栈解法
function deal2(array $matrix):int{
	$start_time = microtime(true);
	/***************代码开始*********************/
	$n = count($matrix);
	if ($n == 0){return 0;}
	$m = count($matrix[0]);
	$hight = array_fill(0, $m + 1, 0);
	$res = 0;

	for ($i=0; $i < $n; $i++) { 
		for ($j=0; $j < $m; $j++) { 
			$hight[$j] = $matrix[$i][$j] == '1' ? $hight[$j] + 1 : 0;
		}
		$res = max($res, largeRec($hight));
	}

	/***************代码结束*******************/
	/***********性能监控***********************/ 
	$end_time = microtime(true);
	$need_time = $end_time - $start_time;
	print_r("耗时:" . $need_time . "\r\n");
	/*******************************************/
	return $res;
}
function largeRec(array $arr):int{
	array_push($arr, 0);
	array_unshift($arr, 0);
	$stack = [];
	$res = 0;

	for ($i=0; $i < count($arr); $i++) { 
		while ($stack && $arr[$stack[count($stack) - 1]] > $arr[$i]){
			$tmp = array_pop($stack);
			$res = max($res, ($i - $stack[count($stack) - 1] -1) * $arr[$tmp]);
		}
		array_push($stack, $i);
	}
	return $res;
}

echo deal2([["1","0","1","0","0"],["1","0","1","1","1"],["1","1","1","1","1"],["1","0","0","1","0"]]);
echo "\r\n\r\n";
echo deal2([]);
echo "\r\n\r\n";
echo deal2([["0"]]);
echo "\r\n\r\n";
echo deal2([["1"]]);
echo "\r\n\r\n";
echo deal2([["0","0"]]);
echo "\r\n\r\n";