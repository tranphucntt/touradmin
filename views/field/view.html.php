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
jimport('joomla.application.component.view');
//import needed models
AImporter::model('categories');
AImporter::helper('tour');
class BookproViewField extends JViewLegacy
{
	protected $form;
	protected $item;
	protected $state;

	/**
	 * (non-PHPdoc)
	 * @see JViewLegacy::display()
	 */
	public function display($tpl = null)
	{
		$this->form		= $this->get('Form');
		$this->item		= $this->get('Item');
		$this->state	= $this->get('State');
		$this->categories = $this->getCategoryBox($this->item->plan_id);
		$this->fieldtype = $this->getFieldtypeBox($this->item->fieldtype);
		$this->datatype_validation = $this->getDatatypevalidationBox($this->item->datatype_validation);

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
		JRequest::setVar('hidemainmenu', true);
		JToolbarHelper::title ( $this->item->id?JText::_ ( 'COM_BOOKPRO_EDIT_FIELD' ):JText::_ ( 'COM_BOOKPRO_NEW_FIELD' ));
		JToolBarHelper::apply('field.apply');
		JToolBarHelper::save('field.save');
		JToolBarHelper::cancel('field.cancel');
	}

	function getCategoryBox($select=null){
		$model = new BookProModelCategories();
		$state = $model->getState();
		$state->set('filter.type','TOUR');
		$items = $model->getItems();
		$options[] = JHtml::_('select.option', -1, JText::_('COM_BOOKPRO_ALL_CATEGORY'));
			
		if($items){
			foreach ($items as $key => $category){
				$options[] = JHtml::_('select.option', $category->id, $category->title);
			}
		}


		//return AHtml::getFilterSelect('jform[plan_id]', JText::_('COM_BOOKPRO_FIELD_SELECT_TOUR_CATEGORY'), $items, $select, false, 'size="10" class="required"', 'id', 'title');
		return JHtml::_('select.genericlist', $options, 'jform[plan_id]', ' class="inputbox" id="plan_id"', 'value', 'text', $select);
	}
	function getFieldtypeBox($select=null){
		$fieldTypes = array(
			'Text',
			'Textarea',
			'List',
			'Checkboxes',
			'Radio',
			'Date',
			'File'
			);
			$options = array();
			//$options[] = JHtml::_('select.option', -1, JText::_('COM_BOOKPRO_NONE'));
			foreach ($fieldTypes as $key => $fieldType)
			{
				$options[] = JHtml::_('select.option', $fieldType, $fieldType);
			}
			return JHtml::_('select.genericlist', $options, 'jform[fieldtype]', ' class="inputbox" ', 'value', 'text', $select);
	}

	function getDatatypevalidationBox($select=null){
		$options = array();
		//$options[] = JHtml::_('select.option', 0, JText::_('COM_BOOKPRO_NONE'));
		$options[] = JHtml::_('select.option', 1, JText::_('Integer Number'));
		$options[] = JHtml::_('select.option', 2, JText::_('Number'));
		$options[] = JHtml::_('select.option', 3, JText::_('Email'));
		$options[] = JHtml::_('select.option', 4, JText::_('Url'));
		$options[] = JHtml::_('select.option', 5, JText::_('Phone'));
		$options[] = JHtml::_('select.option', 6, JText::_('Past Date'));
		$options[] = JHtml::_('select.option', 7, JText::_('Ip'));
		$options[] = JHtml::_('select.option', 8, JText::_('Min size'));
		$options[] = JHtml::_('select.option', 9, JText::_('Max size'));
		$options[] = JHtml::_('select.option', 10, JText::_('Min integer'));
		$options[] = JHtml::_('select.option', 11, JText::_('Max integer'));

		return JHtml::_('select.genericlist', $options, 'jform[datatype_validation]', ' class="inputbox" ', 'value', 'text', $select);
	}
}