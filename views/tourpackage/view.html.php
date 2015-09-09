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
AImporter::model('tour');
class BookProViewTourpackage extends JViewLegacy
{
	protected $form;
	protected $item;
	protected $state;

	public function display($tpl = null)
	{
		$this->form		= $this->get('Form');
		$this->item		= $this->get('Item');
		$this->state	= $this->get('State');
		$tour_id = JFactory::getApplication()->getUserState('com_bookpro.tourpackages.filter.tour_id');
		$model = new BookProModelTour();
		$tour = $model->getItem($tour_id);
		if($tour->id){
			AImporter::helper('tour');
			$this->packagetypes = TourHelper::getPackagetypeFilterByTourId($tour->id,'jform[packagetype_id]',$this->item->packagetype_id);
		}else{
			$this->packagetypes = $this->getPackageTypeBox($this->item->packagetype_id);
		}
		$this->tours		= $this->getTourBox($tour_id);
		$this->tourgroups 	= $this->getTourGroupBox($this->item->min_person,$tour_id);
		$this->addToolbar();
		parent::display($tpl);
	}
	protected function addToolbar()
	{
		//JRequest::setVar('hidemainmenu', true);
		JToolBarHelper::title($this->item->id?JText::_('COM_BOOKPRO_EDIT_OPTION'):JText::_('COM_BOOKPRO_NEW_OPTION'));
		JToolBarHelper::apply('tourpackage.apply');
		JToolBarHelper::save('tourpackage.save');
		JToolBarHelper::cancel('tourpackage.cancel');
	}

	function getTourBox($select, $field = 'jform[tour_id]', $autoSubmit = false){
		AImporter::model('tours');
		$model = new BookProModelTours();
		$lists = $model->getItems();
		return AHtml::getFilterSelect($field, JText::_('COM_BOOKPRO_SELECT_TOUR'), $lists, $select, $autoSubmit, '', 'id', 'title');
	}

	function getTourGroupBox($select,$tour_id){
		$model = new BookProModelTour();
		$tour = $model->getItem($tour_id);
		$group=explode(';',trim($tour->pax_group));
		$option=array();
		for ($i = 0; $i < count($group); $i++) {
			$option[]=JHTML::_('select.option',$group[$i] ,$group[$i]);
		}
		return JHtmlSelect::genericlist($option, 'jform[min_person]','','value','text',$select);
	}

	function getPackageTypeBox($select, $field = 'jform[packagetype_id]', $autoSubmit = false){
		AImporter::model('packagetypes');
		$model = new BookProModelPackageTypes();
		$state=$model->getState();
		$state->set('list.start',0);
		$state->set('list.limit', 0);
		$lists = $model->getItems();
		return AHtml::getFilterSelect($field, JText::_('COM_BOOKPRO_PACKAGETYPE_SELECT'), $lists, $select, $autoSubmit, '', 'id', 'title');
	}

}

?>