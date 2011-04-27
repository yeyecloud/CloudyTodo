<?php defined('SYSPATH') or die('No direct script access.');

class Model_Section extends ORM
{
	//protected $has_one = array('project');

	public function delete($id = NULL)
	{
		if ($id === NULL)
		{
			// Use the the primary key value
			$id = $this->pk();
		}
		
		if(!empty($id) || $id === '0')
		{
			ORM::factory('todo')->where('section_id', '=', $id)->delete();
		}
		
		parent::delete($id);

		return $this;
	}
}
