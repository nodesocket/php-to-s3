<?php
	/*
	* php-to-s3.php
	*
	* https://github.com/nodesocket/php-to-s3 
	*/

	/*
	# Copyright 2013 NodeSocket, LLC
	#
	# Licensed under the Apache License, Version 2.0 (the "License");
	# you may not use this file except in compliance with the License.
	# You may obtain a copy of the License at
	#
	# http://www.apache.org/licenses/LICENSE-2.0
	#
	# Unless required by applicable law or agreed to in writing, software
	# distributed under the License is distributed on an "AS IS" BASIS,
	# WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
	# See the License for the specific language governing permissions and
	# limitations under the License.
	#
	# Amazon S3 is a trademark of Amazon.com, Inc. or its affiliates.
	*/

	require(__DIR__ . "/lib/S3.php");

	define("AWS_ACCESS_KEY", "");
	define("AWS_SECRET_KEY", "");

	define("VERSION", "v1.1.1");

	if(!isset($argv[1]) || empty($argv[1])) {
		fwrite(STDERR, "\tusage: php -f php-to-s3.php <bucket-name> <source-dir>\n");
		exit(1);
	}

	if($argv[1] === "version" && empty($argv[2])) {
		fwrite(STDOUT, "\t" . VERSION . "\n");
		exit(0);
	}

	if(!isset($argv[2]) || empty($argv[2])) {
		fwrite(STDERR, "\tusage: php -f php-to-s3.php <bucket-name> <source-dir>\n");
		exit(2);
	}
 
	$bucket = trim($argv[1]);
	$source = rtrim(trim($argv[2]), "/");

	$env_access_key = getenv("AWS_ACCESS_KEY");
	$env_secret_key = getenv("AWS_SECRET_KEY");
	$aws_access_key = (!empty($env_access_key)) ? $env_access_key : AWS_ACCESS_KEY;
	$aws_secret_key = (!empty($env_secret_key)) ? $env_secret_key : AWS_SECRET_KEY;

	if(empty($aws_access_key) || empty($aws_secret_key)) {
		fwrite(STDERR, "\t[error] AWS_ACCESS_KEY and AWS_SECRET_KEY must be set.\n");
		exit(3);	
	}

	$s3 = new S3($aws_access_key, $aws_secret_key);
	$s3->setExceptions(true);
	$s3->setSSL(true);
	$s3->setEndpoint("s3-us-west-2.amazonaws.com");

	if(!is_dir($source)) {
		fwrite(STDERR, "\t[error] Source directory '" . $source . "' either does not exist, or is not a directory.\n");
		exit(4);
	}

	if ($handle = opendir($source)) {
	    while (false !== ($file = readdir($handle))) {
	        if ($file !== "." && $file !== ".." && $file !== ".DS_Store") {
	            try {
	            	$s3->putObject($s3->inputFile($source . "/" . $file), $bucket, $file, S3::ACL_PRIVATE, array(), array(), S3::STORAGE_CLASS_STANDARD, S3::SSE_AES256);
	            	fwrite(STDOUT, "\t[notice] Successfully put file '" . $source . "/" . $file . "'.\n");
	            } catch(Exception $ex) {
	            	fwrite(STDERR, "\t[error] Failed to put file '" . $source . "/" . $file . "'.\n\t\tdetails: " . $ex->getMessage() . "\n");
	            }
	        }
	    }

	    closedir($handle);
	}
?>