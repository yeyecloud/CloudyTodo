<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Annotations extends Controller_Template_Ajax
{
	public function action_add($tid)
	{
		$this->title('Ajouter une section', $this->request->uri());
		
		$form = new Form_Annotation_Add(Phorm::POST, false, array(), $pid);
		
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
	
	public function action_edit($tid)
	{
		$section_id = $this->request->param('sid');
		
		$this->title('Modifier une annotation', $this->request->uri());
		
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
	
	public function action_delete($tid)
	{
		ORM::factory('section')->delete($sid);
	}
}
