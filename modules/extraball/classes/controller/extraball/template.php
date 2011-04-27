<?php defined('SYSPATH') or die('No direct script access.');

abstract class Controller_Extraball_Template extends Controller_Twig_Template {
	
	/**
	 * @var string Path to the default layout
	 */
	protected $template = 'template/template';
	
	/**
	 * @var array List of breadcrumbs links
	 */
	protected $breadcrumbs = array(
		array('Home', array('controller' => NULL))
	);
	
	/**
	 * @var string Separator of title elements
	 */
	public $title_separator = ' > ';
	
	/**
	 * @var array Title of the page
	 */
	protected $title = array('Default title');
	
	/**
	 * @var string Description for the meta-tag.
	 */
	protected $description = 'Site description.';
	
	/**
	 * @var array List of external css files
	 */
	private $css = array();
	
	/**
	 * @var array List of external javascript files
	 */
	private $scripts = array();
	
	/**
	 * Pre-process template rendering at the end
	 *
	 * @return void
	 */
	public function after()
	{
		$this->build_head();
		
		$this->build_breadcrumb();
		
		$this->build_profiler();
		
		parent::after();
	}
	
	/**
	 * Append a string to the current page's title and add it to the breadcrumb
	 * @param string $title
	 * @return void
	 */
	public function title($title, $uri = array('controller' => NULL))
	{
		$this->title[] = HTML::chars($title);
		
		$this->breadcrumbs[] = array($title, $uri);
	}
	
	/**
	 * Prepend a css inclusion to the template
	 *
	 * @param string $file The absolute path to the file (not the URL !)
	 * @return void
	 */
	protected function prepend_css($file, $properties = array())
	{
		array_unshift($this->css, array($file, $properties));
	}
	
	/**
	 * Append a css inclusion to the template
	 *
	 * @param string $file The absolute path to the file (not the URL !)
	 * @return void
	 */
	protected function append_css($file, $properties = array())
	{
		$this->css[] = array($file, $properties);
	}
	
	/**
	 * Append a script inclusion to the template
	 *
	 * @param string $file The absolute path to the file (not the URL !)
	 * @return void
	 */
	protected function prepend_script($file)
	{
		array_unshift($this->scripts, $file);
	}
	
	/**
	 * Append a script inclusion to the template
	 *
	 * @param string $file The absolute path to the file (not the URL !)
	 * @return void
	 */
	protected function append_script($file)
	{
		$this->scripts[] = $file;
	}
	
	/**
	 * Sets the website title
	 *
	 * @param string $title The website title
	 * @return void
	 */
	protected function set_site_title($title)
	{
		$this->title[0] = $title;
	}
	
	/**
	 * Sets the title separator
	 *
	 * @param string $separator The title separator
	 * @return void
	 */
	protected function set_title_separator($separator)
	{
		$this->title_separator = $separator;
	}
	
	/**
	 * Sets the website description
	 *
	 * @param string $description The website description
	 * @return void
	 */
	protected function set_site_description($description)
	{
		$this->description = $description;
	}
	
	/**
	 * Sets the homepage title
	 *
	 * @param string $title The homepage title
	 * @return void
	 */
	protected function set_home_title($title)
	{
		$this->breadcrumbs[0][0] = $title;
	}
	
	/**
	 * Build the header of the page
	 *
	 * @return void
	 */
	private function build_head()
	{
		// Displays the title and description
		$this->template->title = implode($this->title_separator, $this->title);
		$this->template->description = $this->description;
		
		// Adds css and javascript files
		$this->template->bind('stylesheets', $stylesheets);
		$stylesheets = array();
		foreach($this->css as $sheet)
		{
			$stylesheets[] = HTML::style($sheet[0], $sheet[1]);
		}
		
		$this->template->bind('scripts', $scripts);
		$scripts = array();
		foreach($this->scripts as $script)
		{
			$scripts[] = HTML::script($script);
		}
	}
	
	/**
	 * Add the breadcrumb to the template
	 *
	 * @return void
	 */
	private function build_breadcrumb()
	{
		// Build the breadcrumb
		$route = Route::get('default');
		
		// Bind the breadcrumb to the layout
		$this->template->breadcrumb_current = URL::site($this->request->uri());
		$this->template->breadcrumb_base = URL::base();
		$this->template->bind('breadcrumbs', $breadcrumbs);
		
		$breadcrumb_latest = end($this->breadcrumbs);
		$breadcrumbs = array();
		
		foreach($this->breadcrumbs as $breadcrumb)
		{
			if($breadcrumb == $breadcrumb_latest)
			{
				$path = $this->request->uri();
			}
			else
			{
				if(is_array($breadcrumb[1]))
				{
					$path = $route->uri($breadcrumb[1]);
				}
				else
				{
					$path = $breadcrumb[1];
				}
			}
			$breadcrumbs[] = array(
				'path' => URL::site($path),
				'title' => $breadcrumb[0]
			);
		}
	}
	
	/**
	 * Build the profiler if in development mode
	 *
	 * @return void
	 */
	private function build_profiler()
	{
		// Define environment type
		$environment = in_array(Kohana::$environment, array('development', 'testing'));
		
		if($environment)
		{
			$this->template->debug_profiler = DebugToolbar::render();
			//$this->template->debug_profiler = View::factory('profiler/stats');
		}
	}

}
