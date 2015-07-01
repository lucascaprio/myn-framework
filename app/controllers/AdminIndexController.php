<?php if(!defined('RESTRICTED'))exit('No direct script access.');

class AdminIndexController extends Controller
{
	public function __construct()
	{
		if (Session::get('admin')) {
			Util::redirect(URL_ADMIN.'home');
		}
	}

	public function index()
	{
		$view = $this->loadView('admin/index/login');
		$view->setTitle('Sign in');
	}
}