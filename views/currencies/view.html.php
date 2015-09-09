<?php

/**
 * @package 	Bookpro
 * @author 		Ngo Van Quan
 * @link 		http://joombooking.com
 * @copyright 	Copyright (C) 2011 - 2012 Ngo Van Quan
 * @license 	GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 * @version 	$Id: view.html.php 26 2012-07-08 16:07:54Z quannv $
 * */
defined('_JEXEC') or die('Restricted access');

class BookProViewCurrencies extends JViewLegacy {

    var $lists;
    var $items;
    var $pagination;

    function display($tpl = null) {

        $this->state 		= $this->get('State');
        $this->items 		= $this->get('Items');
        $this->pagination 	= $this->get('Pagination');
        $this->addToolbar();
        
      
        parent::display($tpl);
    }

    protected function addToolbar() {
        JToolbarHelper::title(JText::_('COM_BOOKPRO_MANAGER_CURRENCY'));
        JToolbarHelper::addNew('currency.add');
        JToolbarHelper::editList('currency.edit');
        JToolbarHelper::divider();
        JToolbarHelper::publish('currencies.publish', 'Publish', true);
        JToolbarHelper::unpublish('currencies.unpublish', 'UnPublish', true);
        JToolbarHelper::divider();
        JToolbarHelper::deleteList('', 'currencies.delete');
        JToolbarHelper::cancel('currencies.cancel');
    }
    
    protected function getSortFields()
    {
    	return array(
    			'a.ordering' => JText::_('JGRID_HEADING_ORDERING'),
    			'a.state' => JText::_('JSTATUS'),
    			'a.title' => JText::_('JGLOBAL_TITLE'),
    			'a.id' => JText::_('JGRID_HEADING_ID')
    	);
    }
    
    

}

?>