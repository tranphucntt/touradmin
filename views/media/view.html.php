<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_media
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
/**
 * HTML View class for the Media component
 *
 * @since  1.0
 */
jimport('joomla.application.component.view');
AImporter::helper('image');

class BookProViewMedia extends JViewLegacy
{
	/**
	 * Execute and display a template script.
	 *
	 * @param   string  $tpl  The name of the template file to parse; automatically searches through the template paths.
	 *
	 * @return  mixed  A string if successful, otherwise a Error object.
	 *
	 * @since   1.0
	 */
	public function display($tpl = null)
	{
		$config = JComponentHelper::getParams('com_media');
		$lang	= JFactory::getLanguage();
		$return       = JFactory::getSession()->get('com_media.return_url');
		//debug($return);

		$this->type		= JFactory::getApplication()->input->get('type');
		$this->obj_id	= JFactory::getApplication()->input->get('obj_id');
		$path			= JFactory::getApplication()->input->get('path','', 'string');
		$this->folderlist 	= str_replace('images/', '', str_replace('/'.JFile::getName($path), '', $path));
		$this->numberId	= JFactory::getApplication ()->getUserStateFromRequest( 'gallery.numberId','numberId', null);

		$this->folderCheck	= JFactory::getApplication ()->getUserStateFromRequest( 'gallery.folderCheck', 'folderCheck', null );
		if(!$this->folderlist){
			$this->folderlist = JRequest::getString('folderlist')?JRequest::getString('folderlist'):$this->folderCheck;
		}
		$this->folder = JFactory::getApplication()->input->get('folder', '', 'path');

		if($this->folder){
			$this->folderlist = $this->folder;
		}

		if(JRequest::getString('dirname')){
			$newpath = JPath::clean(JPATH_ROOT . '\images'.DS . $this->folderlist . DS . JRequest::getString('dirname'));
			$mainframe = JFactory::getApplication();
			if(JFolder::exists($newpath)){
				$mainframe->enqueueMessage(JText::_('COM_BOOKPRO_MEDIA_DIRECTORY_ALREADY_EXISTS'), 'error');
			}elseif (JFolder::create($newpath, 0775) === false){
				$mainframe->enqueueMessage(JText::_('COM_BOOKPRO_MEDIA_UNABLE_CREATE_DIRECTORY'), 'error');
			}
		}

		// Include jQuery
		JHtml::_('jquery.framework');
		JHtml::_('script', 'media/popup-imagemanager.js', true, true);
		JHtml::_('stylesheet', 'media/popup-imagemanager.css', array(), true);

		if ($lang->isRTL())
		{
			JHtml::_('stylesheet', 'media/popup-imagemanager_rtl.css', array(), true);
		}

		/*
		 * Display form for FTP credentials?
		 * Don't set them here, as there are other functions called before this one if there is any file write operation
		 */
		$ftp = !JClientHelper::hasCredentials('ftp');

		$this->session = JFactory::getSession();
		$this->config = $config;
		$this->state = $this->get('state');
		$this->folderList = $this->getFolderList($this->folderCheck,null, $this->folderlist);
		$this->require_ftp = $ftp;

		parent::display($tpl);
	}

	public function getFolderList($folderCheck, $path=null, $selected=null)
	{
		$params = JComponentHelper::getParams('com_media');
		define('COM_MEDIA_BASE',    JPATH_ROOT . '/' . $params->get($path, 'images'));
		define('COM_MEDIA_BASEURL', JUri::root() . $params->get($path, 'images'));


		// Get some paths from the request
		if (empty($base))
		{
			$base = COM_MEDIA_BASE;
		}
		if($folderCheck){
			$base = $base.'/'.$folderCheck;
		}

		// Corrections for windows paths
		$base = str_replace(DIRECTORY_SEPARATOR, '/', $base);
		$com_media_base_uni = str_replace(DIRECTORY_SEPARATOR, '/', COM_MEDIA_BASE);

		// Get the list of folders
		jimport('joomla.filesystem.folder');
		$folders = JFolder::folders($base, '.', true, true);

		$document = JFactory::getDocument();
		$document->setTitle(JText::_('Insert Image'));

		// Build the array of select options for the folder list
		if($folderCheck){
			$options[] = JHtml::_('select.option', $folderCheck, "/".$folderCheck);
		}else{
			$options[] = JHtml::_('select.option', "", "/");
		}

		foreach ($folders as $folder)
		{
			$folder		= str_replace($com_media_base_uni, "", str_replace(DIRECTORY_SEPARATOR, '/', $folder));
			$value		= substr($folder, 1);
			$text		= str_replace(DIRECTORY_SEPARATOR, "/", $folder);
			$options[]	= JHtml::_('select.option', $value, $text);
		}

		// Sort the folder list array
		if (is_array($options))
		{
			sort($options);
		}

		// Get asset and author id (use integer filter)
		$input = JFactory::getApplication()->input;
		$asset = $input->get('asset', 0, 'integer');

		// For new items the asset is a string. JAccess always checks type first
		// so both string and integer are supported.
		if ($asset == 0)
		{
			$asset = htmlspecialchars(json_encode(trim($input->get('asset', 0, 'cmd'))));
		}

		$author = $input->get('author', 0, 'integer');

		// Create the drop-down folder select list
		$attribs = 'size="1" onchange="ImageManager.setFolder(this.options[this.selectedIndex].value, ' . $asset . ', ' . $author . ')" ';
		$list = JHtml::_('select.genericlist', $options, 'folderlist', $attribs, 'value', 'text', $selected);

		return $list;
	}

}

