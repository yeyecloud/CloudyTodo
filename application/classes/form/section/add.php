<?php defined('SYSPATH') or die('No direct script access.');

class Form_Section_Add extends Phorm
{
	public function __construct($method=Phorm::GET, $multi_part=false, $data=array(), $project_id = 0, $section_id = 0)
	{
		$this->project_id = $project_id;
		$this->section_id = $section_id;
		parent::__construct($method, $multi_part, $data);
	}
	
	public function define_fields()
	{
		$this->name = new Phorm_Field_Text('Nom', 32, 255, array(Phorm_Validation::Required()));
		
		$parents = array('Aucune');
		$sections = ORM::factory('section');
		$sections = $sections->where('project_id', '=', $this->project_id);
		if(!empty($section_id))
		{
			$sections = $sections->where('section_id', '=', $this->section_id);
		}
		$sections = $sections->find_all();
		foreach($sections as $section)
		{
			$parents[$section->id] = $section->name;
		}
		$this->parent_id = new Phorm_Field_Dropdown('Section parente', $parents, array(Phorm_Validation::Required()));
	}
	
	public function process($project_id, $section = 0)
	{
		$data = $this->cleaned_data();

		if($section == 0)
		{
			$section = ORM::factory('section');
		}
		else
		{
			$section = ORM::factory('section', $section);
		}
		$section->project_id = $project_id;
		$section->name = $data['name'];
		$section->parent_id = $data['parent_id'];
		$section->save();
	}
}
