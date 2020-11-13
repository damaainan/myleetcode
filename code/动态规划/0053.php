<?php declare(strict_types=1);
/*
53. 最大子序和

简单

给定一个整数数组 nums ，找到一个具有最大和的连续子数组（子数组最少包含一个元素），返回其最大和。

示例:

输入: [-2,1,-3,4,-1,2,1,-5,4]
输出: 6
解释: 连续子数组 [4,-1,2,1] 的和最大，为 6。
进阶:

如果你已经实现复杂度为 O(n) 的解法，尝试使用更为精妙的分治法求解。

通过次数362,404提交次数687,504
*/
// 解题思路

// 这一段代码我运用了动态规划的思想，在此期间看了很多优秀，精简的算法，然后自己总结出来了这段代码
// 这段代码首先是一个迭代，从1到nums的最后一个数字(range这个函数不懂的可以查一下)，
// 然后就是总体了,nums[i]是从1开始的，开始算的是num[0]+nums[1]与nums[i]的最大值，
// 这里这么写可以看成nums[i-1]+nums[i]是看nums[i-1]大于0还是小于0，大于0自然选这个，
// 小于0的话，相加是要比num[i]小的，所以选择num[i]，这样一直往后迭代，最后返回max(nums),
// 也就是nums列表的最大值。

// 作者：luo_luo
// 链接：https://leetcode-cn.com/problems/maximum-subarray/solution/zui-da-zi-xu-he-python3dong-tai-gui-hua-ti-jie-by-/
// 来源：力扣（LeetCode）
// 著作权归作者所有。商业转载请联系作者获得授权，非商业转载请注明出处。
function deal(array $nums):int{
	$start_time = microtime(true);
	$start_memory = memory_get_usage(true);
	/***************代码开始*********************/
	for ($i=1; $i < count($nums); $i++) { 
        $nums[$i] = max($nums[$i - 1] + $nums[$i], $nums[$i]);
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
	return max($nums);
}

echo deal([-2,1,-3,4,-1,2,1,-5,4]);