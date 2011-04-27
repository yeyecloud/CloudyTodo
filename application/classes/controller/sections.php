<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Sections extends Controller_Template {
	
	private $project_id = 0;
	
	function __construct($request)
	{
		parent::__construct($request);
		
		$this->project_id = $this->request->param('pid');
		
		if(empty($this->project_id))
		{
			$this->request->redirect('/projects/index');
		}
		
		$project = ORM::factory('project', $this->project_id);
		$this->title('Projet "' . $project->name . '"', array('controller' => 'sections', 'action' => 'index', 'pid' => $this->project_id));
	}
	
	public function action_index($pid)
	{
		$this->template->contents = new Twig_View('sections/index');
		
		$section_model = ORM::factory('section');
		$todo_model = ORM::factory('todo');
		$sections = $this->_index_recursion($section_model, $todo_model);
		
		$this->template->contents->project_id = $pid;
		$this->template->contents->sections = $sections;
	}
	
	public function _index_recursion($section_model, $todo_model, $parent_id = 0, $parent_name = '')
	{
		$sections = $section_model
			->where('project_id', '=', $this->project_id)
			->where('parent_id', '=', $parent_id)
			->find_all();
		
		$subsections = array();
		foreach($sections as $section)
		{
			$subsections[] = $this->_index_recursion($section_model, $todo_model, $section->id, $section->name);
		}
		$others = implode(PHP_EOL, $subsections);
		
		if($parent_id != 0)
		{
			$view = new Twig_View('sections/index_recursion');
			
			$todos = $todo_model
				->where('section_id', '=', $parent_id)
				->find_all();
			
			if($todos->count() > 0)
			{
				$view->todos = $todos;
			}
			else
			{
				$view->todos = '';
			}
			
			$view->section = $parent_name;
			
			$view->project_id = $this->project_id;
			$view->section_id = $parent_id;
			$view->others = $others;
		}
		else
		{
			$view = $others;
		}
		
		return $view;
	}
	
	public function action_add($pid)
	{
		$this->title('Ajouter une section', $this->request->uri());
		
		$form = new Form_Section_Add(Phorm::POST, false, array(), $pid);
		
		if($form->is_bound() && $form->is_valid())
		{
			$form->process($pid);
			$this->template->contents = Message::confirmation('Section ajoutée avec succès !');
		}
		else
		{
			$this->template->contents = $form->render(URL::site($this->request->uri()));
		}
	}
	
	public function action_edit($pid, $sid)
	{
		$section_id = $this->request->param('sid');
		
		$this->title('Modifier une section', $this->request->uri());
		
		$section = ORM::factory('section', $sid);
		$data = array(
			'name' => $section->name,
			'parent_id' => $section->parent_id
		);
		
		$form = new Form_Section_Add(Phorm::POST, false, $data, $pid, $section);
		
		if($form->is_bound() && $form->is_valid())
		{
			$form->process($this->project_id, $sid);
			$this->template->contents = Message::confirmation('Section modifiée avec succès !');
		}
		else
		{
			$this->template->contents = $form->render(URL::site($this->request->uri()));
		}
	}
	
	public function action_delete($pid, $sid)
	{
		ORM::factory('section')->delete($sid);
		$this->request->redirect('/sections/index/' . $pid);
	}

}
