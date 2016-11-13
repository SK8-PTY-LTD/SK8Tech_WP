<?php
// Before removing this file, please verify the PHP ini setting `auto_prepend_file` does not point to this.

if (file_exists('/home/skasia/public_html/sk8.tech/wp-content/plugins/wordfence/waf/bootstrap.php')) {
	define("WFWAF_LOG_PATH", '/home/skasia/public_html/sk8.tech/wp-content/wflogs/');
	include_once '/home/skasia/public_html/sk8.tech/wp-content/plugins/wordfence/waf/bootstrap.php';
}
?>