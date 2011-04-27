<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Projects extends Controller_Template {
	
	function __construct($request)
	{
		parent::__construct($request);
		
		//$this->title('Les projets', array('controller' => 'projects'));
	}
	
	public function action_index()
	{
		$this->template->contents = new Twig_View('projects/index');
		$projects = ORM::factory('project')->find_all();

		$query = DB::query(Database::SELECT, "SELECT COUNT(*) FROM todos WHERE status='fixed' AND section_id IN (SELECT id FROM sections WHERE project_id=:project)")
		->bind(':project', $project_id);
		$query2 = DB::query(Database::SELECT, "SELECT COUNT(*) FROM todos WHERE section_id IN (SELECT id FROM sections WHERE project_id=:project)")
		->bind(':project', $project_id);
		
		$fixed = array();
		foreach ($projects as $project)
		{
			$project_id = $project->id;
			$count_fixed = $query->execute()->as_array();
			$count_all = $query2->execute()->as_array();

			if($count_all[0]['COUNT(*)'] > 0 && $count_all[0]['COUNT(*)'] == $count_fixed[0]['COUNT(*)'])
			{
				$fixed[] = $project->id;
			}
		}
		
		$this->template->contents->fixed = $fixed;
		$this->template->contents->projects = $projects;
	}
	
	public function action_add()
	{
		$this->title('Ajouter un projet', $this->request->uri());
		
		$form = new Form_Project_Add(Phorm::POST, false);
		
		if($form->is_bound() && $form->is_valid())
		{
			$form->process();
			$this->template->contents = Message::confirmation('Projet ajouté avec succès !');
		}
		else
		{
			$this->template->contents = $form->render(URL::site($this->request->uri()), false);
		}
	}
	
	public function action_edit($pid)
	{
		$this->title('Modifier un projet', $this->request->uri());
		
		$section = ORM::factory('project', $pid);
		$data = array(
			'name' => $section->name,
			'begindate' => date('d/m/Y', $section->begindate),
			'duedate' => date('d/m/Y', $section->duedate)
		);
		
		$form = new Form_Project_Add(Phorm::POST, false, $data);
		
		if($form->is_bound() && $form->is_valid())
		{
			$form->process($this->project_id);
			$this->template->contents = Message::confirmation('Projet modifié avec succès !');
		}
		else
		{
			$this->template->contents = $form->render(URL::site($this->request->uri()));
		}
	}
	
	public function action_delete($pid)
	{
		ORM::factory('project')->delete($pid);
		$this->request->redirect('/projects/index');
	}

}
