<?php

/**
 * @package 	Bookpro
 * @author 		Ngo Van Quan
 * @link 		http://joombooking.com
 * @copyright 	Copyright (C) 2011 - 2012 Ngo Van Quan
 * @license 	GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 * @version 	$Id: tours.php 21 2012-07-06 04:06:17Z quannv $
 **/

defined('_JEXEC') or die;
AImporter::helper('route');
AImporter::model('addons');

class BookproViewFields extends JViewLegacy
{
	protected $items;
	protected $pagination;
	protected $state;
	var $lists;

	/**
	 * (non-PHPdoc)
	 * @see JViewLegacy::display()
	 */
	public function display($tpl = null)
	{
		$this->items		= $this->get('Items');
		//var_dump(count($this->items)); die;
		
		$this->pagination	= $this->get('Pagination');
		$this->state		= $this->get('State');
		$this->addToolbar();
		parent::display($tpl);
	}

	/**
	 * Add the page title and toolbar.
	 *
	 * @since	1.6
	 */
	protected function addToolbar()
	{
		JToolbarHelper::title(JText::_('COM_BOOPRO_MANAGER_FIELDS'));
		JToolbarHelper::addNew('field.add');
		JToolbarHelper::editList('field.edit');
		JToolbarHelper::divider();
		JToolbarHelper::deleteList('', 'fields.delete');
	}
}
