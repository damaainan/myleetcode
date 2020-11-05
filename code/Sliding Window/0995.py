from typing import List

def minKBitFlips(A: List[int], K: int) -> int:
# def minKBitFlips(A, K) -> int:
    res = cur = 0
    for i in range(len(A)):
        if i >= K and A[i-K] == 2:
            cur -= 1
        if (cur % 2) == A[i]:
            if i + K > len(A):
                return -1
            A[i] = 2
            cur, res = cur + 1, res + 1
    return res

# t =  Solution()

print(minKBitFlips([0,1,0], 1))
print(minKBitFlips(A=[1,1,0], K=2))
print(minKBitFlips(A=[0,0,0,1,0,1,1,0], K=3))