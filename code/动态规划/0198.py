from typing import List

# 影响范围只有两个，当前房子，前一个房子，不断轮换DP即可
def deal(nums: List[int]) -> int: 
    pre = now = 0
    for i in nums: 
        pre, now = now, max(now, pre + i)  
    return now


print(deal([1,2,3,1]))
print("\r\n\r\n")
print(deal([2,7,9,3,1]))
print("\r\n\r\n")