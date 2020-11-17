<?php declare(strict_types=1);
/*
64. 最小路径和
难度
中等

给定一个包含非负整数的 m x n 网格 grid ，请找出一条从左上角到右下角的路径，使得路径上的数字总和为最小。

说明：每次只能向下或者向右移动一步。

 

示例 1：


输入：grid = [[1,3,1],[1,5,1],[4,2,1]]
输出：7
解释：因为路径 1→3→1→1→1 的总和最小。
示例 2：

输入：grid = [[1,2,3],[4,5,6]]
输出：12
 

提示：

m == grid.length
n == grid[i].length
1 <= m, n <= 200
0 <= grid[i][j] <= 100
通过次数159,223提交次数235,269

*/
/*
 给定一个包含非负整数的 m x n 网格，请找出一条从左上角到右下角的路径，使得路径上的数字总和为最小。

说明： 每次只能向下或者向右移动一步。

示例：


输入:
[
  [1,3,1],
  [1,5,1],
  [4,2,1]
]
输出: 7
解释: 因为路径 1→3→1→1→1 的总和最小。
动态规划

因为只能选择向右或者向下走，因此对于每一个方块来说只有两种可能，要么从上面来，要么从左面来，因此到这个块的最短路径就是这两条路取一个
min，这个块的取值就是左面最短路径和上方最短路径的最小值再加上它本身的值，最后的结果就是右下角块的值。
 */

function deal(array $grid):int{
	$start_time = microtime(true);
	$start_memory = memory_get_usage(true);
	/***************代码开始*********************/
	$m = count($grid);
    $n = count($grid[0]);
    for ($i=1; $i < $m; $i++) { 
        $grid[$i][0] += $grid[$i-1][0];
    }
    for ($j=1; $j < $n; $j++) { 
        $grid[0][$j] += $grid[0][$j-1];
    }

    for ($i=1; $i < $m; $i++) { 
        for ($j=1; $j < $n; $j++) { 
            $grid[$i][$j] += min($grid[$i-1][$j], $grid[$i][$j-1]);
        }
    }
    $res = $grid[$m-1][$n-1];

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

echo deal([[1,3,1],[1,5,1],[4,2,1]]);
echo "\r\n";
echo deal([[1,2,3],[4,5,6]]);