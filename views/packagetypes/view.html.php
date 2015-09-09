<?php

/**
 * @package 	Bookpro
 * @author 		Ngo Van Quan
 * @link 		http://joombooking.com
 * @copyright 	Copyright (C) 2011 - 2012 Ngo Van Quan
 * @license 	GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 * @version 	$Id: view.html.php 26 2012-07-08 16:07:54Z quannv $
 **/

defined('_JEXEC') or die('Restricted access');


class BookProViewPackageTypes extends JViewLegacy {

	protected $items;
	protected $state;
	protected $pagination;
	
	public function display($tpl = null){
		//get data from database into items
		$this->items = $this->get('Items');
		$this->state = $this->get('State');
		$this->tour_id	= JFactory::getApplication()->getUserState('com_bookpro.packagetypes.filter.tour_id');
	
		$this->pagination = $this->get('Pagination');	
		
		if (count($error = $this->get('Errors'))){
			JError::raiseError(500, implode ("\n", $errors));
			return false;
		}
	
		$this->addToolbar();
		foreach ($this->items as &$item)
		{
			$item->order_up = true;
			$item->order_dn = true;
		}
		parent::display($tpl);
	}
	
	protected function addToolbar(){
		JToolBarHelper::title(JText::_('COM_BOOPRO_MANAGER_PACKAGETYPES'));
		JToolbarHelper::apply('packagetypes.save');
		JToolbarHelper::addNew('add');	
		JToolbarHelper::deleteList('','packagetypes.delete', 'JTOOLBAR_DELETE');
		JToolbarHelper::cancel('packagetypes.cancel');
	}
	
	protected function getSortFields()
	{
		return array(
				'a.ordering' => JText::_('JGRID_HEADING_ORDERING'),
				'a.state' => JText::_('JSTATUS'),
				'a.title' => JText::_('JGLOBAL_TITLE'),
				'a.id' => JText::_('ID'),
		);
	}

}
?>