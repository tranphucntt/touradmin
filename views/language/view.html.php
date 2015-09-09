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
class BookProViewLanguage extends JViewLegacy {

	public function display($tpl = null) {
		$folder="language".DS."en-GB";
		$this->filename = JFactory::$application->input->get('filename');
		$this->type 	= JFactory::$application->input->get('type');
		$this->dev 	= JFactory::$application->input->getString('dev');
		if($this->type=="SITE"){
			$jpath 			= JPATH_SITE;
		}elseif ($this->type=="ADMINISTRATOR"){
			$jpath 			= JPATH_ADMINISTRATOR;
		}
		$this->filedata = JFile::read($jpath .DS.$folder .DS. $this->filename);
		
		parent::display ( $tpl );
	}
}