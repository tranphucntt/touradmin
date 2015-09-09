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
jimport('joomla.application.component.view');
JHtml::_('formbehavior.chosen', 'select');

class BookproViewpassengers  extends JViewLegacy {
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
		$this->items		= $this->get('Items');
		$this->pagination	= $this->get('Pagination');
		$this->state		= $this->get('State');
		$input				= JFactory::getApplication()->input;

		// Check for errors.
		if (count($errors = $this->get('Errors')))
		{
			JError::raiseError(500, implode("\n", $errors));
			return false;
		}

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
		JToolBarHelper::editList('passenger.edit');
		JToolbarHelper::deleteList('', 'passengers.delete', 'JTOOLBAR_TRASH');
		
		$toolbar = JToolbar::getInstance('toolbar');
		//$toolbar->appendButton( 'Link', 'print', JText::_('COM_BOOKPRO_PRINT'), JUri::base().'index.php?option=com_bookpro&view=passengers&tmpl=component&layout=report' );
		
		JToolBarHelper::title(JText::_('COM_BOOPRO_MANAGER_PASSENGERS'));
	}

}
?>
