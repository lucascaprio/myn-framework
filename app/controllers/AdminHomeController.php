<?php if(!defined('RESTRICTED'))exit('No direct script access.');

class AdminHomeController extends ControllerAdmin
{
	public function index()
	{
		$view = $this->loadView($this->_master);
		
		$view->setTitle('Admin - Home');
		$view->addViews('admin/home/index');
	}

	public function logout()
	{
		Session::destroy();
		Util::redirect(URL_ADMIN);
	}
}