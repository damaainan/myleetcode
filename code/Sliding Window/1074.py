from typing import List
import collections

def deal(matrix: List[int], target: int) -> int:
    m, n = len(matrix), len(matrix[0])
    for i in range(m):
        for j in range(1, n):
            matrix[i][j] += matrix[i][j-1]

    res = 0

    for i in range(n):
        for j in range(i, n):
            c = collections.defaultdict(int)
            cur, c[0] = 0, 1

            for k in range(m):
                cur += matrix[k][j] - (matrix[k][i-1] if i > 0 else 0)
                res += c[cur - target]
                c[cur] += 1

    return res


print(deal([[0,1,0],[1,1,1],[0,1,0]], 0))
print(deal([[1,-1],[-1,1]], 0))