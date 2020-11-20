<?php declare(strict_types=1);
/*
91. 解码方法
难度
中等

一条包含字母 A-Z 的消息通过以下方式进行了编码：

'A' -> 1
'B' -> 2
...
'Z' -> 26
给定一个只包含数字的非空字符串，请计算解码方法的总数。

题目数据保证答案肯定是一个 32 位的整数。

 

示例 1：

输入：s = "12"
输出：2
解释：它可以解码为 "AB"（1 2）或者 "L"（12）。
示例 2：

输入：s = "226"
输出：3
解释：它可以解码为 "BZ" (2 26), "VF" (22 6), 或者 "BBF" (2 2 6) 。
示例 3：

输入：s = "0"
输出：0
示例 4：

输入：s = "1"
输出：1
示例 5：

输入：s = "2"
输出：1
 

提示：

1 <= s.length <= 100
s 只包含数字，并且可能包含前导零。

通过次数74,949提交次数301,381
*/
/*
思路 
dp[i] = dp[i-1] + 1 || dp[i-2] + 3

去除前导 0 
*/
function deal(string $s):int{
	$start_time = microtime(true);
	/***************代码开始*********************/
    
    if (str_replace("0", "", $s) == ""){
        return 0;
    }
    $n = strlen($s);
    for ($j=0; $j < $n; $j++) { 
        if($s[$j] != 0){
            $s = substr($s, $j);
            break;
        }
    }
    $n = strlen($s);
    $dp = array_fill(0, $n, 0);
    $dp[0] = 1;
    for ($i=1; $i < $n; $i++) { 
        $flag = intval($s[$i-1]);
        if($flag > 6 || $flag == 0){
            $dp[$i] = $dp[$i-1] + 1;
        }else{
            if($i-2 >= 0){
                if(intval($s[$i-2].$s[$i-1]) <= 26){
                    $dp[$i] = $dp[$i-2] + 2;
                }else{
                    $dp[$i] = $dp[$i-2] + 1;
                }
            }else{
                $dp[$i] = $dp[$i-1] + 1;
            }
        }
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

echo deal("12");
echo "\r\n\r\n";

echo deal("226");
echo "\r\n\r\n";

echo deal("0");
echo "\r\n\r\n";

echo deal("1");
echo "\r\n\r\n";

echo deal("2");
echo "\r\n\r\n";

// dp 方法 
function deal2(string $s):int{
	$start_time = microtime(true);
	/***************代码开始*********************/
    $n = strlen($s);
    if($n == 0 || $s[0] == '0'){
        return 0;
    }
    $dp = array_fill(0, $n, 0);
    $dp[0] = 1;
    $dp[1] = 1;
    for ($i=1; $i < $n; $i++) { 
        if($s[$i] == '0'){
            if ($s[$i-1] == '1' || $s[$i-1] == '2') {
                $dp[$i] = $dp[$i-1];
            }else{
                $res = 0;
                break;
            }
        }else{
            if ($s[$i-1] == '1' || ($s[$i-1] == '2' && $s[$i] < '7')) {
                $dp[$i+1] = $dp[$i] + $dp[$i-1];
            }else{
                $dp[$i+1] = $dp[$i];
            }
        }
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
echo "****";
echo deal2("12");
echo "\r\n\r\n";

echo deal2("226");
echo "\r\n\r\n";

echo deal2("0");
echo "\r\n\r\n";

echo deal2("1");
echo "\r\n\r\n";

echo deal2("2");
echo "\r\n\r\n";