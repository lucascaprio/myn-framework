<?php if(!defined('RESTRICTED'))exit('No direct script access.');

abstract class Asset
{
	private $_styles;
	private $_scripts;

	public function addStyles($styles)
	{
		if( is_array($styles) ) {
            foreach( $styles as $style ) {
            	$this->_styles[] = $style;
            }
		}
	    else {
	    	$this->_styles[] = $styles;
	    }
	}

	public function addScripts($scripts)
	{
		if( is_array($scripts) ) {
            foreach( $scripts as $script ) {
            	$this->_scripts[] = $script;
            }
		}
	    else {
	    	$this->_scripts[] = $scripts;
	    }
	}

	public function renderStyles()
	{
		if( !empty($this->_styles) ) {
            foreach( $this->_styles as $style ) {
                echo '<link rel="stylesheet" type="text/css" href="'. URL_CSS . $style .'.css" />';
            }
		}
	}

	public function renderScripts()
	{
		if( !empty($this->_scripts) ) {
            foreach( $this->_scripts as $script ) {
                echo '<script type="text/javascript" src="'. URL_JS . $script .'.js"></script>';
            }
		}
	}
}