<?php

/**
 * @package 	Bookpro
 * @author 		Ngo Van Quan
 * @link 		http://joombooking.com
 * @copyright 	Copyright (C) 2011 - 2012 Ngo Van Quan
 * @license 	GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 * @version 	$Id$
 **/

defined('_JEXEC') or die('Restricted access');

jimport( 'joomla.application.component.view' );
AImporter::model('airports','customer','orders');
AImporter::helper('date');
class BookproViewAgentPage extends JViewLegacy
{
	function display($tpl = null)
	{
		$this->id = JFactory::$application->input->get('id');
		$model = new BookProModelCustomer();
		$this->customer = $model->getItem($this->id);

		$orderModel=new BookProModelOrders();
		$state = $orderModel->getState();
		$state->set('filter.user_id',(int)$this->customer->id);
		$state->set('filter.type','TOUR');

		$this->datefrom = JFactory::$application->input->get('datefrom');
		$this->dateto   = JFactory::$application->input->get('dateto');
		if(!$this->datefrom && !$this->dateto){
			$this->datefrom 	= date(DateHelper::getConvertDateFormat('P'),DateHelper::dateBeginMonth(time()));
			$this->dateto 		= date(DateHelper::getConvertDateFormat('P'),DateHelper::dateEndMonth(time()));
		}
		$state->set('filter.from_date', $this->datefrom);
		$state->set('filter.to_date', $this->dateto);

		$this->orders=$orderModel->getItems();
		parent::display($tpl);
	}
}

?>
