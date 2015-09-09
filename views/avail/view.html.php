<?php

/**
 * @package 	Bookpro
 * @author 		Ngo Van Quan
 * @link 		http://joombooking.com
 * @copyright 	Copyright (C) 2011 - 2012 Ngo Van Quan
 * @license 	GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 * @version 	$Id: view.html.php 26 2012-07-08 16:07:54Z quannv $
 **/
defined('_JEXEC') or die('Restricted access');

class BookProViewAvail extends JViewLegacy
{
	function display($tpl = null)
	{
		parent::display($tpl);
	}

	static function getDayWeek($name){
		AImporter::helper('date');
		$days=DateHelper::dayofweek();
		$daysweek=array();
		foreach ($days as $key => $value)
		{
			$object=new stdClass();
			$object->key=$key;
			$object->value=$value;
			$daysweek[]=$object;
		}
		$selected=array_keys($days);
		return AHtml::checkBoxList($daysweek,$name,'',$selected,'key','value');

	}
}

?>