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

AImporter::model('categories');
AImporter::helper('tour','touradministrator','image','currency','date');

class BookProViewTours extends JViewLegacy
{
   	public $items;
	public $model;
	protected $pagination;
	protected $state;
    /**
     * Prepare to display page.
     * 
     * @param string $tpl name of used template
     */
    function display($tpl = null)
    {
        $document = JFactory::getDocument();
        $this->items		= $this->get('Items');
        $this->pagination	= $this->get('Pagination');
        $this->state		= $this->get('State');
        $input=JFactory::getApplication()->input;
        
        $this->duration=TourHelper::getDurationBox($this->state->get('filter.days') ,'filter_days');
        $this->category=$this->getCategoryBox($this->state->get('filter.cat_id'));
        JToolBarHelper::title ( JText::_ ( 'COM_BOOKPRO_MANAGER_TOURS' ),'briefcase' );
        parent::display($tpl);
    }
	
	function getCategoryBox($select){
		$model = new BookProModelCategories();
		$state = $model->getState();
		$state->set('filter.type','TOUR');
		$items = $model->getItems();
		return AHtml::getFilterSelect('filter_cat_id', JText::_('COM_BOOKPRO_SELECT_CATEGORY'), $items, $select, true, '', 'id', 'title');
	}
  
   
}

?>