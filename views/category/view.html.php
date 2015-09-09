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


//import needed models


class BookProViewCategory extends JViewLegacy
{
   	
    function display($tpl = null)
    {
       	$this->form		= $this->get('Form');
		$this->item		= $this->get('Item');
		$this->state	= $this->get('State');
		$this->addToolbar();
		parent::display($tpl);
        
               
	    }

    /**
     * Prepare to display page.
     * 
     * @param string $tpl name of used template
     * @param TableCustomer $customer
     * @param JUser $user
     */
	    protected function addToolbar()
	    {
	    	JRequest::setVar('hidemainmenu', true);
	    	JToolbarHelper::title ( $this->item->id?JText::_ ( 'COM_BOOKPRO_EDIT_CATEGORY' ):JText::_ ( 'COM_BOOKPRO_NEW_CATEGORY' ));
	    	JToolBarHelper::apply('category.apply');
	    	JToolBarHelper::save('category.save');
	    	JToolBarHelper::cancel('category.cancel');
	    
	    
	    	JHtml::_('behavior.modal','a.jbmodal');
	    	JHtml::_('behavior.formvalidation');
	    }

    
}

?>