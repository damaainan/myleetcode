<?php declare(strict_types=1);
/*
139. 单词拆分
难度
中等

给定一个非空字符串 s 和一个包含非空单词的列表 wordDict，判定 s 是否可以被空格拆分为一个或多个在字典中出现的单词。

说明：

拆分时可以重复使用字典中的单词。
你可以假设字典中没有重复的单词。
示例 1：

输入: s = "leetcode", wordDict = ["leet", "code"]
输出: true
解释: 返回 true 因为 "leetcode" 可以被拆分成 "leet code"。
示例 2：

输入: s = "applepenapple", wordDict = ["apple", "pen"]
输出: true
解释: 返回 true 因为 "applepenapple" 可以被拆分成 "apple pen apple"。
     注意你可以重复使用字典中的单词。
示例 3：

输入: s = "catsandog", wordDict = ["cats", "dog", "sand", "and", "cat"]
输出: false
通过次数104,071提交次数214,701
*/
// TODO
/*
s 必须被拆分尽 
dp 代表 n  个 单词 
dp[n] = dp[n-1] + 1 // 最后一个必为单词 
*/ 

function deal(string $s, array $wordDict):bool{
	$start_time = microtime(true);
    /***************代码开始*********************/
    $max = 0;
    $min = 200; // 最长的单词
    foreach ($wordDict as $word) {
        if(strlen($word) > $max){
            $max = strlen($word);
        }
        if(strlen($word) < $min){
            $min = strlen($word);
        }
    }
    $len = strlen($s);
    for ($i=$min; $i < $len; $i++) { 
        
    }

	/***************代码结束*******************/
	/***********性能监控***********************/ 
	$end_time = microtime(true);
	$need_time = $end_time - $start_time;
	print_r("耗时:" . $need_time . "\r\n");
	/*******************************************/
	return $res;
}
echo deal("leetcode", ["leet", "code"]);
echo "\r\n\r\n";
echo deal("applepenapple", ["apple", "pen"]);
echo "\r\n\r\n";
echo deal("catsandog", ["cats", "dog", "sand", "and", "cat"]);
echo "\r\n\r\n";