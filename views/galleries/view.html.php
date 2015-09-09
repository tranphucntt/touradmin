<?php

/**
 * @package 	Bookpro
 * @author 		Ngo Van Quan
 * @link 		http://joombooking.com
 * @copyright 	Copyright (C) 2011 - 2012 Ngo Van Quan
 * @license 	GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 * @version 	$Id: view.html.php 26 2012-07-08 16:07:54Z quannv $
 * */
defined('_JEXEC') or die('Restricted access');
AImporter::helper('touradministrator');

class BookProViewGalleries extends JViewLegacy {

	var $lists;
	var $items;
	var $pagination;

	function display($tpl = null) {

		$this->state 		= $this->get('State');

		if($this->state->get('filter.type')=='HOTEL'){
			AImporter::model('room');
			$hotelModel	= new BookProModelHotel();
			$hotel		= $hotelModel->getItem($this->state->get('filter.obj_id'));
			$this->title='Hotel';
			$this->text = $hotel->title;
		}elseif($this->state->get('filter.type')=='ROOM'){
			AImporter::model('room');
			$roomModel		= new BookProModelRoom();
			$room			= $roomModel->getItem($this->state->get('filter.obj_id'));
			$this->title	=	JText::_('COM_BOOKPRO_ROOM_TYPE');
			$this->text 	= $room->title;
		}else{
			AImporter::model('tour');
			$tourModel		= new BookProModelTour();
			$tour			=  $tourModel->getItem($this->state->get('filter.obj_id'));
			$this->title	= JText::_('COM_BOOKPRO_TOUR');
			$this->text 	= $tour->title;
		}

		$this->items 		= $this->get('Items');
		$this->pagination 	= $this->get('Pagination');
		$this->addToolbar();

		parent::display($tpl);
	}

	protected function addToolbar() {
		JToolbarHelper::title(JText::_('COM_BOOKPRO_MANAGER_GALLERIES'));
		JToolbarHelper::addNew('gallery.add');
		JToolbarHelper::editList('gallery.edit');
		JToolbarHelper::divider();
		JToolbarHelper::publish('galleries.publish', 'Publish', true);
		JToolbarHelper::unpublish('galleries.unpublish', 'UnPublish', true);
		JToolbarHelper::divider();
		JToolbarHelper::deleteList('', 'galleries.delete');
		JToolbarHelper::cancel('galleries.cancel');
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

?>