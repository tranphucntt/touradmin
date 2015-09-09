<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_media
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
AImporter::helper('bookpro');
JHtml::_('behavior.modal','a.jbmodal');
// Build the script.
$script = array();
$script[] = '	function jInsertFieldValue(value, id) {';
$script[] = '		var old_value = document.id(id).value;';
$script[] = '		if (old_value != value) {';
$script[] = '			var elem = document.id(id);';
$script[] = '			elem.value = value;';
$script[] = '			elem.fireEvent("change");';
$script[] = '			if (typeof(elem.onchange) === "function") {';
$script[] = '				elem.onchange();';
$script[] = '			}';
$script[] = '			jMediaRefreshPreview(id);';
$script[] = '		}';
$script[] = '	}';

$script[] = '	function jMediaRefreshPreview(id) {';
$script[] = '		var value = document.id(id).value;';
$script[] = '		var img = document.id(id + "_preview");';
$script[] = '		if (img) {';
$script[] = '			if (value) {';
$script[] = '				img.src = "' . JUri::root() . '" + value;';
$script[] = '				document.id(id + "_preview_empty").setStyle("display", "none");';
$script[] = '				document.id(id + "_preview_img").setStyle("display", "");';
$script[] = '			} else { ';
$script[] = '				img.src = ""';
$script[] = '				document.id(id + "_preview_empty").setStyle("display", "");';
$script[] = '				document.id(id + "_preview_img").setStyle("display", "none");';
$script[] = '			} ';
$script[] = '		} ';
$script[] = '	}';

$script[] = '	function jMediaRefreshPreviewTip(tip)';
$script[] = '	{';
$script[] = '		var img = tip.getElement("img.media-preview");';
$script[] = '		tip.getElement("div.tip").setStyle("max-width", "none");';
$script[] = '		var id = img.getProperty("id");';
$script[] = '		id = id.substring(0, id.length - "_preview".length);';
$script[] = '		jMediaRefreshPreview(id);';
$script[] = '		tip.setStyle("display", "block");';
$script[] = '	}';

// Add the script to the document head.
JFactory::getDocument()->addScriptDeclaration(implode("\n", $script));
if(isset($this->numberId)){
	$this->numberId='';
}



$directory='';
if($this->tour->id){
	$db = JFactory::getDBO();
	$query = $db->getQuery(true);
	$query->select('users.*');
	$query->from('#__users AS users');
	$query->leftJoin('#__bookpro_customer AS customer ON customer.user=users.id');
	$query->leftJoin('#__bookpro_tour AS tour ON tour.userid=customer.id');
	$query->where('tour.id='.$db->quote($this->tour->id));
	$sql = (string)$query;
	$db->setQuery($sql);
	$object = $db->loadObject();

	if($object){
		$directory	='supplier/'.$object->id;
		$supplier	='supplier';
		$userid  	=$object->id;
		jimport('joomla.filesystem.folder');
		$mainframe = JFactory::getApplication ();
		$ipath = JPATH_ROOT.DS.'images'.DS.$supplier;
		if(!JFolder::exists($ipath)){
			$newpath = JPath::clean($ipath);
			if (JFolder::create($newpath, 0775) === false)
			$mainframe->enqueueMessage(JText::sprintf('Unable create images directory', $newpath), 'error');

		}

		$ipath1 = JPATH_ROOT.DS.'images'.DS.$supplier.DS.$userid;
		if(!JFolder::exists($ipath1)){
			$newpath1 = JPath::clean($ipath1);
			if (JFolder::create($newpath1, 0775) === false)
			$mainframe->enqueueMessage(JText::sprintf('Unable create images directory', $newpath1), 'error');
		}
	}
}
?>
<div class="input-prepend input-append">
	<div class="media-preview add-on">
		<span title="" class="hasTipPreview"><i class="icon-eye"></i> </span>
	</div>
	<input type="text" class="input-small required hasTipImgpath" title=""
		readonly="readonly"
		value="<?php echo isset($this->item->path)?$this->item->path:null ?>"
		id="jform_path<?php echo isset($this->numberId)?$this->numberId:'';?>" name="jform[path]"
		aria-required="true" aria-invalid="false"> <a
		rel="{handler: 'iframe', size: {x: 800, y: 500}}"
		href="index.php?option=com_bookpro&view=media&tmpl=component&fieldid=jform_path&folderCheck=<?php echo $directory;?>&path=<?php echo isset($this->item->path)?$this->item->path:null ?>&numberId=<?php echo $this->numberId;?>"
		title="Select" class="jbmodal btn"> <?php echo JText::_('COM_BOOKPRO_MEDIA_SELECT');?>
	</a><a
		onclick=" jInsertFieldValue('', 'jform_path<?php echo isset($this->numberId)?$this->numberId:''; ?>'); return false; "
		href="#" title="" class="btn hasTooltip" data-original-title="Clear">
		<i class="icon-remove"></i> </a>
</div>
