<?php if(!defined('RESTRICTED'))exit('No direct script access.');

class View extends Asset
{
	private $_vars;
	private $_master;
	private $_title;
	private $_views = array();
	private $_viewsBefore = array();

	public function __construct($master)
	{
		$this->setMaster($master);
	}

	public function set($vars, $value = null)
	{
		if(is_array($vars))
			foreach($vars as $key => $value)
            	$this->_vars[$key] = $value;
		else
			$this->_vars[$vars] = $value;
	}

	public function get($key = null)
	{
		if($key !== null)
			return $this->_vars[$key];
		else
			return $this->_vars;
	}

	public function setMaster($master)
	{
		$this->_master = $master;
	}

	public function setTitle($title)
	{
		$this->_title = $title;
	}

	public function getTitle()
	{
		return $this->_title;
	}

	public function addViews($views, $before = null)
	{
		if( is_array($views) ) {
            foreach( $views as $view ) {
            	if( $before == null ) {
            		$this->_views[] = $view;
            	}
            	else {
            		$this->_viewsBefore[] = $view;
            	}
            }
		}
	    else {
	    	if( $before == null ) {
	    		$this->_views[] = $views;
	    	}
	    	else {
	    		$this->_viewsBefore[] = $views;
	    	}
	    }
	}

	public function renderMaster()
	{
		include 'app/views/' . $this->_master . '.php';
	}

	public function renderViews()
	{
		if( $this->_vars !== null ) {
			extract($this->_vars);
		}

		$this->_views = array_merge($this->_viewsBefore, $this->_views);

		if(!empty($this->_views))
            foreach($this->_views as $view)
                include 'app/views/'. $view .'.php';
	}
}