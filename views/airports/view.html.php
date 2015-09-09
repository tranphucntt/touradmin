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

//import needed Joomla! libraries
jimport('joomla.application.component.view');
AImporter::model('countries');
require_once JPATH_COMPONENT.'/helpers/airport.php';
//import needed JoomLIB helpers
AImporter::helper('route','bookpro');

class BookProViewAirports extends JViewLegacy
{
    /**
     * Array containing browse table filters properties.
     * 
     * @var array
     */
    var $lists;
    
    /**
     * Array containig browse table subjects items to display.
     *  
     * @var array
     */
    var $items;
    
    /**
     * Standard Joomla! browse tables pagination object.
     * 
     * @var JPagination
     */
    var $pagination;
    
       
    /**
     * Sign if table is used to popup selecting customers.
     * 
     * @var boolean
     */
    var $selectable;
    
    /**
     * Standard Joomla! object to working with component parameters.
     * 
     * @var $params JParameter
     */
    var $params;

    /**
     * Prepare to display page.
     * 
     * @param string $tpl name of used template
     */
    function display($tpl = null)
    {
       $this->state			= $this->get('State');
		$this->items		= $this->get('Items');
		
		$this->pagination	= $this->get('Pagination');
		foreach ($this->items as &$item)
		{
			$this->ordering[$item->parent_id][] = $item->id;
		}
		$this->countries	= $this->getCountriesBox($this->state->get('filter.country_id'));
		       
        $this->addToolbar();
        
        parent::display($tpl);
    }
    protected function addToolbar()
    {
    	JToolBarHelper::title(JText::_('Destination Manager'), 'location');
    	JToolbarHelper::addNew('airport.add');
    	JToolbarHelper::editList('airport.edit');
    	JToolbarHelper::divider();
    	JToolbarHelper::publish('airports.publish', 'Publish', true);
    	JToolbarHelper::unpublish('airports.unpublish', 'UnPublish', true);
    	JToolbarHelper::divider();
    	JToolbarHelper::deleteList('', 'airports.delete');
    }
    
	function getCountriesBox($select){
		$db = JFactory::getDBO();
		$query = $db->getQuery(true);
		$query->select('`a`.*');
		$query->from('#__bookpro_country AS a');
		$query->where("a.state = 1");
		$sql = (string)$query;
		$db->setQuery($sql);
		$items =  $db->loadObjectList();
		return AHtml::getFilterSelect('filter.country_id', JText::_('COM_BOOKPRO_SELECT_COUNTRY'), $items, $select, true, '', 'id', 'country_name');
	}
}
?>