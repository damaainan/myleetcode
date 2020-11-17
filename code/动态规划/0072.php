<?php declare(strict_types=1);
/*
72. 编辑距离
难度
困难

给你两个单词 word1 和 word2，请你计算出将 word1 转换成 word2 所使用的最少操作数 。

你可以对一个单词进行如下三种操作：

插入一个字符
删除一个字符
替换一个字符
 

示例 1：

输入：word1 = "horse", word2 = "ros"
输出：3
解释：
horse -> rorse (将 'h' 替换为 'r')
rorse -> rose (删除 'r')
rose -> ros (删除 'e')
示例 2：

输入：word1 = "intention", word2 = "execution"
输出：5
解释：
intention -> inention (删除 't')
inention -> enention (将 'i' 替换为 'e')
enention -> exention (将 'n' 替换为 'x')
exention -> exection (将 'n' 替换为 'c')
exection -> execution (插入 'u')
 

提示：

0 <= word1.length, word2.length <= 500
word1 和 word2 由小写英文字母组成
通过次数92,741提交次数154,506
*/
/*
思路

动态规划
定义 dp[i][j]
21. dp[i][j] 代表 word1 中前 i 个字符，变换到 word2 中前 j 个字符，最短需要操作的次数
22. 需要考虑 word1 或 word2 一个字母都没有，即全增加/删除的情况，所以预留 dp[0][j] 和 dp[i][0]
状态转移
31. 增，dp[i][j] = dp[i][j - 1] + 1
32. 删，dp[i][j] = dp[i - 1][j] + 1
33. 改，dp[i][j] = dp[i - 1][j - 1] + 1
34. 按顺序计算，当计算 dp[i][j] 时，dp[i - 1][j] ， dp[i][j - 1] ， dp[i - 1][j - 1] 均已经确定了
35. 配合增删改这三种操作，需要对应的 dp 把操作次数加一，取三种的最小
36. 如果刚好这两个字母相同 word1[i - 1] = word2[j - 1] ，那么可以直接参考 dp[i - 1][j - 1] ，操作不用加一

作者：ikaruga
链接：https://leetcode-cn.com/problems/edit-distance/solution/edit-distance-by-ikaruga/
来源：力扣（LeetCode）
著作权归作者所有。商业转载请联系作者获得授权，非商业转载请注明出处。
*/
function deal(string $word1, string $word2):int{
	$start_time = microtime(true);
	/***************代码开始*********************/
	$m = strlen($word1);
	$n = strlen($word2);
	$dp = array_fill(0, $m+1, array_fill(0, $n+1, 0));

	for ($i=0; $i < $m; $i++) { 
		$dp[$i][0] = $i;
	}

	for ($j=0; $j < $n; $j++) { 
		$dp[0][$j] = $j;
	}
	for ($i=1; $i < $m; $i++) { 
		for ($j=1; $j < $n; $j++) { 
			$dp[$i][$j] = min($dp[$i-1][$j-1], $dp[$i-1][$j], $dp[$i][$j-1]) + 1;
			if ($word1[$i-1] == $word2[$j-1]){
				$dp[$i][$j] = min($dp[$i][$j], $dp[$i-1][$j-1]);
			}
		}
	}
	$res = $dp[$m-1][$n-1];
	/***************代码结束*******************/
	/***********性能监控***********************/ 
	$end_time = microtime(true);
	$need_time = $end_time - $start_time;
	print_r("耗时:" . $need_time . "\r\n");
	/*******************************************/
	return $res;
}
echo deal("horse", "ros");
echo "\r\n\r\n";
echo deal("intention", "execution");