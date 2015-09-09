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

//JToolBarHelper::custom('delete','delete','','Delete','','',false);
JToolBarHelper::custom('emptylog','delete','','Empty Price History','','',false);
JToolBarHelper::custom('emptyrate','delete','','Empty Price','','',false);

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
			jQuery('#formvalidate input').each(function(){
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

	<div class="span3" id="formvalidate">
		<label><?php echo JText::_('COM_BOOKPRO_START_DATE_'); ?> </label>
                                  		
		<?php echo JHtml::calendar(JFactory::getDate()->format('Y-m-d'), 'jform[startdate]', 'startdate','%Y-%m-%d') ?>

		<label><?php echo JText::_('COM_BOOKPRO_END_DATE_'); ?> </label>
		<?php echo JHtml::calendar(JFactory::getDate()->add(new DateInterval('P60D'))->format('Y-m-d'), 'jform[enddate]', 'enddate','%Y-%m-%d') ?>

		<label><?php echo JText::_('COM_BOOKPRO_WEEK_DAY'); ?> </label>

		<?php echo $this->getDayWeek('weekday[]') ?>
		<hr />

		<?php 
			echo $this->loadTemplate('base'); ?>
		

	</div>

	
	<div class="form-horizontal span9">
	
	<h2><?php 
		
		echo $this->object->stitle; ?>
		
		</h2>
	
		<div class="row-fluid">
		<?php echo $this->loadTemplate('calendar') ?>
		</div>
		
		
		<table class="table">
			<thead>
				<tr>
					<th>#</th>	
					<th style="width:200px;"><?php echo JText::_("COM_BOOKPRO_DATE__END_DATE");?></th>
					<th><?php echo JText::_("COM_BOOKPRO_SUMMARY");?>
					</th>
					
				</tr>
			</thead>

			<?php 


			for ($i = 0; $i < $itemsCount; $i++)
			{
				$subject = &$this->items[$i];
				?>
			<tbody>
				<tr class="record" <?php if($i==0) echo 'style="color:blue;font-weight:bold;"' ?>>
					<td ><?php echo ($i+1); ?>
					<td><?php echo JFactory::getDate($subject->startdate)->format('d-m-Y').' '.JText::_('COM_BOOKPRO_TO').' '. JFactory::getDate($subject->enddate)->format('d-m-Y'); ?>
					</td>
					<td><?php 
							//echo substr("chao mung cac ban den website",0,9);  
					
					echo (strlen($subject->content)>100)? substr($subject->content,0,100).' '.substr($subject->content,100,strlen($subject->content)) : $subject->content;  ?></td>
					
				</tr>
			</tbody>
			<?php 
			}
			?>
		</table>

	</div>

	<input type="hidden" name="option" value="com_bookpro" /> 
	<input type="hidden" name="controller" value="packagerate" id="controller"/> 
	<input type="hidden" name="boxchecked" value="0" /> 
	<input type="hidden" name="task" value="" id="task"/> 
	<input type="hidden" name="jform[tourpackage_id]" value="<?php echo $this->tourpackage_id ?>" />
	<input type="hidden" name="tourpackage_id" value="<?php echo $this->tourpackage_id ?>" />
	<input type="hidden" name="jform[tour_id]" value="<?php echo $this->tour_id ?>" />
	<?php echo JHTML::_('form.token'); ?>
</form>

