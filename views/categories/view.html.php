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

AImporter::helper('image');
AImporter::helper( 'bookpro','categoriesadministrator');
AImporter::model('categories');

class BookProViewCategories extends JViewLegacy
{
	var $items;
	var $pagination;

	function display($tpl = null)
	{
		$this->state		= $this->get('State');
		$this->items		= $this->get('Items');
		$this->pagination	= $this->get('Pagination');
		if($this->items){
			foreach ($this->items as &$item)
			{
				$this->ordering[$item->parent_id][] = $item->id;
			}
		}
		$this->addToolbar();
		$this->sidebar = JHtmlSidebar::render();

		parent::display($tpl);
	}
	protected function addToolbar()
	{
		JToolBarHelper::title(JText::_('Categories Manager'), 'folder');
		JToolbarHelper::addNew('category.add');
		JToolbarHelper::editList('category.edit');
		JToolbarHelper::divider();
		JToolbarHelper::publish('categories.publish', 'Publish', true);
		JToolbarHelper::unpublish('categories.unpublish', 'UnPublish', true);
		JToolbarHelper::divider();
		JToolbarHelper::deleteList('', 'categories.delete');
	}

}
?>