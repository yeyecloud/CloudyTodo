<?php defined('SYSPATH') or die('No direct script access.');

class Form_Todo_Add extends Phorm
{
	public function define_fields()
	{
		$this->name = new Phorm_Field_Text('Nom', 60, 128, array(Phorm_Validation::Required()));
		$this->description = new Phorm_Field_Largetext('Description', 5, 60);
		$this->duedate = new Phorm_Field_Date('Date limite');
		
		$priority = array(
			'0' => 'Nulle',
			'1' => 'Faible',
			'2' => 'Moyen',
			'3' => 'Élevé',
			'4' => 'Critique'
		);
		$this->priority = new Phorm_Field_Dropdown('Priorité', $priority, array(Phorm_Validation::Required()));
		
		$statut = array(
			'todo' => 'A faire',
			'tofix' => 'A corriger',
			'fixed' => 'Réglé'
		);
		$this->status = new Phorm_Field_Dropdown('Statut', $statut, array(Phorm_Validation::Required()));
	}
	
	public function process($section_id, $todo_id = 0)
	{
		$data = $this->cleaned_data();
		
		if(empty($todo_id))
		{
			$project = ORM::factory('todo');
		}
		else
		{
			$project = ORM::factory('todo', $todo_id);
		}
		$project->section_id = $section_id;
		$project->name = $data['name'];
		$project->description = $data['description'];
		$project->duedate = $data['duedate'];
		$project->priority = $data['priority'];
		$project->status = $data['status'];
		$project->save();
	}
}
