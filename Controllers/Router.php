<?php
	
	$url = isset($_SERVER['PATH_INFO']) ? explode('/', $_SERVER['PATH_INFO']) : '/';
	
	var_dump($url);
	