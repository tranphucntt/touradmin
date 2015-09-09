<?php

/**
 * @package 	Bookpro
 * @author 		Ngo Van Quan
 * @link 		http://joombooking.com
 * @copyright 	Copyright (C) 2011 - 2012 Ngo Van Quan
 * @license 	GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 * @version 	$Id: default.php 26 2012-07-08 16:07:54Z quannv $
 **/
defined ( '_JEXEC' ) or die ( 'Restricted access' );

/* @var $this BookingViewReservations */
$bar = JToolBar::getInstance('toolbar');
BookProHelper::setSubmenu ( 2 );

JToolBarHelper::title ( JText::_ ( 'COM_BOOKPRO_ROOMTYPE_MANAGER' ), 'user.png' );

$itemsCount = count($this->items);
$pagination = &$this->pagination;
$listOrder	= $this->escape($this->state->get('list.ordering'));
$listDirn	= $this->escape($this->state->get('list.direction'));

?>

<div class="span10" id="j-main-container">
	<form action="index.php?option=com_bookpro&view=roomtypes" method="post" name="adminForm" id="adminForm">

			<table class="table">
				<thead>
					<tr>
						
					<th width="1%" class="hidden-phone"><?php echo JHtml::_('grid.checkall'); ?>
					</th>
					<th width="1%" style="min-width: 55px" class="nowrap center">
							<?php echo JHtml::_('grid.sort', 'JSTATUS', 'state', $listDirn, $listOrder); ?>
					</th>
						<th class="title" width="30%">
				        <?php echo JHTML::_('grid.sort', JText::_('COM_BOOKPRO_ROOMTYPE_TITLE'), 'title', $listDirn, $listOrder); ?>
					</th>
						
						<th width="10%">
				        <?php echo JText::_('COM_BOOKPRO_ROOMTYPE_MAX_PERSON'); ?>
					</th>
						<th width="4%">
				        <?php echo JHTML::_('grid.sort', 'ID', 'id', $listDirn, $listOrder); ?>
					</th>

					</tr>
				</thead>
				<tfoot>
					<tr>
						<td colspan="10">
    				    <?php echo $pagination->getListFooter(); ?>
    				</td>
					</tr>
				</tfoot>
				<tbody>
				<?php if (! is_array($this->items) || ! $itemsCount) { ?>
					<tr>
						<td colspan="10"><?php echo JText::_('COM_BOOKPRO_NO_ITEM'); ?></td>
					</tr>
				<?php } else { ?>
				    <?php for ($i = 0; $i < $itemsCount; $i++) { ?>
				    
				    	<?php
						
						$subject = &$this->items [$i];
						$link = JRoute::_ ( ARoute::edit ( 'roomtype', $subject->id ) );
						?>
				    	<td class="checkboxCell"><?php echo JHTML::_('grid.checkedout', $subject, $i); ?></td>
				    		
			    		<td class="center">
							<?php echo JHtml::_('jgrid.published', $subject->state, $i, 'roomtypes.', true, 'cb', null, null); ?>
						</td>
						<td><a href="<?php echo 'index.php?option=com_bookpro&task=roomtype.edit&id='.$subject->id; ?>"><?php echo $subject->title; ?></a></td>
						<td><?php echo $subject->max_person ?></td>
						<td style="text-align: right; white-space: nowrap;"><?php echo number_format($subject->id, 0, '', ' '); ?></td>
					</tr>
				    <?php } ?>
				<?php } ?>
			</tbody>
			</table>
		
		<input type="hidden" name="option" value="<?php echo OPTION; ?>" /> 
		<input type="hidden" name="task" value="<?php echo JRequest::getCmd('task'); ?>" />
	
	<input type="hidden" name="reset" value="0" /> 
	 <input type="hidden" name="boxchecked" value="0" /> 
	 <input type="hidden" name="filter_order" value="<?php echo $listOrder; ?>" /> 
	 <input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn; ?>" /> 
	<?php echo JHTML::_('form.token'); ?>
</form>
</div>
