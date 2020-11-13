<?php declare(strict_types=1);
/*
44. 通配符匹配

困难

给定一个字符串 (s) 和一个字符模式 (p) ，实现一个支持 '?' 和 '*' 的通配符匹配。

'?' 可以匹配任何单个字符。
'*' 可以匹配任意字符串（包括空字符串）。
两个字符串完全匹配才算匹配成功。

说明:

s 可能为空，且只包含从 a-z 的小写字母。
p 可能为空，且只包含从 a-z 的小写字母，以及字符 ? 和 *。
示例 1:

输入:
s = "aa"
p = "a"
输出: false
解释: "a" 无法匹配 "aa" 整个字符串。
示例 2:

输入:
s = "aa"
p = "*"
输出: true
解释: '*' 可以匹配任意字符串。
示例 3:

输入:
s = "cb"
p = "?a"
输出: false
解释: '?' 可以匹配 'c', 但第二个 'a' 无法匹配 'b'。
示例 4:

输入:
s = "adceb"
p = "*a*b"
输出: true
解释: 第一个 '*' 可以匹配空字符串, 第二个 '*' 可以匹配字符串 "dce".
示例 5:

输入:
s = "acdcb"
p = "a*c?b"
输出: false
通过次数56,740提交次数180,298
*/
/*解题思路

分2类，p[j] == '*' 和p[j] != '*'。
第一类：p[j] != '*'，如果是这种情况，那么想要匹配，只能s[i] == p[j]，或者p[j] == '?'。同时要看f[i - 1][j - 1]是否匹配。
第二类：p[j] == '*'，如果是这种情况，那么f[i][j]的状态转移可以看成是下面这种——
f[i][j]=f[i][j−1]∣∣f[i−1][j−1]∣∣f[i−2][j−1]...∣∣f[0][j−1]
f[i−1][j]=f[i−1][j−1]∣∣f[i−2][j−1]∣∣...∣∣f[0][j−1]
the result is:
f[i][j]=f[i][j−1]∣∣f[i−1][j]

f[i][j]的状态表示是s串中的1~i个字符和p串中的1~j个字符是否匹配。下标从1开始。
边界情况，初始都是false，但是f[0][0] = true。
时间复杂度
O(NM)
N是s串的长度，M是p串的长度。
状态转移的时间复杂度是O(1)。
所以总的时间复杂度是O(NM)

作者：HLHD_Steven
链接：https://leetcode-cn.com/problems/wildcard-matching/solution/shd-dong-tai-gui-hua-wan-quan-bei-bao-you-hua-by-h/
来源：力扣（LeetCode）
著作权归作者所有。商业转载请联系作者获得授权，非商业转载请注明出处。
*/
function deal(string $s, string $p):bool{
	$start_time = microtime(true);
	$start_memory = memory_get_usage(true);
	/***************代码开始*********************/
	$slen = strlen($s);
    $plen = strlen($p);
    $dp = array_fill(0, $slen + 1, array_fill(0, $plen+1, 0));

    $s = ' ' . $s;
    $p = ' ' . $p;

    $dp[0][0] = true;

    for ($i=0; $i <= $slen; $i++) { 
        for ($j=1; $j <= $plen; $j++) { 
            if($i && $p[$j] != "*"){
                $dp[$i][$j] = $dp[$i - 1][$j - 1] && ($s[$i] == $p[$j] || $p[$j] == '?');
            }else if($p[$j] == '*'){
                $dp[$i][$j] = $dp[$i][$j-1] || $i && $dp[$i - 1][$j];
            }
        }
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
	return $dp[$slen][$plen];
}

var_dump(deal("aa", "a"));
echo "\r\n";
var_dump(deal("aa", "*"));
echo "\r\n";
var_dump(deal("cb", "?a"));
echo "\r\n";
var_dump(deal("adceb", "*a*b"));

/*
链接：https://leetcode-cn.com/problems/wildcard-matching/solution/dong-tai-gui-hua-cong-ru-men-dao-fang-qi-chun-cshu/
 */
function deal2(string $s, string $p):bool{
	$start_time = microtime(true);
	$start_memory = memory_get_usage(true);
	/***************代码开始*********************/
	// 贪心算法
    // jstar代表模式串p中最后一次出现的星号的索引
    // istar代表s[:istar]这些字符全被jstar位置的这个星搞定了
    $i = 0;
    $j = 0;
    $iStar = -1;
    $jStar = -1;
    $m = strlen($s);
    $n = strlen($p);

    while ($i < $m){
        if ($j < $n && ($s[$i] == $p[$j] || $p[$j] == '?')){
            $i += 1;
            $j += 1;
        }else if ($j < $n && $p[$j] == '*'){
            $iStar = $i;
            $jStar = $j;
            $j += 1;
        }else if ($iStar >= 0){
            $iStar += 1;
            $i = $iStar;
            $j = $jStar + 1;
        }else{
            $res = false;
        }
    }

    #字符串s已经被匹配完成，从此时开始j只能为*号才行
    while ($j < $n && $p[$j] == '*'){
        $j += 1;
    }
    $res = $j == $n;
    #大佬的python版本 这个题目的回溯就只有最外面一层(也可以说是最后一个*那一层)
    #因为如果最后一个*无法解决的问题 前面的*更无法解决(贪心)

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

var_dump(deal2("aa", "a"));
echo "\r\n";
var_dump(deal2("aa", "*"));
echo "\r\n";
var_dump(deal2("cb", "?a"));
echo "\r\n";
var_dump(deal2("adceb", "*a*b"));