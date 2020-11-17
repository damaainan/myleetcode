<?php declare(strict_types=1);
/*
题目


*/
function deal(){
	$start_time = microtime(true);
	/***************代码开始*********************/
	

	/***************代码结束*******************/
	/***********性能监控***********************/ 
	$end_time = microtime(true);
	$need_time = $end_time - $start_time;
	print_r("耗时:" . $need_time . "\r\n");
	/*******************************************/
	return $res;
}
echo deal();
echo "\r\n\r\n";