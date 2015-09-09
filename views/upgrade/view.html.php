<?php
/**
 * @package 	Bookpro
 * @author 		Ngo Van Quan
 * @link 		http://joombooking.com
 * @copyright 	Copyright (C) 2011 - 2012 Ngo Van Quan
 * @license 	GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 * @version 	$Id: view.html.php 26 2012-07-08 16:07:54Z quannv $
 **/
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

class BookProViewUpgrade extends JViewLegacy
{
	function display($tpl = null)
	{
		$min_select_year = (int)JFactory::getDate()->format('Y')-1;
		$this->addToolbar();
		parent::display($tpl);
	}

	protected function addToolbar(){
		JToolBarHelper::title(JText::_('COM_BOOPRO_MANAGER_UPGRADE'));
	}
}