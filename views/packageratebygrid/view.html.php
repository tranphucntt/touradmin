<?php
/**
 * @package 	Bookpro
 * @author 		Ngo Van Quan
 * @link 		http://joombooking.com
 * @copyright 	Copyright (C) 2011 - 2012 Ngo Van Quan
 * @license 	GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 * @version 	$Id: bookpro.php 80 2012-08-10 09:25:35Z quannv $
 **/

defined('_JEXEC') or die('Restricted access');
AImporter::model('packageratelogs','tour');
AImporter::helper('tour','currency','date');
class BookProViewPackageRateByGrid extends JViewLegacy
{
	protected $items;

	protected $pagination;

	protected $state;

	function display($tpl = null)
	{
		$config = JComponentHelper::getParams('com_bookpro');
				 
		$input=JFactory::getApplication()->input;
		$model=JModelLegacy::getInstance('Packageratelogs','BookproModel');
		$this->setModel($model,true);
		
		$this->tourpackage_id = $input->get('tourpackage_id');
		$this->state		= $model->getState();
		$this->state->set('filter.tourpackage_id',$this->tourpackage_id);
		$this->items		= $this->get('Items','Packageratelogs');
		$this->pagination	= $this->get('Pagination');
		
		// Check for errors.
		if (count($errors = $this->get('Errors')))
		{
			JError::raiseError(500, implode("\n", $errors));
			return false;
		}
		$this->tour_id = $input->get('tour_id');
		
		$this->object=TourHelper::getTitleRateByTourIdAndPackageId($this->tour_id,$this->tourpackage_id);
		JToolBarHelper::title(JText::_('COM_BOOKPRO_MANAGER_OPTION_RATE'));
		
		
		$this->date = $input->get('date');
		$model 		= new BookProModelTour();
		$this->tourComplex	= $model->getComplexItem($this->tour_id);
		
		parent::display($tpl);
		 
	}

	static function getDayWeek($name){
		AImporter::helper('date');
		$days=DateHelper::dayofweek();
		$daysweek=array();
		foreach ($days as $key => $value)
		{
			$object=new stdClass();
			$object->key=$key;
			$object->value=$value;
			$daysweek[]=$object;
		}
		$selected=array_keys($days);
		return AHtml::bootrapCheckBoxList($daysweek,$name,'',$selected,'key','value');

	}



}

?>


