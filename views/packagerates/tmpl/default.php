<?php

/**
 * @package 	Bookpro
 * @author 		Ngo Van Quan
 * @link 		http://joombooking.com
 * @copyright 	Copyright (C) 2011 - 2012 Ngo Van Quan
 * @license 	GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 * @version 	$Id: default.php 26 2012-07-08 16:07:54Z quannv $
 **/
defined('_JEXEC') or die('Restricted access');
$bar = JToolBar::getInstance('toolbar');
JHtml::_('jquery.framework');
JHtml::_('behavior.modal');
AImporter::css('calendar');
BookProHelper::setSubmenu(1);
require_once JPATH_COMPONENT_ADMINISTRATOR.'/classes/calendar.php';

?>
<script type="text/javascript">

var ajaxurl = "<?php echo JUri::base().'index.php?option=com_bookpro&controller=tour&task=calendar&tour_id='.$this->tour_id.'&tourpackage_id='.$this->tourpackage_id; ?>";
var pn_appointments_calendar = null;
jQuery(function() {
    pn_appointments_calendar = new PN_CALENDAR();
    pn_appointments_calendar.init();
});

</script>
<script type="text/javascript">
function deleteRate(id,month,year){
	
	var ajaxurl = "<?php echo JUri::base().'index.php?option=com_bookpro&controller=tour&task=deleteRateDate&tour_id='.$this->tour_id.'&tourpackage_id='.$this->tourpackage_id; ?>";
	 var data = {
             action: "pn_get_month_cal",
             month: month,
             year: year,
             id:id
         };
         jQuery.post(ajaxurl, data, function(response) {
        	
             jQuery('#pn_calendar').html(response);
         });
}
</script>
<div class="span10" id="j-main-container">
<div class="lead">
<?php echo $this->object->stitle;?>
</div>

<form action="<?php echo JRoute::_('index.php?option=com_bookpro&view=packagerates&tourpackage_id='.$this->tourpackage_id);?>" method="post" name="adminForm" id="adminForm" class="adminForm">
	<?php 
	       $calendar = new PN_Calendar();
	       echo $calendar->draw();
	        
	 ?>
	 <input type="hidden" name="controller" value="packagerates" />
     <input type="hidden" name="task" value="delete" /> 
     <input type="hidden" name="tourpackage_id" value="<?php echo $this->tourpackage_id;?>" />
     <?php echo JHtml::_('form.token'); ?>
 </form>	
</div>
<script type="text/javascript">
jQuery(document).ready(function(){
	jQuery("#SubmintFormPackagerates").live('click',function(){
		var checked = false;
		jQuery(".checkboxCell").each(function(){
				if(jQuery(this).is(':checked'))
				{
					checked=true;
				}
			});
			if(checked){
				jQuery("#adminForm").submit();
			}else{
				alert('Please first make a selection from the list');
			}
	});

});		
</script>
