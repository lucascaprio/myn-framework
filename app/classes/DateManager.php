<?php if(!defined('RESTRICTED'))exit('No direct script access.');

final class DateManager
{
	public static function convert_br_to_db( $date )
	{
		$d = explode("/", $date);
		return $d[2] .'-'. $d[1] .'-'. $d[0];
	}

	public static function convert_db_to_br( $date )
	{
		$d = explode("-", $date);
		return $d[2] .'/'. $d[1] .'/'. $d[0];
	}
}