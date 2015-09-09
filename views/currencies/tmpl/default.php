<?php
/**
 * @package 	Bookpro
 * @author 		Ngo Van Quan
 * @link 		http://joombooking.com
 * @copyright 	Copyright (C) 2011 - 2012 Ngo Van Quan
 * @license 	GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 * @version 	$Id: default.php 82 2012-08-16 15:07:10Z quannv $
 **/
defined('_JEXEC') or die('Restricted access');
$user = JFactory::getUser();
$listOrder	= $this->escape($this->state->get('list.ordering'));
$listDirn	= $this->escape($this->state->get('list.direction'));
$saveOrder	= $listOrder == 'l.ordering';
if ($saveOrder)
{
	$saveOrderingUrl = 'index.php?option=com_bookpro&controller=currencies&task=saveOrderAjax&tmpl=component';
	JHtml::_('sortablelist.sortable', 'weblinkList', 'adminForm', strtolower($listDirn), $saveOrderingUrl);
}
$sortFields = $this->getSortFields();

BookProHelper::setSubmenu(3);

?>
 <script type="text/javascript">
	Joomla!.orderTable = function()
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
		Joomla!.tableOrdering(order, dirn, '');
	}
</script>
<div class="span10">
    <form action="<?php echo JRoute::_('index.php?option=com_bookpro&view=currencies')?>" method="post" name="adminForm" id="adminForm">
        <table class="table-striped table" id="weblinkList">
            <thead>
                <tr>
					<th width="1%" class="nowrap center hidden-phone">
						<?php echo JHtml::_('grid.sort', '<i class="icon-menu-2"></i>', 'l.ordering', $listDirn, $listOrder, null, 'asc','JGRID_HEADING_ORDERING'); ?>
					</th>
					<th width="1%" class="hidden-phone"><input type="checkbox"
						name="checkall-toggle" value=""
						title="<?php echo JText::_('JGLOBAL_CHECK_ALL'); ?>"
						onclick="Joomla.checkAll(this)" />
					</th>
					
					<th width="1%" class="nowrap center" style="min-width:55px">
							<?php echo JHtml::_('grid.sort', 'JSTATUS', 'a.state', $listDirn, $listOrder); ?>
							
					</th>
					
					<th class="title" width="20%">
				        <?php echo JHTML::_('grid.sort', JText::_('JGLOBAL_TITLE'), 'a.title', $listDirn, $listOrder); ?>
					</th>
					  
                   
					<th width="12%"><?php echo JText::_('COM_BOOKPRO_CURRENCY_NAME')?></th>
                    <th class="title" width="8%">
                    	<?php echo JText::_('COM_BOOKPRO_CURRENCY_SYMBOL')?>
                    </th>
                    
                    <th width="8%">
                    	<?php echo JText::_('COM_BOOKPRO_CURRENCY_DISPLAY')?>
                    </th>
                    
                    <th width="8%">
                  		<?php echo JText::_('COM_BOOKPRO_CURRENCY_EXCHANGE_RATE')?>
                    </th>

                    <th style="text-align: right;" width="5%">
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
				<?php foreach ( $this->items as $i => $item ) :
				$canCheckin = $user->authorise('core.manage', 'com_checkin') || $item->checked_out == $user->get('id') || $item->checked_out == 0;
				$canChange = $user->authorise('core.edit.state', 'com_bookpro') && $canCheckin;
				?>
				<tr class="row<?php echo $i % 2; ?>" sortable-group-id="1">
					<td class="order nowrap center hidden-phone">
								<?php
								$iconClass = '';
								if (!$saveOrder)
								{
									$iconClass = ' inactive tip-top hasTooltip" title="' . JHtml::tooltipText('JORDERINGDISABLED');
								}
								?>
								<span class="sortable-handler<?php echo $iconClass ?>">
								<i class="icon-menu"></i>
								</span>
								<?php if ($saveOrder) : ?>
									<input type="text" style="display:none" name="order[]" size="5" value="<?php echo $item->ordering; ?>" />
								<?php endif; ?>
							</td>	
					<td class="center hidden-phone">
						<?php echo JHtml::_('grid.id', $i, $item->id); ?>
					</td>
					<td class="center">
					<?php echo JHtml::_('jgrid.published', $item->state, $i,'currencies.', $canChange, 'cb'); ?>
					</td>
					<td class=""><a href="<?php echo JRoute::_ ( 'index.php?option=com_bookpro&task=currency.edit&id=' . ( int ) $item->id );?>">
						<?php echo $this->escape($item->title); ?></a>
					</td>	
					
					
					<td class="hidden-phone">
						<?php echo $this->escape($item->name); ?>
					</td>
					
					<td class="center hidden-phone">
						<?php echo $this->escape($item->symbol); ?>
					</td>
					<td class="center hidden-phone">
						<?php echo $this->escape($item->thousand); ?>
					</td>
					<td class="center hidden-phone">
						<?php echo $this->escape($item->exchange_rate); ?>
					</td>
					<td class="hidden-phone" style="text-align: right;">
						<?php echo $item->id; ?>
					</td>					
				</tr>
				<?php endforeach; ?>
			</tbody>
            
            
        </table>

        <input type="hidden" name="task" value=""/>
        <input type="hidden" name="boxchecked" value="0" />
        <input type="hidden" name="filter_order" value="<?php echo $listOrder; ?>" />
		<input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn; ?>" />
        <?php echo JHTML::_('form.token'); ?>


    </form>	
</div>