<?php


defined('_JEXEC') or die;

class BookproViewCountries extends JViewLegacy
{
	protected $items;
	protected $pagination;
	protected $state;

	/**
	 * (non-PHPdoc)
	 * @see JViewLegacy::display()
	 */
	public function display($tpl = null)
	{
		$this->items		= $this->get('Items');
		$this->pagination	= $this->get('Pagination');
		$this->state		= $this->get('State');
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
		JToolBarHelper::title(JText::_('COM_BOOKPRO_COUNTRY_MANAGER'), 'country');
		JToolbarHelper::addNew('country.add');
		JToolbarHelper::editList('country.edit');
		JToolbarHelper::divider();
		JToolbarHelper::publish('countries.publish', 'Publish', true);
		JToolbarHelper::unpublish('countries.unpublish', 'UnPublish', true);
		JToolbarHelper::divider();
		JToolbarHelper::deleteList('', 'countries.delete');
	}
}
