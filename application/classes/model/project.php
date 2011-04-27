<?php defined('SYSPATH') or die('No direct script access.');

class Model_Project extends ORM
{
	protected $table_name = 'projects';
	protected $_ignored_columns = array('fixed');
	
	public function delete($id = NULL)
	{
		if ($id === NULL)
		{
			// Use the the primary key value
			$id = $this->pk();
		}
		
		if(!empty($id) || $id === '0')
		{
			ORM::factory('section')->where('project_id', '=', $id)->delete();
		}
		
		parent::delete($id);

		return $this;
	}
}
