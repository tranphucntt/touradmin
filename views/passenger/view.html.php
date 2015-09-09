<?php
/**
 * @package 	Bookpro
 * @author 		Ngo Van Quan
 * @link 		http://joombooking.com
 * @copyright 	Copyright (C) 2011 - 2012 Ngo Van Quan
 * @license 	GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 * @version 	$Id: view.html.php 105 2012-08-30 13:20:09Z quannv $
 **/

defined('_JEXEC') or die('Restricted access');

AImporter::model("passenger",'countries');
//import needed JoomLIB helpers
AImporter::helper('bookpro');

class BookProViewPassenger extends JViewLegacy
{

	protected $form;
	protected $item;
	protected $state;
	function display($tpl = null)
	{
		$this->form		= $this->get('Form');
		$this->item		= $this->get('Item');
		$this->state	= $this->get('State');
		parent::display($tpl);
	}

	function _displayForm($tpl, $obj)
	{
		$document = &JFactory::getDocument();
		/* @var $document JDocument */

		$error = JRequest::getInt('error');
		$data = JRequest::get('post');
		if ($error) {
			$obj->bind($data);
		}
		if (! $obj->id && ! $error) {
			$obj->init();
		}
		JFilterOutput::objectHTMLSafe($obj);
		$params = JComponentHelper::getParams(OPTION);
		/* @var $params JParameter */
		$this->assignRef('countries', $this->getCountrySelect($obj->country_id,'country_id'));
		$this->assign('issue',$this->getCountrySelect($obj->issue_id,'issue_id'));
		$this->assignRef('cgroups', $this->getGroupselect($obj->group_id));
		$this->assignRef('obj', $obj);
		$this->assignRef('params', $params);
		JToolbarHelper::title ( $obj?JText::_ ( 'COM_BOOKPRO_EDIT_PASSENGER' ):JText::_ ( 'COM_BOOKPRO_NEW_PASSENGER' ));
		parent::display($tpl);
	}
	function getCountrySelect($select,$name)
	{
		$model = new BookProModelCountries();
		$lists = array('limit' => null , 'limitstart' => null );
		$model->init($lists);
		$fullList = $model->getData();
		return AHtml::getFilterSelect($name, 'Select Country', $fullList, $select, false, '', 'id', 'country_name');
	}

	function getGroupselect($selected,$name){

		$model = new BookProModelCGroups();
		$lists = array('state'=>1);
		$model->init($lists);
		$fullList = $model->getData();
		return AHtml::getFilterSelect('group_id','Select Group', $fullList, $selected,false,'','id','title');

	}
	 

}

?>