<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Todos extends Controller_Template {
	
	function __construct($request)
	{
		parent::__construct($request);
		
		$project_id = $this->request->param('pid');
		$section_id = $this->request->param('sid');
		
		if(empty($project_id))
		{
			$this->request->redirect('/projects/index');
		}
		
		if(empty($section_id))
		{
			$this->request->redirect('/sections/index/' . $project_id);
		}
		
		$project = ORM::factory('project', $project_id);
		$this->title('Projet "' . $project->name . '"', array('controller' => 'sections', 'action' => 'index', 'pid' => $project_id, 'sid' => $section_id));
	}
	
	public function action_add($pid, $sid)
	{
		$this->title('Ajouter un toto', $this->request->uri());
		
		$form = new Form_Todo_Add(Phorm::POST, false);
		
		if($form->is_bound() && $form->is_valid())
		{
			$form->process($sid);
			$this->template->contents = Message::confirmation('Todo ajouté avec succès !');
		}
		else
		{
			$this->template->contents = $form->render(URL::site($this->request->uri()));
		}
	}
	
	public function action_edit($pid, $sid, $tid)
	{
		$this->title('Modifier un todo', $this->request->uri());
		
		$todo = ORM::factory('todo', $tid);
		
		$duedate = '';
		if($todo->duedate == 0)
		{
			$duedate = date('d/m/Y', $todo->duedate);
		}
		
		$data = array(
			'name' => $todo->name,
			'description' => $todo->description,
			'priority' => $todo->priority,
			'duedate' => $duedate,
			'status' => $todo->status
		);
		
		$form = new Form_Todo_Add(Phorm::POST, false, $data);
		
		if($form->is_bound() && $form->is_valid())
		{
			$form->process($sid, $tid);
			$this->template->contents = Message::confirmation('Todo modifié avec succès !');
		}
		else
		{
			$this->template->contents = $form->render(URL::site($this->request->uri()));
		}
	}
	
	public function action_delete($pid, $sid, $tid)
	{
		ORM::factory('todo')->delete($tid);
		$this->request->redirect('/sections/index/' . $pid . '/' . $sid);
	}
	
	public function action_fixed($pid, $sid, $tid)
	{
		$todo = ORM::factory('todo', $tid);
		$todo->status = 'fixed';
		$todo->save();
		$this->request->redirect('/sections/index/' . $pid . '/' . $sid);
	}
	
	public function action_progress($pid, $sid, $tid)
	{
		$this->title('Modifier la \'état d\'avancement d\'un todo', $this->request->uri());
		
		if(Validate::digit($_POST['progress']) && Validate::range($_POST['progress'], 0, 100))
		{
			$todo = ORM::factory('todo', $tid);
		
			$todo->progress = $_POST['progress'];
			$todo->save();
			
			$this->template->contents = 'OK';
		}
		$this->template->contents = 'NOK';
	}

}
