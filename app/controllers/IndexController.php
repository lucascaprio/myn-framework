<?php if(!defined('RESTRICTED'))exit('No direct script access.');

class IndexController extends Controller
{
	public function index()
	{
		$view = $this->loadView("site/shared/master");

		$view->setTitle('Myn Framework');
		$view->addViews('site/index');
	}
}