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
class BookProViewCustomerCharge extends JViewLegacy
{
    function display($tpl = null)
    {
    	AImporter::model('order');
    	$model = new BookProModelOrder();
    	$input = jfactory::getApplication()->input;
        $this->order_id = $input->getInt('order_id');
        $this->orderComplex = $model->getComplexItem($this->order_id); 
        $this->order = $this->orderComplex->order;
        $this->addToolbar();
        parent::display($tpl);
    }
    
    protected function addToolbar(){
    	JToolbarHelper::title(JText::_('COM_BOOKPRO_CUSTOMER_CHARGE_TITLE'));
    	JToolBarHelper::custom('order.chargecustomer', 'download', 'icon over', JText::_('COM_BOOKPRO_CUSTOMER_CHARGE'), false, false);
		JToolbarHelper::cancel('order.cancel');
    }
}