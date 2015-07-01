<?php if(!defined('RESTRICTED'))exit('No direct script access.');

abstract class Controller
{
	protected function loadView($master)
	{
		return $this->view = new View($master);
	}

	protected function loadResponse()
	{
		return $this->response = new Response();
	}

	protected function loadModel($model)
	{
		// $model .= 'Model';
		return new $model();
	}
}