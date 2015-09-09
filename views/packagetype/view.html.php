<?php

/**
 * @package 	Bookpro
 * @author 		Ngo Van Quan
 * @link 		http://joombooking.com
 * @copyright 	Copyright (C) 2011 - 2012 Ngo Van Quan
 * @license 	GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 * @version 	$Id: view.html.php 22 2012-07-07 07:56:02Z quannv $
 **/
defined('_JEXEC') or die('Restricted access');

class BookProViewPackageType extends JViewLegacy
{
	protected $item;
	protected $form;
	
	public function display($tpl=null){
		$this->item = $this->get('Item');
		$this->form = $this->get('Form');
	
		$this->tour_id	= JFactory::getApplication()->getUserState('com_bookpro.packagetypes.filter.tour_id');
		debug($this->tour_id); die;
		
		if (count($errors = $this->get('Errors'))){
			JError::raiseError(500, implode("\n", $errors));
			return false;
		}
	
		$this->addToolbar();
		parent::display($tpl);
	}
    

	protected function addToolbar(){
		JFactory::getApplication()->input->set('hidemainmenu', true);
		JToolbarHelper::title ( $this->item->id?JText::_ ( 'COM_BOOKPRO_EDIT_PACKAGETYPE' ):JText::_ ( 'COM_BOOKPRO_NEW_PACKAGETYPE' ));
		JToolbarHelper::apply('packagetype.apply');
		JToolbarHelper::save('packagetype.save');
				
		if(empty($this->item->id)){
			JToolbarHelper::cancel('packagetype.cancel');
		}
		else{
			JToolbarHelper::cancel('packagetype.cancel', 'JTOOLBAR_CLOSE');
		}
		
	}
//     function _displayForm($tpl, $obj)
//     {
//         $document = &JFactory::getDocument();
//         /* @var $document JDocument */
        
//         $error = JRequest::getInt('error');
//         $data = JRequest::get('post');
//         if ($error) {
//             $obj->bind($data);
            
//         }
        
//         if (! $obj->id && ! $error) {
//             $obj->init();
//         }
//         JFilterOutput::objectHTMLSafe($obj);
//         //$document->setTitle($obj->title);
//         $params = JComponentHelper::getParams(OPTION);
//         /* @var $params JParameter */
//         $this->assignRef('obj', $obj);
//         $this->assignRef('params', $params);
//         parent::display($tpl);
//     }
 	

    
}

?>