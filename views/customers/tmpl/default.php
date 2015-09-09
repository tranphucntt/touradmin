<?php
/**
 * @package 	Bookpro
 * @author 		Ngo Van Quan
 * @link 		http://joombooking.com
 * @copyright 	Copyright (C) 2011 - 2012 Ngo Van Quan
 * @license 	GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 * @version 	$Id: default.php 63 2012-07-29 10:43:08Z quannv $
 **/

defined('_JEXEC') or die('Restricted access');

JHtml::_('bootstrap.tooltip');
JHtml::_('behavior.multiselect');
JHtml::_('formbehavior.chosen', 'select');
	
$listOrder  = $this->escape($this->state->get('list.ordering'));
$listDirn   = $this->escape($this->state->get('list.direction'));
$loggeduser = JFactory::getUser();
$sortFields = $this->getSortFields();

$saveOrder	= $listOrder == 'a.ordering';
if ($saveOrder)
{
	$saveOrderingUrl = 'index.php?option=com_bookpro&controller=customers&task=saveOrderAjax&tmpl=component';
	JHtml::_('sortablelist.sortable', 'weblinkList', 'adminForm', strtolower($listDirn), $saveOrderingUrl);
}

$itemsCount = count($this->items);

BookProHelper::setSubmenu(12);
?>

<script type="text/javascript">
	Joomla.orderTable = function()
	{
		table = document.getElementById("sortTable");
		direction = document.getElementById("directionTable");
		order = table.options[table.selectedIndex].value;
		if (order != '<?php echo $listOrder; ?>')
		{
			dirn = 'asc';
		}
		else
		{
			dirn = direction.options[direction.selectedIndex].value;
		}
		Joomla.tableOrdering(order, dirn, '');
	}
</script>

<div class="span10" id="j-main-container">
<form action="<?php echo JRoute::_('index.php?option=com_bookpro&view=customers');?>" method="post" name="adminForm" id="adminForm">
	
      <fieldset id="filter-bar">
			<div class="filter-search fltlft">
				<div class="btn-group pull-left hidden-phone fltlft form-inline">					
					<input type="text" name="filter_search" id="filter_search" class="" onchange="this.form.submit();" value="<?php echo $this->escape($this->state->get('filter.search')); ?>" placeholder="<?php echo JText::_('COM_BOOKPRO_SEARCH')?>"/>
                   <?php echo $this->customergroup ?>
				</div>
				<div class="btn-group pull-left hidden-phone fltlft">
					<button onclick="this.form.submit();" class="btn">
						<i class="icon-search"></i>
					</button>
					<button type="button" class="btn hasTooltip" title="<?php echo JHtml::tooltipText('JSEARCH_FILTER_CLEAR'); ?>" 
						onclick="document.id('filter_search').value='';
								 this.form.submit();
						">
						<i class="icon-remove"></i>
					</button>
				</div>
				
			</div>
			<div class="btn-group pull-right hidden-phone">
					<label for="limit" class="element-invisible"><?php echo JText::_('JFIELD_PLG_SEARCH_SEARCHLIMIT_DESC');?></label>
					<?php echo $this->pagination->getLimitBox(); ?>
			</div>
		</fieldset>
		<table class="adminlist table-striped table" id="weblinkList">
			<thead>
				<tr>
					
					<th width="1%">
						<input type="checkbox" class="inputCheckbox" name="toggle" value="" onclick="Joomla.checkAll(this);" />
					</th>
					<th width="1%" style="min-width: 55px" class="nowrap center">
							<?php echo JHtml::_('grid.sort', 'JSTATUS', 'state', $listDirn, $listOrder); ?>
					</th>
					<th class="title" width="10%">
				        <?php echo JHTML::_('grid.sort',JText::_('COM_BOOKPRO_CUSTOMER_NAME'), 'firstname', $listDirn, $listOrder); ?>
					</th>
					<th class="title" width="10%">
				        <?php echo JHTML::_('grid.sort',JText::_('COM_BOOKPRO_CUSTOMER_USERNAME'), 'username', $listDirn, $listOrder); ?>
					</th>
					
					<th width="4%"> <?php echo JHTML::_('grid.sort',JText::_('COM_BOOKPRO_CUSTOMER_EMAIL'), 'email', $listDirn, $listOrder); ?></th>
					<th width="8%"><?php echo JText::_('COM_BOOKPRO_CUSTOMER_PHONE'); ?></th>
					<th width="10%">
				        <?php echo JHTML::_('grid.sort', JText::_('COM_BOOKPRO_CUSTOMER_CREATED_DATE'), 'created', $listDirn, $listOrder); ?>
					</th>
					<th style="text-align: right" width="4%">
				        <?php echo JHTML::_('grid.sort', 'ID', 'id', $listDirn, $listOrder); ?>
					</th>
										
				</tr>
			</thead>
			<tfoot>
    			<tr>
    				<td colspan="10">
    				    <?php echo $this->pagination->getListFooter(); ?>
    				</td>
    			</tr>
			</tfoot>
			<tbody>
				<?php if (! is_array($this->items) || ! $itemsCount) { ?>
					<tr><td colspan="10"><?php echo JText::_('No items found.'); ?></td></tr>
				<?php } else { ?>
				    <?php for ($i = 0; $i < $itemsCount; $i++) { ?>
				    	<?php $subject = &$this->items[$i]; ?>
				   		
				    	<tr>
				    		
				    		<td class="checkboxCell"><?php echo JHTML::_('grid.checkedout', $subject, $i); ?></td>
				    		<td class="center">
								<?php echo JHtml::_('jgrid.published', $subject->state, $i, 'customers.', true, 'cb', null, null); ?>
							</td>
				    		<td>				                
				               <a href="<?php echo JRoute::_('index.php?option=com_bookpro&task=customer.edit&id='.(int) $subject->id); ?>">
							<?php echo $this->escape($subject->firstname.' '.$subject->lastname); ?></a>
				                
				    		</td>
				    		<td><?php echo $subject->username; ?>&nbsp;</td>				    		
				    		<td class="email"><?php echo $subject->email; ?></td>
				    		<td><?php echo $subject->telephone; ?>&nbsp;</td>
				    		<td><?php echo $subject->created; ?>&nbsp;</td>
				    		<td style="text-align: right; white-space: nowrap;"><?php echo number_format($subject->id, 0, '', ' '); ?></td>
				    	</tr>
				    <?php } ?>
				<?php } ?>
			</tbody>
		</table>
		
	
	<input type="hidden" name="task" value="" />
	<input type="hidden" name="boxchecked" value="0" />
	<?php echo JHtml::_('form.token'); ?>
	<input type="hidden" name="filter_order" value="<?php echo $listOrder; ?>"/>
	<input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn; ?>"/>
</form>
</div>