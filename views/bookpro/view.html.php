<?php
/**
 * @package 	Bookpro
 * @author 		Ngo Van Quan
 * @link 		http://joombooking.com
 * @copyright 	Copyright (C) 2011 - 2012 Ngo Van Quan
 * @license 	GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 * @version 	$Id: view.html.php 26 2012-07-08 16:07:54Z quannv $
 **/
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
AImporter::helper('bookpro','adminui','currency','paystatus','chart','date');
AImporter::model('orders');



class BookProViewBookPro extends JViewLegacy
{
	
	public $items;
	public $model;
	protected $pagination;
	protected $state;
	
	function display($tpl = null)
	{
		//$this->setModel($this->getModel('Orders'),true);
		$model=new BookProModelOrders();
		$state = $model->getState();
		$state->set('list.start',0);
		$state->set('list.limit',10);		
		$this->items		= $model->getItems();
        $this->pagination	= $model->getPagination();
        $this->state		= $model->getState();
		parent::display($tpl);
	}
	
}