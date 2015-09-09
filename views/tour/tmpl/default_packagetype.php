<?php
/**
 * @package 	Bookpro
 * @author 		Ngo Van Quan
 * @link 		http://joombooking.com
 * @copyright 	Copyright (C) 2011 - 2012 Ngo Van Quan
 * @license 	GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 * @version 	$Id: default.php 81 2012-08-11 01:16:36Z quannv $
 **/

defined ( '_JEXEC' ) or die ( 'Restricted access' );

?>
<div class="row-fluid">
<div class="span6">

<h2><?php echo JText::_('COM_BOOKPRO_TOUR_PAX_GROUP')?></h2>
<?php 

$pax_group=explode(';', $this->item->pax_group);



if($this->item->id && count($pax_group)>=1) {

	for ($i = 0; $i < count($pax_group); $i++) {

		$stop=explode('-',$pax_group[$i]);

		

?>
<div class="container-fluid" id="busstop" style="margin-top: 10px;">
	<div class="form-inline">
	
		<input class="input-medium" type="number" name="min[]" value="<?php echo $stop[0] ?>"/> 
		<input class="input-medium" type="number" name="max[]" value="<?php echo $stop[1] ?>"/>
		 
		<a href="javascript:void(0);" title="<?php echo JText::_("JTOOLBAR_REMOVE")?>"><span class="icon-unpublish delete_item"></span></a>

	</div>

</div>


<?php 
	}	
}else {
?>



<?php 
}
?>

<div class="container-fluid paxgroupclone display_excursion_booking" id="busstop" style="margin-top: 10px;">
	<div class="form-inline">
		<input class="input-medium" type="number" name="min[]" placeholder="Min" /> 
		
		<input class="input-medium" type="number" name="max[]" placeholder="Max" /> 
	</div>

</div>
<hr />

<?php if(!JComponentHelper::getParams('com_bookpro')->get ( 'display_excursion_booking', 0 )){?>
	<div class="form-action pull-left">
		<button type="button" id="add_new_paxgroup" class="btn btn-success">
			<icon class="icon-new"></icon>
								<?php echo JText::_('COM_BOOKPRO_ADD')?>
		</button>
	</div>

<?php }else{?>
	<?php if($this->item->id){?>
		<script type="text/javascript">
			jQuery(document).ready(function(){
				jQuery(".display_excursion_booking").hide();
			});
		</script>	
	<?php }?>
<?php }?>

</div>
<!-- Packagetype -->
<div class="span6">
<h2><?php echo JText::_('COM_BOOKPRO_OPTION_TYPE')?></h2>
<?php 
if($this->item->id && count($this->item->packagetypes)>=1) {

	for ($i = 0; $i < count($this->item->packagetypes); $i++) {

		$stop=$this->item->packagetypes[$i];

		

?>
<div class="container-fluid" id="busstop" style="margin-top: 10px;">
	<div class="form-inline">
		<label><?php echo JText::_('COM_BOOKPRO_PACKAGETYPE_TITLE') ?></label>
		<input class="input-medium" type="text" name="packagetype[title][]" value="<?php echo $stop->title ?>"/> 
		
		<?php 
		echo BookProHelper::getStateList('packagetype[state][]', $stop->state);
		?>
		<input type="hidden" name="packagetype[id][]" value="<?php echo $stop->id ?>" />
		
		<a href="javascript:void(0);" title="<?php echo JText::_("JTOOLBAR_REMOVE")?>"><span class="icon-unpublish delete_item"></span></a>

	</div>

</div>


<?php 
	}	
}else {
?>



<?php 
}
?>

<div class="container-fluid busstopclone" id="busstop" style="margin-top: 10px;">
	<div class="form-inline">
		<label><?php echo JText::_('COM_BOOKPRO_PACKAGETYPE_TITLE') ?></label>			
		<input class="input-medium" type="text" name="packagetype[title][]" /> 
		<?php echo BookProHelper::getStateList('packagetype[state][]', null); ?>
		<input type="hidden" name="packagetype[id][]" value="0" />

	</div>

</div>
<hr />
<div class="form-action pull-left">
	<button type="button" id="add_new_stop" class="btn btn-success">
		<icon class="icon-new"></icon>
							<?php echo JText::_('COM_BOOKPRO_ADD')?>
					</button>
</div>

</div>

</div>



<script type="text/javascript">


jQuery(document).ready(function(){	
	jQuery('.delete_item').live('click',function(){
		jQuery(this).parent().parent().parent().remove()
		});
	
	jQuery('#add_item').hide();
});
				jQuery(document).ready(function($) {

										
					$("#add_new_stop").click(function(){
						
						$( ".busstopclone" ).eq(0).clone().insertAfter("div.busstopclone:last");
						
					});
					$("#add_new_paxgroup").click(function(){
						
						$( ".paxgroupclone" ).eq(0).clone().insertAfter("div.paxgroupclone:last");
						
					});
				
				});

				</script>