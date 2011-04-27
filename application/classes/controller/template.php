<?php defined('SYSPATH') or die('No direct script access.');

abstract class Controller_Template extends Controller_Extraball_Template {
	
	/**
	 * Construct the template
	 *
	 * @return void
	 */
	public function before()
	{
		$this->append_css('ressources/css/smoothness/jquery-ui-1.8.custom.css');
		$this->append_css('ressources/css/style.css');
		$this->append_css('ressources/css/phorms.css');
		
		$this->append_script('ressources/js/jquery-1.4.2.min.js');
		$this->append_script('ressources/js/jquery-ui-1.8.custom.min.js');
		$this->append_script('ressources/js/jquery-ui-i18n.js');
		$this->append_script('ressources/js/validation.js');
		$this->append_script('ressources/js/start.js');
		$this->append_script('ressources/js/phorms.js');
		
		$this->set_home_title('Accueil');
		
		$this->set_site_title('Gestionnaire de todo');
		
		$this->set_site_description('Gestion des todo de Reaklab.');
		
		$this->set_title_separator(' > ');
	}

}
