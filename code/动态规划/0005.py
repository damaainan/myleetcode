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


def deal2(s: str) -> str:
    right, left, count = 0, 0, 1
    start = 0
    mlen = 0

    slen = len(s)

    for i in range(0, slen, count):
        count = 1
        left = i -1
        right = i + 1
        #选出重复字符
        while(right<slen and s[i] == s[right]): # 减少了大量操作
            right += 1
            print("***"+s[i]+"\r\n")
            print(right)
            count += 1
        #由中心字符向左右扩展
        while(left>=0 and right<slen and s[left]==s[right]):
            right += 1
            left -= 1

        if mlen < (right - left - 1): # 取最长
            #左右标记不在回文子串范围内，在外面两侧，需要减1
            mlen = right - left - 1
            start = left + 1
    return s[start:mlen]



print(deal2("babad"))
print(deal2("abbaba"))



'''
最详细解释和思路
char * longestPalindrome(char * s){
    //判断字符串长度，处理特殊情况，字符数组为空或只有1个字符时('\0'结束符不占长度)，本身就是题解
    if (strlen(s) == 0 || strlen(s) == 1) {
        return s;
    }

    //对于>=2个字符以上时，则对每个字符进行循环查找，无非分为/1、回文子串字符数为偶数则从i向右查找
    //2、若回文子串字符数为奇数个，则从i-1和i+1位置比较
    //另外，注意第1种情况偶数字符数的回文子串可以当做1个字符考虑，这样节省寻找时间。
    int i, left, right, count = 0; //注意初始化时若不显式初始化为0相当于未初始化，使用时必须先初始化
    int len = 0; //最后回文子串的长度
    int start = 0; //最后回文子串的起始位置
    for (i = 0; s[i] != '\0'; i += count) {
        count = 1; //每次for循环进来都初始为1，重新判断i字符右面有无重复字符，若有则下次i+count略过重复字符
        left = i - 1;
        right = i + 1;

        //右面字符非结束符前提下，比较当前字符和右面字符是否相等---先处理字符重复的情况
        while (s[right] != '\0' && s[i] == s[right]) {
            right++;
            count++; //若相等则count+1，下次略过
        }

        //左右字符合法前提下，比较左面和右面字符是否相等---处理所有场景下回文字符的情况
        while (left >= 0 && s[right] != '\0' && s[left] == s[right]) {
            left--;
            right++;
        }

        //如果当前回文子串长度大于上一次长度，则刷新起始位置和长度
        if (right - left - 1 > len) {
            len = right - left - 1; //注意真正的回文子串在right和left中间这一段，所以 -1
            start = left + 1;
        }
    }

    s[start + len] = '\0'; //最后将长度后的一个字符赋值为结束符
    return s + start; //返回字符数组即指针+偏移
}

作者：jet534
链接：https://leetcode-cn.com/problems/longest-palindromic-substring/solution/zui-xiang-xi-jie-shi-he-si-lu-by-jet534/
来源：力扣（LeetCode）
著作权归作者所有。商业转载请联系作者获得授权，非商业转载请注明出处。

'''



