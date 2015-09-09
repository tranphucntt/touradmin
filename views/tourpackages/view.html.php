<?php

/**
 * @package 	Bookpro
 * @author 		Ngo Van Quan
 * @link 		http://joombooking.com
 * @copyright 	Copyright (C) 2011 - 2012 Ngo Van Quan
 * @license 	GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 * @version 	$Id: view.html.php 45 2012-07-12 10:42:37Z quannv $
 **/

defined('_JEXEC') or die('Restricted access');

AImporter::helper('route', 'bookpro', 'tour');
AImporter::model('tours','packagetypes','tour');


class BookProViewTourPackages extends JViewLegacy
{
	function display($tpl = null)
	{
		$input = JFactory::$application->input;
		
		$this->state		= $this->get('State');
		$this->items		= $this->get('Items');
		$this->pagination	= $this->get('Pagination');
		
		$this->selectable = JRequest::getCmd('task') == 'element';
		$this->tours      = TourHelper::getToursFilter('tour_id',$this->state->get('filter.tour_id'));

		$tourModel 		= new BookProModelTour();
		$this->tour		= $tourModel ->getItem($this->state->get('filter.tour_id'));
		if($this->tour->id){
			$this->packagetypes = TourHelper::getPackagetypeFilterByTourId($this->tour->id,'packagetype_id',$this->state->get('filter.packagetype_id'));
		}else{
			$this->packagetypes = $this->getPackageTypeBox($this->state->get('filter.packagetype_id'));
		}
		
		JToolBarHelper::title(JText::_('COM_BOOPRO_OPTIONS_MANAGER'));
		parent::display($tpl);
	}
	function getPackageTypeBox($select){
		$model = new BookProModelPackageTypes();
		$state=$model->getState();
		$state->set('list.start',0);
		$state->set('list.limit', 0);
		$lists = $model->getItems();
		return AHtml::getFilterSelect('packagetype_id',JText::_('Select option'), $lists, $select,true, '', 'id', 'title');
	}
}

?>