<?php
	if (extension_loaded('zlib')) {
		// initialize ob_gzhandler function to send and compress data 
		ob_start('ob_gzhandler');
	}
	
	// Store reference to querystring for faster access
	$filelist = $_GET['files'];
	
	// Check for a valid file type
	if (strtolower($_GET['filetype']) == 'js') {
		$content_type = "javascript";
		$extention = ".js";
	} elseif (strtolower($_GET['filetype']) == 'css') {
		$content_type = "css";
		$extention = ".css";
	} else {
		die('An unknown file type was provided');
	}
	
	// Request 'YUI Compressor' PHP Wrapper
	include "YUICompressor.php";
	
	// Send the requisite header information and character set 
	header ("content-type: text/$content_type; charset: UTF-8");
	
	// Grab each file and check they exist
	$files = explode(",", $filelist);
	$list = '';
	$options = array('nomunge' => true, 'line-break' => 1000);
	
	// List the files to be included
	foreach ($files as $value) {
		if (file_exists($value.$extention)) {
			$list .= file_get_contents($value.$extention);
		}
	}
	
	// Set-up paths
	Minify_YUICompressor::$jarFile = $_SERVER['DOCUMENT_ROOT'].'/PHP/Mini-Com/yuicompressor-2.4.2.jar';
 	Minify_YUICompressor::$tempDir = $_SERVER['DOCUMENT_ROOT'].'/PHP/Mini-Com/tmp';
	
	// First check which YUI method to call (Js or Css)
	// Then store the resulting 'minified' code in a variable
	if ($content_type == 'javascript') {
		$code = Minify_YUICompressor::minifyJs($list ,$options);
	} else {
		$code = Minify_YUICompressor::minifyCss($list, $options);
	}
	
	// Now write the optimised code to the file
	echo $code;
		
	if (extension_loaded('zlib')) {
		ob_end_flush();
	}
?>