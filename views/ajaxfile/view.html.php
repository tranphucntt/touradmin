<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
// import Joomla view library
jimport('joomla.application.component.view');
AImporter::helper('bookpro', 'image', 'model','request', 'controller','file');

class BookProViewAjaxFile extends JViewLegacy
{
	// Overwriting JView display method
	function display($tpl = null)
	{
		$task = JRequest::getVar('task');

		if($task=='uploadfile'){
			$this->uploadimage();
		}

		if($task=='remove'){
			$this->remove();
		}

		parent::display($tpl);
	}
	function uploadimage()
	{

		$this->checkFoldersMd5();
		if (AFile::uploadMd5(JPath::clean(JPATH_ROOT .DS.'images' . DS . 'files' . DS . 'filesmd5'. DS), 'newFile', $uimage, $error)) {
			$table 	= JRequest::getVar('table');
			$id 	= JRequest::getVar('id');
			if($table && $id){
				AImporter::table($table);
				$order = JTable::getInstance($table, 'table');
				$order->load($id);
				$order->file=$uimage -> name;
				$order->store();
			}
			echo  $uimage -> name; die;
		}else{
			echo(JText::_('COM_BOOKPRO_SAVE_FAILED')); die;
		}
	}
	function remove()
	{
		$file = JRequest::getVar('file');
		if(JFile::delete(JPath::clean(JPATH_ROOT .DS.'images' . DS . 'files' . DS . 'filesmd5'. DS . $file)))
		{
			$table 	= JRequest::getVar('table');
			$id 	= JRequest::getVar('id');
			if($table && $id){
				AImporter::table($table);
				$order = JTable::getInstance($table, 'table');
				$order->load($id);
				$order->file='';
				$order->store();
			}
			echo JText::_('COM_BOOKPRO_SUCCESSFULLY_DELETED'); die;
		}else{
			echo JText::_('COM_BOOKPRO_DELETE_FAILED'); die;
		}
	}

	function checkFoldersMd5()
	{
		jimport('joomla.filesystem.folder');
		$mainframe = JFactory::getApplication ();
		$ipath = JPATH_ROOT.DS.'images';
		if(!JFolder::exists($ipath)){
			$newpath = JPath::clean($ipath);
			if (JFolder::create($newpath, 0775) === false)
			$mainframe->enqueueMessage(JText::sprintf('Unable create images directory', $newpath), 'error');

		}

		$ipath1 = JPATH_ROOT.DS.'images'.DS.'files'.DS.'filesmd5';
		if(!JFolder::exists($ipath1)){
			$newpath1 = JPath::clean($ipath1);
			if (JFolder::create($newpath1, 0775) === false)
			$mainframe->enqueueMessage(JText::sprintf('Unable create images directory', $newpath1), 'error');
		}
	}
}
