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
class BookProViewItinerary extends JViewLegacy {
	protected $item;
	protected $form;

	public function display($tpl = null) {

		$this->tour_id	= JFactory::$application->input->get('tour_id');
		if(!$this->tour_id){
			$this->tour_id	= JFactory::getApplication()->getUserState('com_bookpro.itineraries.filter.tour_id');
		}else{
			JFactory::getApplication()->setUserState('com_bookpro.itineraries.filter.tour_id',$this->tour_id);
		}

		$this->item = $this->get ( 'Item' );
		$this->form = $this->get ( 'Form' );
		
		 
		if (count ( $errors = $this->get ( 'Errors' ) )) {
			JError::raiseError ( 500, implode ( "\n", $errors ) );
			return false;
		}
		$this->addToolbar ();
		parent::display ( $tpl );
	}

	protected function addToolbar() {
		JFactory::getApplication ()->input->set ( 'hidemainmenu', true );
		JToolbarHelper::title ( $this->item->id?JText::_ ( 'COM_BOOKPRO_EDIT_ITINERARY' ):JText::_ ( 'COM_BOOKPRO_NEW_ITINERARY' ));
		JToolbarHelper::save ( 'itinerary.save' );
		JToolBarHelper::apply('itinerary.apply');
		if (empty ( $this->item->id )) {
			JToolbarHelper::cancel ( 'itinerary.cancel' );
		} else {
			JToolbarHelper::cancel ( 'itinerary.cancel', 'JTOOLBAR_CLOSE' );
		}
	}
	
}