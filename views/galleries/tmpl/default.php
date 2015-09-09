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

$canOrder = $user->authorise('core.edit.state', 'com_bookpro');
$saverOrder = $listOrder == 'g.ordering';
if ($saverOrder)
{
	$saverOrderingUrl = 'index.php?option=com_bookpro&controllor=galleries&task=saveOrderAjax&tmpl=component';
	JHtml::_('sortablelist.sortable', 'bookproList', 'adminForm', strtolower($listDirn), $saverOrderingUrl);
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
<div class="span10" id="j-main-container">
    <form action="<?php echo JRoute::_('index.php?option=com_bookpro&view=galleries')?>" method="post" name="adminForm" id="adminForm">
    	
     	<h3> 
     	<?php //echo $this->title; ?> 
     	<?php echo $this->text; ?></h3>
    	

        <div id="filter-bar" class="btn-toolbar">

            <div class="btn-group pull-right hidden-phone">
                <label for="limit" class="element-invisible"><?php echo JText::_('JFIELD_PLG_SEARCH_SEARCHLIMIT_DESC'); ?></label>
                <?php echo $this->pagination->getLimitBox(); ?>
            </div>


        </div>
        <table class="table-striped table"  id="bookproList">
            <thead>
                <tr>
					<th width="1%" class="nowrap center hidden-phone">
						<?php echo JHtml::_('grid.sort', '<i class="icon-menu-2"></i>', 'g.ordering', $listDirn, $listOrder, null, 'asc','JGRID_HEADING_ORDERING'); ?>
					</th>
					<th width="1%" class="hidden-phone"><input type="checkbox"
						name="checkall-toggle" value=""
						title="<?php echo JText::_('JGLOBAL_CHECK_ALL'); ?>"
						onclick="Joomla.checkAll(this)" />
					</th>
					
					<th width="1%" class="nowrap center" style="min-width:55px">
							<?php echo JHtml::_('grid.sort', 'JSTATUS', 'g.state', $listDirn, $listOrder); ?>
					</th>

                    <th class="title" width="30%">
                        <?php echo JHTML::_('grid.sort', JText::_('COM_BOOKPRO_GALLERY_TITLE'), 'title', $listDirn, $listOrder); ?>
                    </th>


                    <th width="5%">
                        <?php echo JText::_('COM_BOOKPRO_IMAGE'); ?>
                    </th>
                    <th style="text-align: right;" width="5%">
                        <?php echo JHTML::_('grid.sort', 'ID', 'id', $listDirn, $listOrder); ?>
                    </th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <td colspan="12">
                        <?php echo $this->pagination->getListFooter(); ?>
                    </td>
                </tr>
            </tfoot>
            <tbody>
				<?php foreach ( $this->items as $i => $item ) :
				$canCheckin = $user->authorise('core.manage', 'com_checkin') || $item->checked_out == $user->get('id') || $item->checked_out == 0;
				$canChange = $user->authorise('core.edit.state', 'com_bookpro') && $canCheckin;
				$ipath = JUri::root() . $item->path;
				?>
				<tr class="row<?php echo $i % 2; ?>" sortable-group-id="1">
					<td class="order nowrap center hidden-phone">
					<?php if ($canChange) :
					$disableClassName = '';
					$disabledLabel = '';
					if (!$saverOrder) :
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
					<?php echo JHtml::_('jgrid.published', $item->state, $i,'galleries.', $canChange, 'cb'); ?>
					<?php echo JHtml::_('touradministrator.gallery', $item->featured, $i, true); ?>
					</td>
					<td class=""><a href="<?php echo JRoute::_ ( 'index.php?option=com_bookpro&task=gallery.edit&id=' . ( int ) $item->id );?>">
						<?php echo $this->escape($item->title); ?></a>
					</td>

					<td>
                        <img  src="<?php echo $ipath; ?>" width="100px;" height="100px;" alt="<?php echo $item->title; ?>" >
                    </td>
					<td class="hidden-phone" style="text-align: right; width: 5%" >
						<?php echo $item->id; ?>
					</td>					
				</tr>
				<?php endforeach; ?>
			</tbody>
           
        </table>

        <input type="hidden" name="obj_id" value="<?php echo $this->state->get('filter.obj_id') ?>"/>
        <input type="hidden" name="type" value="<?php echo $this->state->get('filter.type') ?>"/>
        <input type="hidden" name="task" value=""/>
        <input type="hidden" name="boxchecked" value="0" />
        <input type="hidden" name="filter_order" value="<?php echo $listOrder; ?>" />
		<input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn; ?>" />
        <?php echo JHTML::_('form.token'); ?>


    </form>	
</div>