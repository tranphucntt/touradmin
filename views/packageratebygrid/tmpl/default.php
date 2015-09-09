<?php
/**
 * @package 	Bookpro
 * @author 		Ngo Van Quan
 * @link 		http://joombooking.com
 * @copyright 	Copyright (C) 2011 - 2012 Ngo Van Quan
 * @license 	GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 * @version 	$Id: bookpro.php 80 2012-08-10 09:25:35Z quannv $
 **/


defined('_JEXEC') or die('Restricted access');

JHtml::_('behavior.formvalidation');
JHtml::_('formbehavior.chosen', 'select');
$input = JFactory::getApplication()->input;
JToolBarHelper::save();
JToolBarHelper::apply();
JToolBarHelper::cancel();
$itemsCount = count($this->items);
$config=JComponentHelper::getParams('com_bookpro');

?>
<script type="text/javascript">
	Joomla.submitbutton = function(task)
	{
		var checked = true;
		var input 	= null; 
		if(task=="apply" || task=="save"){
			jQuery('.required').each(function(){
				if(!jQuery(this).val() && (jQuery(this).attr('id')!="promo")){
						jQuery(this).focus();
						input = jQuery(this).attr('placeholder');
						checked = false; 
						return false; 		
					}
				});
			}
		
		if(checked){
			Joomla.submitform(task, document.getElementById('adminForm'));
			}else{
				alert(input+' is required');
			}
	}
</script>
<form action="index.php" method="post" name="adminForm" id='adminForm'	class="form-validate">

	<div class="span2 formvalidate" id="formvalidate">
		<label><?php echo JText::_('COM_BOOKPRO_START_DATE_'); ?> </label>
		<?php echo JHtml::calendar(JFactory::getDate()->format('Y-m-d'), 'jform[startdate]', 'startdate','%Y-%m-%d','readonly="readonly" style="width:90px;"') ?>

		<label><?php echo JText::_('COM_BOOKPRO_END_DATE_'); ?> </label>
		<?php echo JHtml::calendar(JFactory::getDate()->add(new DateInterval('P60D'))->format('Y-m-d'), 'jform[enddate]', 'enddate','%Y-%m-%d','readonly="readonly" style="width:90px;"') ?>

		<label><?php echo JText::_('COM_BOOKPRO_WEEK_DAY'); ?> </label>

		<?php echo $this->getDayWeek('weekday[]') ?>
		<hr />
	</div>

	<div class="form-horizontal span10 formvalidate">
	<?php 
	$group_p=explode(';', trim($this->tourComplex->pax_group));
	?>
		<table class="table table-bordered">
			<thead>
				<tr class="success">
					<td><?php echo JText::_('COM_BOOKPRO_PACKAGE_OPTIONS')?>
					</td>
					<?php
						for ($i = 0; $i < count($group_p); $i++) {
							   echo "<td>".TourHelper::formatPaxGroup($group_p[$i])."</td>";
							  $colspan = $i; 
						}
					?>
				</tr>
			</thead>
			<?php
				$packages	= $this->tourComplex->packages;
				if($packages){
				foreach ($packages as $package){
			?>
				<tr>
					<td>
						<div class="form-inline">
	
							<label><strong> <?php 
								echo  $package->title ?>
							</strong> </label>
						</div>
					</td>
					<?php
						for ($j = 0; $j < count($group_p); $j++)
						{
							$tourpackage	= TourHelper::getTourpackageByTourIdAndPackagetypeIdAndPaxquantity($this->tourComplex->id,$package->id,$group_p[$j]);
					?>
						<td>
							<?php if($tourpackage){?>
							<div style="margin-top:2px;"><input class="required" type="text" 	name="frate[<?php echo $tourpackage->id?>][base][adult]" placeholder="<?php echo JText::_('COM_BOOKPRO_ADULT'); ?> "  id="adult" maxlength="255" value="" style="width:80%; max-width:200px;"/>
								<?php 
									if($tourpackage->group_price){
										echo JText::_('COM_BOOKPRO_TEXT_TOURPACKAGE_GROUP_PRICE');
									}
								?>
								
							</div>
							<div style="margin-top:2px;"><input class="" type="text" 	name="frate[<?php echo $tourpackage->id?>][base][child]" placeholder="<?php echo JText::_('COM_BOOKPRO_CHILD'); ?>" id="child"  maxlength="255" value="" style="width:80%; max-width:200px;"/></div>
							<div style="margin-top:2px;"><input class="" type="text" 	name="frate[<?php echo $tourpackage->id?>][base][infant]" placeholder="<?php echo JText::_('COM_BOOKPRO_INFANT') ?>" id="infant" maxlength="255" value="" style="width:80%; max-width:200px;"/></div>					
							<div style="margin-top:2px;"><input class="" type="number" 	name="frate[<?php echo $tourpackage->id?>][base][promo]" placeholder="<?php echo JText::_('COM_BOOKPRO_PROMO') ?>" id="promo" maxlength="255" value="" style="width:80%; max-width:200px;"/>
			
								<?php 
									if($tourpackage->group_price){
										echo JText::_('COM_BOOKPRO_TEXT_TOURPACKAGE_GROUP_PRICE');
									}
								?>
							</div>
							
							<div style="margin-top:2px;"><input class="" type="text" 	name="frate[<?php echo $tourpackage->id?>][base][single_sup]" placeholder="<?php echo JText::_('COM_BOOKPRO_TOUR_SINGLE_SUPPLEMENT') ?>" id="single_sup" maxlength="255" value="" style="width:80%; max-width:200px;"/>
							
							<input type="hidden" name="frate[<?php echo $tourpackage->id?>][base][pricetype]" value="BASE" />
							<?php }else{ echo 'N/A'; }?>
						</td>
					<?php 		
						}
					?>
				</tr>
			<?php
			}
		  }
		?>
	</table>
	
	<input type="hidden" name="option" value="com_bookpro" /> 
	<input type="hidden" name="controller" value="packagerate" /> 
	<input type="hidden" name="boxchecked" value="0" /> 
	<input type="hidden" name="task" value="" />
	<input type="hidden" name="multi" value="true"/> 
	<input type="hidden" name="jform[tourpackage_id]" value="<?php echo $this->tourpackage_id ?>" />
	<input type="hidden" name="jform[tour_id]" value="<?php echo $this->tour_id ?>" />
	<?php echo JHTML::_('form.token'); ?>	
	</div>	
</form>	