<?php
/**
 * @package 	Bookpro
 * @author 		Ngo Van Quan
 * @link 		http://joombooking.com
 * @copyright 	Copyright (C) 2011 - 2012 Ngo Van Quan
 * @license 	GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 * @version 	$Id: view.html.php 26 2012-07-08 16:07:54Z quannv $
 **/

defined ( '_JEXEC' ) or die ();
$user = JFactory::getUser();
$listOrder = $this->escape($this->state->get('list.ordering'));
$listDirn = $this->escape($this->state->get('list.direction'));

$canOrder = $user->authorise('core.edit.state', 'com_bookpro');
$saveOrder = $listOrder == 'a.ordering';
if ($saveOrder)
{
	$saveOrderingUrl = 'index.php?option=com_bookpro&controller=itineraries&task=saveOrderAjax&tmpl=component';
	JHtml::_('sortablelist.sortable', 'bookproList', 'adminForm', strtolower($listDirn), $saveOrderingUrl);
}
$sortFields = $this->getSortFields();

BookProHelper::setSubmenu(12);
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


<div id="j-main-container" class="span10">
<form action="<?php echo JRoute::_ ( 'index.php?option=com_bookpro&view=itineraries' );?>"
	method="post" name="adminForm" id="adminForm">
		<div id="filter-bar" class="btn-toolbar">
		<div class="filter-search fltlft">
			<?php echo $this->tours_filter; ?>
		</div>
		
		<div class="btn-group pull-right hidden-phone">
			<label for="limit" class="element-invisible">
			<?php echo JText::_('JFIELD_PLG_SEARCH_SEARCHLIMIT_DESC');?>
			</label>
			<?php echo $this->pagination->getLimitBox(); ?>
		</div>

</div>

		<div class="clearfix"></div>
		<table class="table table-striped" id="bookproList">
			<thead>
				<tr>
					<th width="1%" class="nowrap center hidden-phone">
					<?php echo JHtml::_('grid.sort', '<i class="icon-menu-2"></i>', 'a.ordering', $listDirn, $listOrder, null, 'asc','JGRID_HEADING_ORDERING'); ?>
					</th>
					<th width="1%" class="hidden-phone">
					<input type="checkbox" name="checkall-toggle" value="" title="<?php echo JText::_('JGLOBAL_CHECK_ALL'); ?>"
						onclick="Joomla.checkAll(this)" />
					</th>
					<th width="1%" style="min-width:55px" class="nowrap center">
					<?php echo JHtml::_('grid.sort', 'JSTATUS', 'a.state',$listDirn, $listOrder); ?>
					</th>
					<th class="title">
					<?php echo JHtml::_ ( 'grid.sort', 'JGLOBAL_TITLE', 'a.title', $listDirn, $listOrder );?>
					</th>
					
					<th width="25%" class="nowrap hidden-phone">
					<?php echo JHtml::_('grid.sort', 'COM_BOOKPRO_DESTINATION', 'a.dest_id', $listDirn, $listOrder); ?>
					</th>
					<th width="1%" class="nowrap center hidden-phone">
					<?php echo JHtml::_('grid.sort', 'JGRID_HEADING_ID','a.id', $listDirn, $listOrder); ?>
					</th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<td colspan="10"><?php echo $this->pagination->getListFooter(); ?></td>
				</tr>
			</tfoot>
			<tbody>
				<?php foreach ( $this->items as $i => $item ) :
				$canCheckin = $user->authorise('core.manage', 'com_checkin') || $item->checked_out == $user->get('id') || $item->checked_out == 0;
				$canChange = $user->authorise('core.edit.state', 'com_bookpro') && $canCheckin;
				?>
				<tr class="row<?php echo $i % 2; ?>" sortable-group-id="1">
					<td class="order nowrap center hidden-phone">
					<?php if ($canChange) :
					$disableClassName = '';
					$disabledLabel = '';
					if (!$saveOrder) :
					$disabledLabel = JText::_('JORDERINGDISABLED');
					$disableClassName = 'inactive tip-top';
					endif; ?>
					<span class="sortable-handler hasTooltip <?php echo $disableClassName?>" title="<?php echo $disabledLabel; ?>">
					<i class="icon-menu"></i>
					</span>
					<input type="text" style="display:none" name="order[]" size="5" value="<?php echo $item->ordering;?>" class="width-20 textarea-order " />
					<?php else : ?>
					<span class="sortable-handler inactive" ><i class="icon-menu"></i></span>
					<?php endif; ?>
					</td>
					<td class="center hidden-phone">
						<?php echo JHtml::_('grid.id', $i, $item->id); ?>
					</td>
					<td class="center">
					<?php echo JHtml::_('jgrid.published', $item->state, $i,'itineraries.', $canChange, 'cb'); ?>
					</td>
					<td class="nowrap has-context"><a href="<?php echo JRoute::_ ( 'index.php?option=com_bookpro&task=itinerary.edit&id=' . ( int ) $item->id );?>">
						<?php echo $this->escape($item->title); ?></a>
					</td>
					
					<td class="hidden-phone">
						<?php echo $this->escape($item->dest_title); ?>
					</td>
					<td class="center hidden-phone">
						<?php echo (int) $item->id; ?>
					</td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
		<input type="hidden" name="task" value="" /> 
		<input type="hidden" name="boxchecked" value="0" /> 
		<input type="hidden" name="filter_order" value="<?php echo $listOrder;?>" /> 
		<input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn; ?>" />
		<?php echo JHtml::_('form.token'); ?>

</form>
</div>