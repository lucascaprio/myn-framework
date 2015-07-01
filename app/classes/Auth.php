<?php if(!defined('RESTRICTED'))exit('No direct script access.');

class Auth
{
	public static function admin()
	{
		if( !Session::get('admin') ) {
			Util::redirect(URL_ADMIN);
		}
	}
}