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
AImporter::helper('route', 'bookpro', 'tour');
AImporter::model('tour');
class BookProViewPackageRates extends JViewLegacy
{
	/**
	 * Array containing browse table filters properties.
	 *
	 * @var array
	 */
	var $lists;

	var $items;

	function display($tpl = null)
	{
		$input					= JFactory::getApplication()->input;
		$document   			= JFactory::getDocument();
		$document->addScript(JUri::base().'components/com_bookpro/assets/js/pncalendar.js');
		$this->tourpackage_id 	= $input->get('tourpackage_id');
		$this->tour_id			= $input->get('tour_id');
		//var_dump($this->tour_id); die;
		$this->object=TourHelper::getTitleRateByTourIdAndPackageId($this->tour_id,$this->tourpackage_id);
		JToolbarHelper::title(JText::_('COM_BOOKPRO_MANAGER_PACKAGERATES'));
		parent::display($tpl);
			
	}
}

?>