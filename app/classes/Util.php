<?php if(!defined('RESTRICTED'))exit('No direct script access.');

final class Util
{
	public static function slug( $text )
	{
		$text = preg_replace('~[^\\pL\d]+~u', '-', $text);
		$text = trim($text, '-');
		$text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
		$text = strtolower($text);
	  	$text = preg_replace('~[^-\w]+~', '', $text);

	  	return empty($text) ? 'something' : $text;
	}

	public static function recoverSlug( $slug )
	{
		$slug = preg_split('/(?=[A-Z])/', $slug, -1, PREG_SPLIT_NO_EMPTY);
		return strtolower(implode('-', $slug));
	}
	
	public static function redirect($url)
	{	
    	if (!headers_sent())
        	header('Location: '.$url);
    	else
    	{
	        echo '<script type="text/javascript">',
					'window.location.href= "'.$url.'";',
				  '</script>',
				  '<noscript>',
					'<meta http-equiv="refresh" content="0;url='.$url.'" />',
				  '</noscript>';
    	}
		exit;
	}

	public static function read_dir( $dir, $disconsider = null )
	{
		$diff = array('.', '..');

		if($disconsider !== null) {
			if(is_array($disconsider))
				$disconsider = array_merge($diff, $disconsider);
			else
				$diff[] = $disconsider;
		}

		return array_diff(scandir($dir), $diff);
	}

	public static function del_tree( $dir )
	{
   		$files = array_diff(scandir($dir), array('.','..'));
    	foreach($files as $file)
    	{
      		(is_dir($dir ."/". $file)) ? Util::del_tree($dir ."/". $file) : unlink($dir ."/". $file);
    	}

    	return rmdir($dir);
	}

	public static function getUrlController($controller)
	{
		$controller = str_replace('Controller', '', $controller);

		if ($controller == 'AdminLaresTemporarios') {
			return 'admin/lares-temporarios';
		} else {
			return strtolower(preg_replace('/(?<!^)([A-Z])/', '/\\1', $controller));
		}
	}
}