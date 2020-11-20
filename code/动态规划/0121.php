<?php declare(strict_types=1);
/*
121. 买卖股票的最佳时机
难度
简单

给定一个数组，它的第 i 个元素是一支给定股票第 i 天的价格。

如果你最多只允许完成一笔交易（即买入和卖出一支股票一次），设计一个算法来计算你所能获取的最大利润。

注意：你不能在买入股票前卖出股票。

 

示例 1:

输入: [7,1,5,3,6,4]
输出: 5
解释: 在第 2 天（股票价格 = 1）的时候买入，在第 5 天（股票价格 = 6）的时候卖出，最大利润 = 6-1 = 5 。
     注意利润不能是 7-1 = 6, 因为卖出价格需要大于买入价格；同时，你不能在买入前卖出股票。
示例 2:

输入: [7,6,4,3,1]
输出: 0
解释: 在这种情况下, 没有交易完成, 所以最大利润为 0。
通过次数317,130提交次数574,788
*/
// 暴力解法
function deal(array $prices):int{
	$start_time = microtime(true);
	/***************代码开始*********************/
    $n = count($prices);
    $res = 0;
    for ($i=0; $i < $n; $i++) { 
        $tmp = 0;
        for ($j=$i+1; $j < $n; $j++) { 
            if($prices[$j] - $prices[$i]>0){
                $tmp = $prices[$j] - $prices[$i];
                $res = max($res, $tmp);
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
echo deal([7,1,5,3,6,4]);
echo "\r\n\r\n";
echo deal([7,6,4,3,1]);
echo "\r\n\r\n";
function deal2(array $prices):int{
	$start_time = microtime(true);
	/***************代码开始*********************/
    $n = count($prices);
    $res = 0;
    $min = max($prices) + 1; // 需要取极大值
    for ($i=0; $i < $n; $i++) { 
        if($prices[$i] < $min) {
            $min = $prices[$i];
        }
        if($prices[$i] - $min > $res) {
            $res = $prices[$i] - $min;
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
echo deal2([7,1,5,3,6,4]);
echo "\r\n\r\n";
echo deal2([7,6,4,3,1]);
echo "\r\n\r\n";