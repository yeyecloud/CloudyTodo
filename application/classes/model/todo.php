<?php defined('SYSPATH') or die('No direct script access.');

class Model_Todo extends ORM
{
	protected $table_name = 'todos';

	public function delete($id = NULL)
	{
		if ($id === NULL)
		{
			// Use the the primary key value
			$id = $this->pk();
		}
		
		if(!empty($id) || $id === '0')
		{
			ORM::factory('annotation')->where('todo_id', '=', $id)->delete();
		}
		
		parent::delete($id);

		return $this;
	}
}
