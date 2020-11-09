<?php declare(strict_types=1);
/*
给出矩阵 matrix 和目标值 target，返回元素总和等于目标值的非空子矩阵的数量。

子矩阵 x1, y1, x2, y2 是满足 x1 <= x <= x2 且 y1 <= y <= y2 的所有单元 matrix[x][y] 的集合。

如果 (x1, y1, x2, y2) 和 (x1', y1', x2', y2') 两个子矩阵中部分坐标不同（如：x1 != x1'），那么这两个子矩阵也不同。



示例 1：

输入：matrix = [[0,1,0],[1,1,1],[0,1,0]], target = 0
输出：4
解释：四个只含 0 的 1x1 子矩阵。
示例 2：

输入：matrix = [[1,-1],[-1,1]], target = 0
输出：5
解释：两个 1x2 子矩阵，加上两个 2x1 子矩阵，再加上一个 2x2 子矩阵。


提示：

1 <= matrix.length <= 300
1 <= matrix[0].length <= 300
-1000 <= matrix[i] <= 1000
-10^8 <= target <= 10^8
*/
function deal(array $matrix, int $target):int{
    $start_time = microtime(true);
    $start_memory = memory_get_usage(true);
    /***************代码开始*********************/
    $m = count($matrix);
    $n = count($matrix[0]);

    for ($i=0; $i < $m; $i++) {
        for ($j=1; $j < $n; $j++) {
            $matrix[$i][$j] += $matrix[$i][$j-1];
        }
    }

    $res = 0;

    for ($i=0; $i < $n; $i++) {
        for ($j=$i; $j < $n; $j++) {
            $cur = 0;
            $c = array_fill(0, $n*$m, 0); // 不存在的索引
            $c[0] = 1;
            for ($k=0; $k < $m; $k++) {
                $tmp = $i>0 ? $matrix[$k][$i-1] : 0;
                $cur += $matrix[$k][$j] - $tmp;
                $res += $c[$cur - $target];
                $c[$cur] += 1;
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
    return $res;
}

echo deal([[0,1,0],[1,1,1],[0,1,0]], 0);
echo deal([[1,-1],[-1,1]], 0);