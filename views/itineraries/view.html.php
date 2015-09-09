<?php

/**
 * @package 	Bookpro
 * @author 		Ngo Van Quan
 * @link 		http://joombooking.com
 * @copyright 	Copyright (C) 2011 - 2012 Ngo Van Quan
 * @license 	GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 * @version 	$Id: view.html.php 26 2012-07-08 16:07:54Z quannv $
 **/

defined ( '_JEXEC' ) or die ();
AImporter::helper('tour');
class BookProViewItineraries extends JViewLegacy {
	protected $items;
	protected $state;
	protected $pagination;
	//protected $lists;
	
	public function display($tpl = null) {
		$this->tour_id=JFactory::getApplication()->input->get('tour_id');
		$this->items = $this->get ( 'Items' );
		$this->state = $this->get('State');

		if($this->tour_id)
			$this->state->set('filter.tour_id',$this->tour_id);
		else 
			$this->tour_id=$this->state->get('filter.tour_id');
		
		
		$this->pagination = $this->get('Pagination');
		
		$this->tours_filter=TourHelper::getToursFilter('tour_id',$this->tour_id);
		
		if (count ( $errors = $this->get ( 'Errors' ) )) {
			JError::raiseError ( 500, implode ( "\n", $errors ) );
			return false;
		}
		$this->addToolbar ();
		parent::display ( $tpl );
	}
	protected function addToolbar() {
		//$canDo = BookProHelper::getActions();
		$bar = JToolBar::getInstance ( 'toolbar' );
		JToolbarHelper::title ( JText::_ ( 'COM_BOOPRO_MANAGER_ITINERARIES' ));
		JToolbarHelper::addNew ( 'itinerary.add' );
		JToolbarHelper::editList ( 'itinerary.edit' );
		JToolbarHelper::publish('itineraries.publish', 'JTOOLBAR_PUBLISH',true);
		JToolbarHelper::unpublish('itineraries.unpublish', 'JTOOLBAR_UNPUBLISH', true);
		JToolbarHelper::deleteList('','itineraries.delete');
		JToolbarHelper::cancel('itineraries.cancel');		
		//JToolBarHelper::back();
	}
	
	
	
	protected function getSortFields()
	{
		return array(
				'a.ordering' => JText::_('JGRID_HEADING_ORDERING'),
				'a.state' => JText::_('JSTATUS'),
				'a.title' => JText::_('JGLOBAL_TITLE'),
				'a.id' => JText::_('JGRID_HEADING_ID')
		);
	}
}