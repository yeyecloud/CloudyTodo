<?php defined('SYSPATH') or die('No direct script access.');

if(Request::$is_ajax)
{
	abstract class Controller_Extraball_Template_Ajax extends Controller
	{
		/**
		 * Construct the template
		 *
		 * @return void
		 */
		function __construct($request)
		{
			$this->template = (object) array('contents');
		}
	
		/**
		 * Assigns the template as the request response.
		 *
		 * @param   string   request method
		 * @return  void
		 */
		public function after()
		{
			if ($this->auto_render === TRUE)
			{
				$this->request->response = $this->template->contents;
			}

			return parent::after();
		}
	
		/**
		 * Dynamic fallback for Controller_Template methods
		 *
		 * @param   string   Name of the requested method
		 * @param   array   Arguments of the requested method
		 * @return  void
		 */
		public function __call($name, $arguments)
		{
			
		}
	}
}
else
{
	abstract class Controller_Extraball_Template_Ajax extends Controller_Template
	{
		
	}
}
