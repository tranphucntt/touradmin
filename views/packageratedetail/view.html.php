<?php
/**
 * @package 	Bookpro
 * @author 		Ngo Van Quan
 * @link 		http://joombooking.com
 * @copyright 	Copyright (C) 2011 - 2012 Ngo Van Quan
 * @license 	GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 * @version 	$Id: bookpro.php 80 2012-08-10 09:25:35Z quannv $
 **/

defined('_JEXEC') or die;
AImporter::model('packagerate');
AImporter::helper('tour');
class BookproViewPackageRateDetail extends JViewLegacy
{
	public function display($tpl = null)
	{
		$config = JComponentHelper::getParams('com_bookpro');
		$app 					= JFactory::getApplication();
		$input 					= $app->input;
		$this->tour_id 			= $input->get('tour_id');
		$this->tourpackage_id 	= $input->get('tourpackage_id',0);
		$this->date = $input->get('date',null);
		$model = new BookProModelPackageRate();
		$this->rates = $model->getRateTour($this->tourpackage_id, $this->date);
		$this->object=TourHelper::getTitleRateByTourIdAndPackageId($this->tour_id,$this->tourpackage_id);
		JToolBarHelper::title(JText::_('COM_BOOKPRO_MANAGER_OPTIONRATE_DETAIL'));
		parent::display($tpl);
	}
}