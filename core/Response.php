<?php if(!defined('RESTRICTED'))exit('No direct script access.');

class Response
{
	public $_vars;

	public function __construct()
	{
		$this->_vars['status'] = false;
		// $this->_vars['status'] = '0';
	}

	public function set($vars, $value = null)
	{
		if (is_array($vars)) {
			foreach ($vars as $key => $value) {
            	$this->_vars[$key] = $value;
			}
		} else {
			$this->_vars[$vars] = $value;
		}
	}

	public function get($key = null)
	{
		if ($key !== null) {
			return $this->_vars[$key];
		} else {
			return $this->_vars;
		}
	}

	public function printVars()
	{
		if ($this->_vars != null) {
			print_r(json_encode($this->_vars));	
		}

		exit;
	}
}