# 解题思路

# 思路是，因为题目要的最长回文，所以不用验证更短的子串了。

# 或者说，就是以尾座标为标志进行验证，也不用担心错过更长的结果。效果是只需遍历一次。时间空间都是双百。


def deal(s: str) -> str:
    if not s:
        return ""
    length = len(s)
    if length == 1 or s == s[::-1]:
        return s
    mlen, start = 1, 0

    for i in range(1, length):
        even = s[i-mlen:i+1]
        odd = s[i-mlen-1:i+1]

        if i-mlen - 1 > 0 and odd == odd[::-1]:
            start = i-mlen-1
            mlen += 2
            continue
        if i-mlen >= 0 and even == even[::-1]:
            start = i-mlen
            mlen += 1
            continue
    return s[start:start+mlen]


print(deal("babad"))
