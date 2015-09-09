<?php

/**
 * @package 	Bookpro
 * @author 		Ngo Van Quan
 * @link 		http://joombooking.com
 * @copyright 	Copyright (C) 2011 - 2012 Ngo Van Quan
 * @license 	GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 * @version 	$Id: view.html.php 26 2012-07-08 16:07:54Z quannv $
 **/
defined ( '_JEXEC' ) or die ();

class BookproViewTour extends JViewLegacy {

	protected $state;
	protected $item;
	protected $form;

	/**
	 * Display the view
	 */
	public function display($tpl = null) {

		$config = JComponentHelper::getParams('com_bookpro');

		$this->state = $this->get ( 'State' );
		$this->item = $this->get ( 'Item' );
		$this->form = $this->get ( 'Form' );
		
		// Check for errors.
		if (count ( $errors = $this->get ( 'Errors' ) )) {
			JError::raiseError ( 500, implode ( "\n", $errors ) );
			return false;
		}
		$this->addToolbar ();

		BookProHelper::setTitleForm($this->item, "Tour");
		JToolbarHelper::title ( $this->item->id?JText::_ ( 'COM_BOOKPRO_EDIT_TOUR' ):JText::_ ( 'COM_BOOKPRO_NEW_TOUR' ));
		parent::display ( $tpl );
	}

	/**
	 * Add the page title and toolbar.
	 *
	 * @since 1.6
	 */
	protected function addToolbar() {
		JToolbarHelper::apply ( 'tour.apply' );
		JToolbarHelper::save ( 'tour.save' );
		JToolbarHelper::cancel ( 'tour.cancel' );
		JToolbarHelper::divider ();

	}
}