<?php 
/**
 * @package 	Bookpro
 * @author 		Ngo Van Quan
 * @link 		http://joombooking.com
 * @copyright 	Copyright (C) 2011 - 2012 Ngo Van Quan
 * @license 	GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 * @version 	$Id$
 **/

defined('_JEXEC') or die('Restricted access');
JHtml::_('behavior.formvalidation');
JHtml::_('formbehavior.chosen', 'select');
$input = JFactory::getApplication()->input;
BookProHelper::setSubmenu(1);
JToolBarHelper::title(JText::_('COM_BOOKPRO_LIST_ORDERS_FOR_AGENT'));	

?>
<div class="span10" id="j-main-container">
	<fieldset>
		<div style="float:right;">
			<lable>
				<strong>
					<?php echo JText::_('COM_BOOKPRO_FROM')?>
				</strong>	
			</lable>		
			 <?php echo  JHtml::calendar( $this->datefrom, 'datefrom', 'datefrom', DateHelper::getConvertDateFormat('M'), 'class="input-small"'); ?>
			 <lable>
			 	<strong>
					<?php echo JText::_('COM_BOOKPRO_TO')?>
				</strong>
			</lable>	
			<?php echo  JHtml::calendar( $this->dateto, 'dateto', 'dateto', DateHelper::getConvertDateFormat('M'), 'class="input-small"'); ?>
			<div class="input-append">
				<input type="button" class="btn btn-primary searchagent" value="<?php echo JText::_('COM_BOOKPRO_THIS_MONTH');?>" id="month" name="month">
				<input type="button" class="btn btn-primary searchagent" value="<?php echo JText::_('COM_BOOKPRO_THIS_WEEK');?>" id="week" name="week">
				<input type="button" class="btn btn-primary searchagent" value="<?php echo JText::_('COM_BOOKPRO_SEARCH');?>" id="date" name="date">
			</div>	
		</div>
			
			<input type="hidden" name="monthfrom" id="monthfrom" value="<?php echo date(DateHelper::getConvertDateFormat('P'),DateHelper::dateBeginMonth(time()))?>">
			<input type="hidden" name="monthto" id="monthto" value="<?php echo date(DateHelper::getConvertDateFormat('P'),DateHelper::dateEndMonth(time()))?>">
			
			<input type="hidden" name="weeksfrom" id="weekfrom" value="<?php echo date(DateHelper::getConvertDateFormat('P'),DateHelper::dateBeginWeek(time()))?>">
			<input type="hidden" name="weekto" id="weekto" value="<?php echo date(DateHelper::getConvertDateFormat('P'),DateHelper::dateEndWeek(time()))?>">					
		
		
	</fieldset>
	
	
<fieldset>
	<legend>
		<?php echo JText::_('COM_BOOKPRO_ORDER')?>
	</legend>
		<?php 
		$objectComplex = new JObject();
		$objectComplex->orders 	 = $this->orders;
		$objectComplex->customer = $this->customer;
			$layout = new JLayoutFile('reportorders', $basePath = JPATH_ROOT .'/components/com_bookpro/layouts');
			$html = $layout->render($objectComplex);
			echo $html;
		?>
	
</fieldset>
<script type="text/javascript">
jQuery.noConflict();
jQuery(document).ready(function(){
	jQuery(".searchagent").on('click',function(){
			var hreft='<?php echo JUri::reset().'index.php?option=com_bookpro&view=agentpage&id='.$this->id; ?>';
			var hrefh='';
			switch(jQuery(this).attr('name'))
			{
				case 'date':  hrefh = '&datefrom='+jQuery('#datefrom').val()+'&dateto='+jQuery('#dateto').val() ; break;
				case 'month': hrefh = '&datefrom='+jQuery('#monthfrom').val()+'&dateto='+jQuery('#monthto').val() ; break;
				case 'week':  hrefh = '&datefrom='+jQuery('#weekfrom').val()+'&dateto='+jQuery('#weekto').val() ; break;
			}
			window.location.href = hreft+hrefh;
		});
});

</script>
</div>