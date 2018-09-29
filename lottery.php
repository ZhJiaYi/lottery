<?php

/**
 * 初始化可进行抽奖的名单，并返回中奖编号
 * @param $arr
 * @return int
 */
function lottery($arr) {
    $total = array_sum($arr);
    foreach ($arr as $item => $value) {
        if ($item != 0) {
            $arr[$item] = round(($value / $total) * 100) + $arr[$item - 1];
        } else {
            $arr[$item] = round(($value / $total) * 100);
        }
    }
    $item = rand(0, 100);
    $index = getValue($item, $arr, count($arr));
    return $index;
}

/**
 * 通过递归实现中奖逻辑
 * @param $item 中奖号码
 * @param $arr 被查找的数组
 * @param int $end
 * @param int $start
 * @return int
 */
function getValue($item, $arr, $end = 100, $start = 0) {
    $middle = intval(round(($start + $end) / 2));
    if ($arr[$middle] >= $item && $middle == 0 || $arr[$middle - 1] < $item && $arr[$middle] >= $item) {
        return $middle;
    } elseif ($arr[$middle] < $item) {
        return getValue($item, $arr, $middle + 1, $end);
    } else {
        return getValue($item, $arr, $start, $middle - 1);
    }

}

$arr = [12, 15, 2, 56, 79, 12, 4, 46, 136];//点赞数

echo lottery($arr);

exit();
