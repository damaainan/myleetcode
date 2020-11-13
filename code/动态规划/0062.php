<?php declare(strict_types=1);
/*
62. 不同路径

中等


一个机器人位于一个 m x n 网格的左上角 （起始点在下图中标记为“Start” ）。

机器人每次只能向下或者向右移动一步。机器人试图达到网格的右下角（在下图中标记为“Finish”）。

问总共有多少条不同的路径？


例如，上图是一个7 x 3 的网格。有多少可能的路径？

 

示例 1:

输入: m = 3, n = 2
输出: 3
解释:
从左上角开始，总共有 3 条路径可以到达右下角。
1. 向右 -> 向右 -> 向下
2. 向右 -> 向下 -> 向右
3. 向下 -> 向右 -> 向右
示例 2:

输入: m = 7, n = 3
输出: 28
 

提示：

1 <= m, n <= 100
题目数据保证答案小于等于 2 * 10 ^ 9
通过次数161,697提交次数257,919
*/
function deal(int $m, int $n):int{
    $nn = 1;
	$start_time = microtime(true);
	$start_memory = memory_get_usage(true);
    /***************代码开始*********************/
    // $b = array_fill(0, 101, 0);
    $a = [];
    for ($i=1; $i <= $m; $i++) { 
        for ($j=1; $j <= $n; $j++) { 
            if($i == 1 || $j == 1){
                $a[$i][$j] = 1;
            }else{
                $a[$i][$j] = $a[$i - 1][$j] + $a[$i][$j - 1];
            }
        }
    }

    $res = $a[$m][$n];

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

echo deal(7, 3);
echo "\r\n";
echo deal(3, 2);
function deal2(int $m, int $n):int{
    $nn = 1;
	$start_time = microtime(true);
	$start_memory = memory_get_usage(true);
    /***************代码开始*********************/
    // $b = array_fill(0, 101, 0);
    $res = 1;
    for ($i=1; $i < $n; $i++) { 
        $res = $res * ($m - 1 + $i) / $i;
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

echo deal2(7, 3);
echo "\r\n";
echo deal2(3, 2);


function deal3(int $m, int $n):int{
    $nn = 1;
	$start_time = microtime(true);
	$start_memory = memory_get_usage(true);
    /***************代码开始*********************/
    // $b = array_fill(0, 101, 0);
    $arr = array_fill(0, $m, 1);
    for ($i=0; $i < $n - 1 ; $i++) { 
        for ($j=1; $j < $m; $j++) { 
            $arr[$j] += $arr[$j-1];
        }
    }
    $res = $arr[$m-1];

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

echo deal3(7, 3);
echo "\r\n";
echo deal3(3, 2);
echo "\r\n";
