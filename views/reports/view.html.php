<?php
/**
 * @version		$Id:passenger.php 1 2014-03-15 18:20:26Z Quan $
 * @package		Bookpro1
 * @subpackage 	Views
 * @copyright	Copyright (C) 2014, Ngo Van Quan. All rights reserved.
 * @license #http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 */

// no direct access
defined('_JEXEC') or die('Restricted access');
AImporter::helper('tour');
AImporter::model('packagetypes','tour', 'avail');
jimport('joomla.application.component.view');
JHtml::_('formbehavior.chosen', 'select');

class BookproViewReports  extends JViewLegacy {
	public $items;
	public $model;
	protected $pagination;
	protected $state;

	/**
	 *  Displays the list view
	 * @param string $tpl
	 */
	public function display($tpl = null)
	{
		//die;
		$model=JModelLegacy::getInstance('passengers','BookproModel');
		$this->setModel($model,true);

		
		$this->state		= $this->get('State');
		if(!$this->state->get('filter.depart_date')){
			$this->state->set('filter.depart_date', JFactory::getDate()->format('Y-m-d'));	
		}
		
		$this->items		= $this->get('Items');
		$this->pagination	= $this->get('Pagination');
		
		$input				= JFactory::getApplication()->input;
		$this->packagetypes = null;

		if($this->state->get('filter.tour_id')){
			$packagetypesModel = new BookProModelPackagetypes();
			$state = $packagetypesModel->getState();
			$state->set('filter.tour_id', $this->state->get('filter.tour_id'));
			$this->packagetypes = $packagetypesModel->getItems();

			$tourModel = new BookProModelTour();
			$this->tour = $tourModel->getItem($this->state->get('filter.tour_id'));
		}

		// Check for errors.
		if (count($errors = $this->get('Errors')))
		{
			JError::raiseError(500, implode("\n", $errors));
			return false;
		}
		$this->orderstatus=$this->getOrderStatusSelect($this->state->get('filter.order_status'));

		$this->addToolbar();
		parent::display($tpl);
	}
	/**
	 * Add the page title and toolbar.
	 *
	 * @return  void
	 */
	protected function addToolbar()
	{
		$toolbar = JToolbar::getInstance('toolbar');
		//$toolbar->appendButton( 'Link', 'print', JText::_('COM_BOOKPRO_PRINT'), JUri::base().'index.php?option=com_bookpro&view=passengers&tmpl=component&layout=report' );
		JToolBarHelper::title(JText::_('COM_BOOKPRO_REPORTS'),'chart');
	}
	function getOrderStatusSelect($select){
		OrderStatus::init();
		return AHtml::getFilterSelect('filter_order_status', JText::_('COM_BOOKPRO_SELECT_STATUS'), OrderStatus::$map, $select, true, 'class="input input-medium"', 'value', 'text');
	}
}
?>
