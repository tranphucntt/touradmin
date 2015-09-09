<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_helloworld
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access to this file
defined('_JEXEC') or die;
AImporter::helper( 'bookpro','currency');
AImporter::model('airports','categories');

class BookproViewComments extends JViewLegacy
{
    	protected $items;

    	protected $pagination;
    
    	protected $state;
	function display($tpl = null)
	{
		// Get data from the model
		$this->items		= $this->get('Items'); 
		$this->pagination	= $this->get('Pagination');
		$this->state		= $this->get('State');
		$this->filterForm    = $this->get('FilterForm');
		$this->activeFilters = $this->get('ActiveFilters');
//debug($this->items); die;


		// Set the tool-bar and number of found items
		$this->addToolBar();
        
		parent::display($tpl);
	}

	/**
	 * Add the page title and toolbar.
	 *
	 * @return  void
	 *
	 * @since   1.6
	 */
	protected function addToolBar()
	{
		$title = JText::_('COM_BOOKPRO_MANAGER_COMMENTS');

		if ($this->pagination->total)
		{
			$title .= "<span style='font-size: 0.5em; vertical-align: middle;'>(" . $this->pagination->total . ")</span>";
		}
 	     JToolBarHelper::addNew('comment.add');
         JToolBarHelper::editList('comment.edit');
		JToolBarHelper::title($title, 'comment');
		JToolBarHelper::deleteList('', 'comments.delete');
        JToolbarHelper::publish('comments.publish', 'JTOOLBAR_PUBLISH', true);
		JToolbarHelper::unpublish('comments.unpublish', 'JTOOLBAR_UNPUBLISH', true);
	
	}
}
