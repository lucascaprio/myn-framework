<?php if(!defined('RESTRICTED'))exit('No direct script access.');

final class Pagination
{
	private static $_page = 1;

	public static function getOffset($page, $items_per_page)
	{
		if( !$page ) {
			self::$_page = 1;
			return 0;
		}

		self::$_page = $page;
		return ($page - 1) * $items_per_page;
	}

	public static function getPage()
	{
		return self::$_page;
	}

	public static function getNumberPages($count, $items_per_page)
	{
		return ceil($count / $items_per_page);
	}

	public static function getPreviousPage($page = null)
	{
		if( !$page || $page < 2 ) {
			return false;
		}

		return --$page;
	}

	public static function getNextPage($page = null)
	{
		if( !$page ) {
			return 2;
		}

		return ++$page;
	}
}