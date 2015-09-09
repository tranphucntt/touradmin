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
?>
<fieldset>
	<legend><?php echo JText::_('COM_BOOKPRO_TOUR_BASE_PRICE') ?></legend>
	<input type="hidden" name="frate[base][pricetype]" value="BASE" />
	
	<table style="width:300px">
				<tr>
				  <td><?php echo JText::_('COM_BOOKPRO_TOUR_ADULT_PRICE'); ?></td>
				  <td><input class="input-small required" type="text" placeholder="<?php echo JText::_('COM_BOOKPRO_ADULT'); ?> " name="frate[base][adult]" id="adult" maxlength="255" value="" /></td>		
				  
				</tr>
				<tr>
				  <td><?php echo JText::_('COM_BOOKPRO_TOUR_CHILD_PRICE'); ?></td>
				  <td><input class="input-small required" type="text" name="frate[base][child]" placeholder="<?php echo JText::_('COM_BOOKPRO_CHILD'); ?>" id="child" size="60" maxlength="255" value="" /></td>		
				 
				</tr>
				<tr>
				  <td><?php echo JText::_('COM_BOOKPRO_TOUR_INFANT_PRICE') ?></td>
				  <td><input class="input-small required" type="text" name="frate[base][infant]" placeholder="<?php echo JText::_('COM_BOOKPRO_INFANT') ?>" id="infant" maxlength="255" value="" /></td>		
				  
				</tr>
				
				<tr>
				  <td><?php echo JText::_('COM_BOOKPRO_TOUR_PROMO') ?></td>
				  <td><input class="input-small required" type="number" name="frate[base][promo]" placeholder="<?php echo JText::_('COM_BOOKPRO_PROMO') ?>" id="promo" maxlength="255" value="" /></td>		
				 
				</tr>
		
				<tr>
				  <td><?php echo JText::_('COM_BOOKPRO_TOUR_PROMO') ?></td>
				  <td><input class="input-small required" type="text" name="frate[base][single_sup]" placeholder="<?php echo JText::_('COM_BOOKPRO_TOUR_SINGLE_SUPPLEMENT') ?>" id="single_sup" maxlength="255" value="" /></td>		 
				</tr>
							
					packageratebygrid		
			</table>
	
	
	
</fieldset>	