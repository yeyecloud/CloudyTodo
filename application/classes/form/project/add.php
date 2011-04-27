<?php defined('SYSPATH') or die('No direct script access.');

class Form_Project_Add extends Phorm
{
	public function define_fields()
	{
		$this->name = new Phorm_Field_Text('Nom', 60, 64, array(Phorm_Validation::Required()));
		
		$this->begindate = new Phorm_Field_Date('Date de début', array(Phorm_Validation::Required(), Phorm_Validation::DateNotInPast()));
		$this->duedate = new Phorm_Field_Date('Date de fin', array(Phorm_Validation::Required(), Phorm_Validation::DateNotInPast()));
		$this->test = new Phorm_Field_Integer('TEST', 4, array(Phorm_Validation::Required()));
	}
	
	public function process($project_id)
	{
		$data = $this->cleaned_data();
		
		if(empty($project_id))
		{
			$project = ORM::factory('project');
		}
		else
		{
			$project = ORM::factory('project', $project_id);
		}
		$project->name = $data['name'];
		$project->begindate = $data['begindate'];
		$project->duedate = $data['duedate'];
		$project->save();
	}
}
