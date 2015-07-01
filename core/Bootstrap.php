<?php if(!defined('RESTRICTED'))exit('No direct script access.');

class Bootstrap
{
	private $_url;
	private $_controller;
	private $_exceptionRoutes;

	public function init()
	{
		$this->_getUrl();

		if( $this->_url === null ) {
			$this->_url[0] = 'Index';
		}

		$this->_callController();
		$this->_callAction();
		$this->_makeMagic();
	}

	public function exception($route)
	{
		if( !empty($route) ) {
			if( is_array($route) ) {
            	foreach( $route as $r ) {
            		$this->_exceptionRoutes[] = $r;
            	}
			}
            else {
				$this->_exceptionRoutes[] = $route;
            }
		}
	}


	/* PRIVATE METHODS */

	private function _getUrl()
	{
		$url = isset($_GET['url']) ? $_GET['url'] : null;

		if ($url !== null) {
			$url = $this->_exceptionRoute($url);
			$url = trim($url, '/');
       		$url = filter_var($url, FILTER_SANITIZE_URL);
        	$url = explode('/', $url);
        	$url = $this->_uppercaseFirst($url);
        	
        	$this->_url = $url;
		}
	}

	private function _callController()
    {
    	$this->_url[0] .= 'Controller';

        $file = 'app/controllers/' . $this->_url[0] . '.php';

        if (file_exists($file)) {
            $this->_controller = new $this->_url[0]();
        } else {
			// $lala = preg_split('/(?=[A-Z])/', $this->_url[0], -1, PREG_SPLIT_NO_EMPTY);
    		// var_dump($lala);
            $this->_error();
        }
    }

    private function _callAction()
    {
    	$length = count($this->_url);

    	if( $length > 1 ) {
            if( !method_exists($this->_controller, $this->_url[1]) ) {
            	$reflection = new ReflectionMethod($this->_url[0], 'index');
				$numberParam = $reflection->getNumberOfParameters();

				if( $numberParam > 0 && $length-1 <= $numberParam ) {
					switch( $length ) {
						case 5:
							$this->_controller->index($this->_url[1], $this->_url[2], $this->_url[3], $this->_url[4]);
						break;
			            
			            case 4:
			                $this->_controller->index($this->_url[1], $this->_url[2], $this->_url[3]);
			            break;
			            
			            case 3:
			                $this->_controller->index($this->_url[1], $this->_url[2]);
						break;

						case 2:
							$this->_controller->index($this->_url[1]);
						break;
					}
				}
				else {
					$this->_error();
				}
            }
            else
            {
            	switch( $length ) {
		            case 5:
						$this->_controller->{$this->_url[1]}($this->_url[2], $this->_url[3], $this->_url[4]); //Controller->Method(Param1, Param2, Param3)
					break;
		            
		            case 4:
		                $this->_controller->{$this->_url[1]}($this->_url[2], $this->_url[3]); //Controller->Method(Param1, Param2)
		            break;
		            
		            case 3:
		                $this->_controller->{$this->_url[1]}($this->_url[2]); //Controller->Method(Param1)
					break;
		            
		            case 2:
		                $this->_controller->{$this->_url[1]}(); //Controller->Method()
					break;
				}
            }
        }
        else {
        	$this->_controller->index();
        }
    }

    private function _error()
	{
		echo 'erro 404';
		exit;
	}

	private function _uppercaseFirst($url)
	{
		//transformando primeiras letras em maiusculo na controller
		$expCtrl = explode('-', $url[0]);
		
		$url[0] = '';
		
		for( $e = 0; $e < count($expCtrl); $e++ ) {
			$url[0] .= ucfirst($expCtrl[$e]);
		}

		//transformando primeiras letras em maiusculo na action
		if( isset($url[1]) ) {
			$expActn = explode('-', $url[1]);
			
			$url[1] = $expActn[0];
			
			for( $e = 1; $e < count($expActn); $e++ ) {
				$url[1] .= ucfirst($expActn[$e]);
			}
		}

		return $url;
	}

	private function _exceptionRoute($route)
	{
		$return = "/";

		for( $i = 0; $i < count($this->_exceptionRoutes); $i++ ) {
			$routes = $this->_explodeRoute($route);
			
			if( $routes[0] === $this->_exceptionRoutes[$i] ) {
				if( isset($routes[1]) ) {
					$return = $return . ucfirst($routes[0]) . ucfirst($routes[1]);
				}
				else {
					$return = $return . ucfirst($routes[0]) . 'Index';
				}

				for( $e = 2; $e < count($routes); $e++ ) {
					$return = $return .'/'. $routes[$e];
				}

				return $return;
			}
		}
		return $route;
	}

	private function _explodeRoute($route)
	{
		if( $route === '/' ) {
			return array('/');
		}
		else {
			$route = trim($route, '/');
        	$route = explode('/', $route);

        	if( substr($route[0], 0, 1) == ':' ) {
        		array_unshift($route, '/');
        	}

        	return $route;
		}
	}

	private function _makeMagic()
	{
		define('CONTROLLER', $this->_url[0]);
		
		if (method_exists($this->_controller, '__alwaysExecute')) {
			$this->_controller->__alwaysExecute();
		}

		if (property_exists($this->_controller, 'view')) {
			$this->_controller->view->renderMaster();
		}
		else if (method_exists($this->_controller->response, 'printVars')) {
			$this->_controller->response->printVars();
		}
	}
}