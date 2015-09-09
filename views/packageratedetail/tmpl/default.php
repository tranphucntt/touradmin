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
JToolBarHelper::save('packagerate.savedayrate');
?>
<script type="text/javascript">
	Joomla.submitbutton = function(task)
	{
			Joomla.submitform(task, document.getElementById('adminForm'));
	}
</script>
<h2><?php echo $this->object->stitle; ?>(<?php echo JFactory::getDate($this->date)->format('d-m-Y') ?>)</h2>


<form action="index.php" method="post" name="adminForm" id='adminForm'	class="form-validate">
<?php foreach ($this->rates as $rate){ ?>
	
	<input type="hidden" name="jform[id]" value="<?php echo $rate->id ?>" />
	
	<table style="width:300px">
				
				<tr>
				  <td><?php echo JText::_('COM_BOOKPRO_TOUR_ADULT_PRICE'); ?></td>
				  <td><input class="input-small required" type="text" placeholder="<?php echo JText::_('COM_BOOKPRO_ADULT'); ?> " name="jform[adult]" value="<?php echo $rate->adult?>" /></td>		
				 
				<tr>
				  <td><?php echo JText::_('COM_BOOKPRO_TOUR_CHILD_PRICE'); ?></td>
				  <td><input class="input-small required" type="text" name="jform[child]" placeholder="<?php echo JText::_('COM_BOOKPRO_CHILD'); ?>" value="<?php echo $rate->child ?>" /></td>		
				  
				</tr>
				<tr>
				  <td><?php echo JText::_('COM_BOOKPRO_TOUR_INFANT_PRICE') ?></td>
				  <td><input class="input-small required" type="text" name="jform[infant]" placeholder="<?php echo JText::_('COM_BOOKPRO_INFANT') ?>" id="infant" value="<?php echo $rate->infant ?>" /></td>		
				 
				</tr>
				<tr>
				  <td><?php echo JText::_('COM_BOOKPRO_TOUR_PROMO') ?></td>
				  <td><input class="input-small required" type="number" name="jform[promo]" placeholder="<?php echo JText::_('COM_BOOKPRO_PROMO') ?>" id="promo" value="<?php echo $rate->promo ?>" /></td>		
				</tr>
				
				<tr>
				  <td><?php echo JText::_('COM_BOOKPRO_TOUR_SINGLE_SUPPLEMENT') ?></td>
				  <td><input class="input-small required" type="text" name="jform[single_sup]" placeholder="<?php echo JText::_('COM_BOOKPRO_TOUR_SINGLE_SUPPLEMENT') ?>" id="single_sup" value="<?php echo $rate->single_sup ?>" /></td>		
				</tr>
											
				<input type="hidden" name="jform[pricetype]" value="<?php echo $rate->pricetype;?>" />
			</table>

<?php } ?>
<input type="hidden" name="task" value="" />
<input type="hidden" name="option" value="com_bookpro" />
<input type="hidden" name="jform[tour_id]" value="<?php echo $this->tour_id;?>" />
<input type="hidden" name="jform[date]" value="<?php echo JFactory::getDate($this->date)->format('d-m-Y');?>" />
<input type="hidden" name="jform[tourpackage_id]" value="<?php echo $this->tourpackage_id;?>" />

<?php echo JHtml::_('form.token'); ?>
</form>