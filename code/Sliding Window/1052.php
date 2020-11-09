<?php declare (strict_types = 1);
/*
今天，书店老板有一家店打算试营业 customers.length 分钟。每分钟都有一些顾客（customers[i]）会进入书店，所有这些顾客都会在那一分钟结束后离开。

在某些时候，书店老板会生气。 如果书店老板在第 i 分钟生气，那么 grumpy[i] = 1，否则 grumpy[i] = 0。 当书店老板生气时，那一分钟的顾客就会不满意，不生气则他们是满意的。

书店老板知道一个秘密技巧，能抑制自己的情绪，可以让自己连续 X 分钟不生气，但却只能使用一次。

请你返回这一天营业下来，最多有多少客户能够感到满意的数量。

示例：

输入：customers = [1,0,1,2,1,1,7,5], grumpy = [0,1,0,1,0,1,0,1], X = 3
输出：16
解释：
书店老板在最后 3 分钟保持冷静。
感到满意的最大客户数量 = 1 + 1 + 1 + 1 + 7 + 5 = 16.

提示：

1 <= X <= customers.length == grumpy.length <= 20000
0 <= customers[i] <= 1000
0 <= grumpy[i] <= 1
 */
/**
 * 爱生气的书店老板
 * @param  array  $customers [description]
 * @param  array  $grumpy    [description]
 * @param  int    $X         [description]
 * @return [int]            [description]
 */
function deal(array $customers, array $grumpy, int $X): int
{
    $start_time = microtime(true);
    $start_memory = memory_get_usage(true);
    /***************代码开始*********************/
    $sum = 0;
    $len = count($grumpy);
    $tmpSum = 0;
    for ($i = 0; $i < $len; $i++) {
        if ($i < $X) {
            $tmpSum += $customers[$i];
        } else {
            $tmpSum += $customers[$i] * (1 - $grumpy[$i]);
        }
    }
    $sum = max($sum, $tmpSum);

    for ($j = $X; $j < $len; $j++) {
        //如果 grumpy[i - X] == 1，则减去该元素，如果为 0，则不减，
        //如果 grumpy[i] == 1，则增加该元素，如果为 0，则不加
        $tmpSum = $tmpSum + ($customers[$j] * $grumpy[$j]) - ($customers[$j - $X] * $grumpy[$j - $X]);
        $sum = max($sum, $tmpSum);
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
    return $sum;
}

echo deal([1, 0, 1, 2, 1, 1, 7, 5], [0, 1, 0, 1, 0, 1, 0, 1], 3);
echo "\r\n";
echo maxSatisfied([1, 0, 1, 2, 1, 1, 7, 5], [0, 1, 0, 1, 0, 1, 0, 1], 3);

function maxSatisfied($customers, $grumpy, $X)
{
    $start_time = microtime(true);
    $start_memory = memory_get_usage(true);
    /***************代码开始*********************/
    $max_grumpy = 0; //最大能惹生气的客户数量
    $max_grumpy_index = 0; //最大惹生气的客户数量的开始索引
    $last_grumpy = 0; //上一次循环惹生气的客户数量
    $last_grumpy_index = 0; //上一次循环开始的索引

    foreach ($customers as $index => $customer) {
        if ($index < $X) {
            $max_grumpy += $customer;
            $last_grumpy = $max_grumpy;
        }
        if ($index >= $X) {
            $this_grumpy = $last_grumpy;
            //减去头
            if ($grumpy[$index - $X]) {
                $this_grumpy -= $customers[$index - $X];
            }
            //加上尾
            if ($grumpy[$index]) {
                $this_grumpy += $customers[$index];
            }
            //当前循环
            $last_grumpy = $this_grumpy;
            $last_grumpy_index = $index - $X + 1;

            //比较大小,进行替换
            if ($this_grumpy > $max_grumpy) {
                $max_grumpy = $this_grumpy;
                $max_grumpy_index = $index - $X + 1;
            }
        }
    }

    $reset_grumpy = $grumpy;
    for ($i = 0; $i < $X; $i++) {
        $reset_grumpy[$max_grumpy_index + $i] = 0;
    }

    $well_customer_num = 0; //最多有多少客户能够感到满意的数量
    foreach ($customers as $index => $customer) {
        if (!$reset_grumpy[$index]) {
            $well_customer_num += $customer;
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
    return $well_customer_num;
}
