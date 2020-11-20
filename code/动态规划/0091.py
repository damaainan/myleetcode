'''
输入 '12' 的结果为 2，如果我们在 '12' 后面增加一个数字 3，输入变成 '123'，结果是 '12'的结果 + '1'的结果 = 3

i 从索引 1 开始逐渐遍历 s，当前位置对应结果 = 上上次结果(如果 i 位置字符和 i-1 位置字符的组合满足条件) + 上次结果(如果 s[i] 不为 0)

作者：QQqun902025048
链接：https://leetcode-cn.com/problems/decode-ways/solution/4-xing-python-dp-onshi-jian-o1kong-jian-by-qqqun90/
来源：力扣（LeetCode）
著作权归作者所有。商业转载请联系作者获得授权，非商业转载请注明出处。
'''

def deal(s:str)->int:
    pp = 1
    p = int(s[0] != 0)

    for i in range(1, len(s)):
        pp, p = p, pp * (9 < int(s[i-1:i+1]) <= 26) + p * (int(s[i]) > 0 )
    return p 

print(deal("12"))
print("\r\n\r\n")

print(deal("226"))
print("\r\n\r\n")

print(deal("0"))
print("\r\n\r\n")

print(deal("1"))
print("\r\n\r\n")

print(deal("2"))
print("\r\n\r\n")