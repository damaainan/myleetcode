<?php declare(strict_types=1);
/*
10. 正则表达式匹配
困难


给你一个字符串 s 和一个字符规律 p，请你来实现一个支持 '.' 和 '*' 的正则表达式匹配。

'.' 匹配任意单个字符
'*' 匹配零个或多个前面的那一个元素
所谓匹配，是要涵盖 整个 字符串 s的，而不是部分字符串。


示例 1：

输入：s = "aa" p = "a"
输出：false
解释："a" 无法匹配 "aa" 整个字符串。
示例 2:

输入：s = "aa" p = "a*"
输出：true
解释：因为 '*' 代表可以匹配零个或多个前面的那一个元素, 在这里前面的元素就是 'a'。因此，字符串 "aa" 可被视为 'a' 重复了一次。
示例 3：

输入：s = "ab" p = ".*"
输出：true
解释：".*" 表示可匹配零个或多个（'*'）任意字符（'.'）。
示例 4：

输入：s = "aab" p = "c*a*b"
输出：true
解释：因为 '*' 表示零个或多个，这里 'c' 为 0 个, 'a' 被重复一次。因此可以匹配字符串 "aab"。
示例 5：

输入：s = "mississippi" p = "mis*is*p*."
输出：false


提示：

0 <= s.length <= 20
0 <= p.length <= 30
s 可能为空，且只包含从 a-z 的小写字母。
p 可能为空，且只包含从 a-z 的小写字母，以及字符 . 和 *。
保证每次出现字符 * 时，前面都匹配到有效的字符
*/
/**
 * 正则表达式匹配
 * @param  string $s [description]
 * @param  string $p [description]
 * @return bool    [description]
 */
function deal(string $s, string $p) :bool {
    $start_time = microtime(true);
    $start_memory = memory_get_usage(true);
    /***************代码开始*********************/

    if ($p != "" && $p[0] == "*") return false;

    $dp = array_fill(0, strlen($s)+1, array_fill(0, strlen($s)+1, false));
    $dp[0][0] = true;

    for ($k=0; $k < strlen($p); $k++) {
        if ($p[$k] == "*" && $dp[0][$k-1]){
            $dp[0][$k+1] = true;
        }
    }
    $slen = strlen($s);
    $plen = strlen($p);

    for ($i=0; $i < $slen; $i++) {
        for ($j=0; $j < $plen; $j++) {
            if($s[$i] == $p[$j] || $p[$j] == '.'){
                $dp[$i+1][$j+1] = $dp[$i][$j];
            }else if($p[$j] == "*"){
                if ($p[$j-1] != $s[$i] && $p[$j-1] != '.') { // 情况2 3
                    $dp[$i+1][$j+1] = $dp[$i+1][$j-1];
                } else { // 情况1
                    $dp[$i+1][$j+1] = $dp[$i+1][$j-1] || $dp[$i+1][$j] || $dp[$i][$j+1];
                }
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

echo "\r\n";
var_dump(deal("aa", "a"));
echo "\r\n";
var_dump(deal("aa", "a*"));
echo "\r\n";
var_dump(deal("ab", ".*"));
echo "\r\n";
var_dump(deal("aab", "c*a*b"));
echo "\r\n";
var_dump(deal("mississippi", "mis*is*p*."));