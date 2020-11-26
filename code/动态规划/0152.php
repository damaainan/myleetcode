<?php declare(strict_types=1);
/*
152. 乘积最大子数组
难度
中等

给你一个整数数组 nums ，请你找出数组中乘积最大的连续子数组（该子数组中至少包含一个数字），并返回该子数组所对应的乘积。


示例 1:

输入: [2,3,-2,4]
输出: 6
解释: 子数组 [2,3] 有最大乘积 6。
示例 2:

输入: [-2,0,-1]
输出: 0
解释: 结果不能为 2, 因为 [-2,-1] 不是子数组。
通过次数104,532提交次数257,419
*/
/*
动态规划 

我们只要记录前i的最小值, 和最大值, 那么 dp[i] = max(nums[i] * pre_max, nums[i] * pre_min, nums[i]), 这里0 不需要单独考虑, 因为当相乘不管最大值和最小值,都会置0
*/
function deal(array $nums):int{
	$start_time = microtime(true);
    /***************代码开始*********************/
    $n = count($nums);
    $min = $max = $res = $nums[0];
	for ($i=1; $i < $n; $i++) { 
        $t = $nums[$i];
        $max = max($t * $max, $t * $min, $t);
        $min = min($t * $max, $t * $min, $t);
        $res = max($max, $res);
    }

	/***************代码结束*******************/
	/***********性能监控***********************/ 
	$end_time = microtime(true);
	$need_time = $end_time - $start_time;
	print_r("耗时:" . $need_time . "\r\n");
	/*******************************************/
	return $res;
}
echo deal([2,3,-2,4]);
echo "\r\n\r\n";
echo deal([-2,0,-1]);
echo "\r\n\r\n";
/*
根据符号的个数 [^2]

当负数个数为偶数时候，全部相乘一定最大

当负数个数为奇数时候，它的左右两边的负数个数一定为偶数，只需求两边最大值

当有 0 情况，重置就可以了

作者：powcai
链接：https://leetcode-cn.com/problems/maximum-product-subarray/solution/duo-chong-si-lu-qiu-jie-by-powcai-3/
来源：力扣（LeetCode）
著作权归作者所有。商业转载请联系作者获得授权，非商业转载请注明出处。
*/
function deal2(array $nums):int{
	$start_time = microtime(true);
    /***************代码开始*********************/
    $num_rev = array_reverse($nums);
    $n = count($nums);
    for ($i=1; $i < $n; $i++) { 
        $nums[$i] *= ($nums[$i-1] == 0 ? 1 : $nums[$i-1]);
        $num_rev[$i] *= ($num_rev[$i-1] == 0 ? 1 : $num_rev[$i-1]);
    }
    $res = max(max($nums), max($num_rev));

	/***************代码结束*******************/
	/***********性能监控***********************/ 
	$end_time = microtime(true);
	$need_time = $end_time - $start_time;
	print_r("耗时:" . $need_time . "\r\n");
	/*******************************************/
	return $res;
}
echo deal2([2,3,-2,4]);
echo "\r\n\r\n";
echo deal2([-2,0,-1]);
echo "\r\n\r\n";