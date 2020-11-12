package main

import (
	"fmt"
)

func main() {
	fmt.Println(isMatch("aa", "a"))
	fmt.Println("\r\n")
	// fmt.Println(isMatch("aa", "a*"))
	// fmt.Println("\r\n")
	// fmt.Println(isMatch("ab", ".*"))
	// fmt.Println("\r\n")
	// fmt.Println(isMatch("aab", "c*a*b"))
	// fmt.Println("\r\n")
	// fmt.Println(isMatch("mississippi", "mis*is*p*."))

	fmt.Println(isMatch2("aa", "a"))
	fmt.Println("\r\n")
	fmt.Println(isMatch2("aa", "a*"))
	fmt.Println("\r\n")
	fmt.Println(isMatch2("ab", ".*"))
	fmt.Println("\r\n")
	fmt.Println(isMatch2("aab", "c*a*b"))
	fmt.Println("\r\n")
	fmt.Println(isMatch2("mississippi", "mis*is*p*."))
}

func isMatch(s string, p string) bool {
	if p != "" && string(p[0]) == "*" {
		return false
	}

	dp := make([][]bool, len(s)+1) // 建立dp数组，大小是 len(s)+1  *  len(p)+1
	for i, _ := range dp {
		dp[i] = make([]bool, len(p)+1)
	}
	dp[0][0] = true // dp[0][0]对应 s="" && p=""情况，为true

	for i, c := range p {
		if c == '*' && dp[0][i-1] { // 等于'*'时，如果把x*解释为零长度，只需要看x*之前是否为true
			dp[0][i+1] = true
		}
	}

	for i, a := range s { // dp主循环
		for j, b := range p {
			if a == b || b == '.' { // 情况4
				dp[i+1][j+1] = dp[i][j]
			} else if b == '*' {
				if p[j-1] != s[i] && p[j-1] != '.' { // 情况2 3
					dp[i+1][j+1] = dp[i+1][j-1]
				} else { // 情况1
					dp[i+1][j+1] = dp[i+1][j-1] || dp[i+1][j] || dp[i][j+1]
				}
			}
		}
	}

	return dp[len(s)][len(p)] // 输出最右下角
}

// 作者：zeoxc
// 链接：https://leetcode-cn.com/problems/regular-expression-matching/solution/golang-dp-0ms-by-zeoxc/
// 来源：力扣（LeetCode）
// 著作权归作者所有。商业转载请联系作者获得授权，非商业转载请注明出处。

// 双百
func isMatch2(s string, p string) bool {
	dp := make([][]int, len(s)+1)
	for i := 0; i <= len(s); i++ {
		dp[i] = make([]int, len(p)+1)
	}
	return isMatchCore(s, p, 0, 0, dp)
}
func isMatchCore(s, p string, i, j int, dp [][]int) bool {
	if dp[i][j] == 1 {
		return true
	} else if dp[i][j] == -1 {
		return false
	}
	flag := false
	if j == len(p) {
		if i == len(s) {
			flag = true
		} else {
			flag = false
		}

	}
	if j == len(p)-1 {
		if i == len(s) {
			flag = false
		} else if s[i] == p[j] || p[j] == '.' {
			flag = isMatchCore(s, p, i+1, j+1, dp)
		} else {
			flag = false
		}
	}
	if j < len(p)-1 {
		if p[j+1] == '*' {
			if i <= len(s)-1 && (s[i] == p[j] || p[j] == '.') {
				flag = isMatchCore(s, p, i+1, j+2, dp) || isMatchCore(s, p, i+1, j, dp) || isMatchCore(s, p, i, j+2, dp)
			} else {
				flag = isMatchCore(s, p, i, j+2, dp)
			}

		} else if i <= len(s)-1 && (s[i] == p[j] || p[j] == '.') {
			flag = isMatchCore(s, p, i+1, j+1, dp)
		}

	}
	if flag == true {
		dp[i][j] = 1
	} else {
		dp[i][j] = -1

	}
	return flag

}

// 作者：digua_33
// 链接：https://leetcode-cn.com/problems/regular-expression-matching/solution/goyu-yan-zhi-xing-xiao-lu-100-by-digua_33/
// 来源：力扣（LeetCode）
// 著作权归作者所有。商业转载请联系作者获得授权，非商业转载请注明出处。
