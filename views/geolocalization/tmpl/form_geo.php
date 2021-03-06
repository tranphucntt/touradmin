<?php 
/**
 * @package 	Bookpro
 * @author 		Ngo Van Quan
 * @link 		http://joombooking.com
 * @copyright 	Copyright (C) 2011 - 2012 Ngo Van Quan
 * @license 	GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 * @version 	$Id: form_image.php 26 2012-07-08 16:07:54Z quannv $
 **/
defined('_JEXEC') or die('Restricted access');

$modallink= JURI::base().'index.php?option=com_bookpro&view=geolocalization&tmpl=component&layout=default&long='.$this->longitude."&lat=".$this->latitude.'&obj_id='.$this->obj->id;?>
<script type="text/javascript">
function setGeo(lng,lat){
	 document.getElementById('longitude').value=lng;
     document.getElementById('latitude').value=lat;
}
</script>

<input type="text" id="longitude" name ="longitude" readonly="readonly" value="<?php echo $this->escape($this->longitude) ?>" placeholder="<?php echo JText::_('COM_BOOKPRO_HOTEL_LONGITUDE'); ?>">
<input type="text" id="latitude" name ="latitude" readonly="readonly" value="<?php echo $this->escape($this->latitude) ?>" placeholder=" <?php echo JText::_('COM_BOOKPRO_HOTEL_LATITUDE');?>">
<a class="modal btn" href="<?php echo $modallink ?>" rel="{handler: 'iframe', size: {x: 600, y: 650}}"><?php echo JText::_("Get Location")?></a>
