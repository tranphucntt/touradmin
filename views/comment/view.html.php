<?php

// No direct access to this file
defined('_JEXEC') or die;

class BookproViewComment extends JViewLegacy
{
	

	public function display($tpl = null)
	{
		$this->form		= $this->get('Form');
		$this->item		= $this->get('Item');
		$this->state	= $this->get('State');
		$this->addToolbar();
		parent::display($tpl);
	}
	
	protected function addToolbar()
	{
		//JRequest::setVar('hidemainmenu', true);
		JToolbarHelper::title ( $this->item->id?JText::_ ( 'COM_BOOKPRO_MANAGER_BOOKPRO_EDIT' ):JText::_ ( 'COM_BOOKPRO_MANAGER_BOOKPRO_NEW' ),'comment');
		JToolBarHelper::apply('comment.apply');
		JToolBarHelper::save('comment.save');
		JToolBarHelper::cancel('comment.cancel');
		 
		 
		JHtml::_('behavior.modal','a.jbmodal');
		JHtml::_('behavior.formvalidation');
	}
}

