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



class BookProViewCoupon extends JViewLegacy
{
   	
	protected $form;
	protected $item;
	protected $state;

	/**
	 * (non-PHPdoc)
	 * @see JViewLegacy::display()
	 */
	public function display($tpl = null)
	{
		$this->form		= $this->get('Form');
		$this->item		= $this->get('Item');
		$this->state	= $this->get('State');
		$this->addToolbar();
		parent::display($tpl);
	}
	protected function addToolbar()
	{
		JRequest::setVar('hidemainmenu', true);
		JToolBarHelper::title(JText::_('Edit Refund'), 'refund');
		JToolBarHelper::apply('coupon.apply');
		JToolBarHelper::save('coupon.save');
		JToolBarHelper::cancel('coupon.cancel');
	}
   
   
    
}

?>