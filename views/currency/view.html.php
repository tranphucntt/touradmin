<?php

/**
 * @package 	Bookpro
 * @author 		Ngo Van Quan
 * @link 		http://joombooking.com
 * @copyright 	Copyright (C) 2011 - 2012 Ngo Van Quan
 * @license 	GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 * @version 	$Id: view.html.php 26 2012-07-08 16:07:54Z quannv $
 **/

defined('_JEXEC') or die;
class BookproViewCurrency extends JViewLegacy {

	protected $form;
	protected $item;
	protected $state;

	/**
	 * (non-PHPdoc)
	 * @see JViewLegacy::display()
	 */
	public function display($tpl = null) {

		$input=JFactory::getApplication()->input;
		$this->form 	= $this->get('Form');
		$this->item 	= $this->get('Item');
		$this->state 	= $this->get('State');
		$this->addToolbar();
		

		parent::display($tpl);
	}

	/**
	 * Add the page title and toolbar.
	 *
	 * @since	1.6
	 */
	protected function addToolbar() {
		JRequest::setVar('hidemainmenu', true);
		JToolbarHelper::title ( $this->item->id?JText::_ ( 'COM_BOOKPRO_EDIT_CURRENCY' ):JText::_ ( 'COM_BOOKPRO_EDIT_CURRENCY' ));
		JToolBarHelper::apply('currency.apply');
		JToolBarHelper::save('currency.save');
		JToolBarHelper::cancel('currency.cancel');
	}
	
}