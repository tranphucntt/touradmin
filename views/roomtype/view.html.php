<?php

/**
 * @package 	Bookpro
 * @author 		Ngo Van Quan
 * @link 		http://joombooking.com
 * @copyright 	Copyright (C) 2011 - 2012 Ngo Van Quan
 * @license 	GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 * @version 	$Id: view.html.php 84 2012-08-17 07:16:08Z quannv $
 **/
defined('_JEXEC') or die('Restricted access');

//import needed Joomla! libraries
jimport('joomla.application.component.view');

class BookProViewRoomtype extends JViewLegacy
{
   	
	protected $form;
	protected $item;
	protected $state;

	/**
	 * (non-PHPdoc)
	 * @see JViewLegacy::display()
	 */
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
		JToolBarHelper::title($this->item->id?JText::_('COM_BOOKPRO_EDIT_ROOMTYPE'):JText::_('COM_BOOKPRO_NEW_ROOMTYPE'), 'refund');
		JToolBarHelper::apply('roomtype.apply');
		JToolBarHelper::save('roomtype.save');
		JToolBarHelper::cancel('roomtype.cancel');
	}
   
   
    
}

?>