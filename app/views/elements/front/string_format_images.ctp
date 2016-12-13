<?php if(isset($body)){
	$search = '/app/webroot/img/ckeditor';
	$replace = $base_url.$search;
	$body = str_replace($search, $replace, $body);
	echo $body;
}?>