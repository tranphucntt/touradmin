<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_helloworld
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access to this file
defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers/html');

JHtml::_('bootstrap.tooltip');
JHtml::_('behavior.multiselect');
JHtml::_('formbehavior.chosen', 'select');


$listOrder     = $this->escape($this->state->get('list.ordering'));
$listDirn      = $this->escape($this->state->get('list.direction'));
$saveOrder	= $listOrder == 'a.ordering';

if ($saveOrder)
{
	$saveOrderingUrl = 'index.php?option=com_bookpro&controller=Comments&task=saveOrderAjax&tmpl=component';
	JHtml::_('sortablelist.sortable', 'articleList', 'adminForm', strtolower($listDirn), $saveOrderingUrl);
}

BookProHelper::setSubmenu(12);

?>
<div class="span10" id="j-main-container">
	<form action="index.php?option=com_bookpro&view=comments" method="post"
		id="adminForm" name="adminForm">
		<div class="row-fluid">
			<div class="span12">
			<?php echo JText::_('COM_BOOKPRO_COMMENT_FILTER'); ?>
			
			</div>
		</div>
		<table class="table table-striped table-hover" id="articleList">
			<thead>
				<tr>
					<th width="1%" class="nowrap center hidden-phone"><?php echo JHtml::_('grid.sort', '<i class="icon-menu-2"></i>', 'a.ordering', $listDirn, $listOrder, null, 'asc', 'JGRID_HEADING_ORDERING', 'icon-menu-2'); ?>
					</th>
					<th width="2%"><?php echo JHtml::_('grid.checkall'); ?>
					</th>
					<th width="5%"><?php echo JHtml::_('grid.sort', 'COM_BOOKPRO_COMMENT_PUBLISHED', 'a.published', $listDirn, $listOrder); ?>
					</th>
					<th width="10%"><?php echo JHtml::_('grid.sort', 'COM_BOOKPRO_COMMENT_TITLE', 'a.title', $listDirn, $listOrder); ?>
					</th>
					<th width="10%"><?php echo JHtml::_('grid.sort', 'COM_BOOKPRO_COMMENT_RATE', 'a.ratings', $listDirn, $listOrder); ?>
					</th>
					<th width="15%"><?php echo JHtml::_('grid.sort', 'COM_BOOKPRO_COMMENT_PACKAGE_TITLE', '', $listDirn, $listOrder); ?>
					</th>
					<th width="15%"><?php echo JHtml::_('grid.sort', 'COM_BOOKPRO_COMMENT_NAME', 'a.name', $listDirn, $listOrder); ?>
					</th>
					<th width="15%"><?php echo JHtml::_('grid.sort', 'COM_BOOKPRO_COMMENT_DATE', 'a.created', $listDirn, $listOrder); ?>
					</th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<td colspan="7"><?php echo $this->pagination->getListFooter(); ?>
					</td>
				</tr>
			</tfoot>
			<tbody>
			<?php if (!empty($this->items)) : ?>
			<?php foreach ($this->items as $i => $row) :
			$link = JRoute::_('index.php?option=com_bookpro&task=comment.edit&id=' . $row->id);
			$link_package = JURI::root( true ).'/'.$row->url;

			if($row->ratings== 0) {
				$wsratings = 1;
			}else {
				$wsratings = $row->ratings;
			}

			$rankstar =  JURI::root() . "/components/com_bookpro/assets/images/" . $wsratings . 'star.png';

			?>
				<tr>
					<td class="order nowrap center hidden-phone"><?php
					if (!$saveOrder)
					{
						$iconClass = ' inactive tip-top hasTooltip" title="' . JHtml::tooltipText('JORDERINGDISABLED');
					}
					?> <span class="sortable-handler <?php //echo $iconClass ?>"> <i
							class="icon-menu"></i> </span> <?php if ($saveOrder) : ?> <input
						type="text" style="display: none" name="order[]" size="5"
						value="<?php echo $row->ordering; ?>"
						class="width-20 text-area-order " /> <?php endif; ?>
					</td>
					<td><?php echo JHtml::_('grid.id', $i, $row->id); ?>
					</td>
					<td align="center"><?php echo JHtml::_('jgrid.published', $row->published, $i, 'comments.', true, 'cb'); ?>
					</td>
					<td><a href="<?php echo $link; ?>"
						title="<?php echo JText::_('COM_BOOKPRO_COMMENT_EDIT'); ?>"> <?php echo $row->title; ?>
					</a>
					</td>
					<td align="center">
						<div style="text-align: left">
							<img src="<?php echo $rankstar; ?>">
						</div>
					</td>
					<td>
						<a href="<?php echo $link_package; ?>" title="<?php echo JText::_('COM_BOOKPRO_COMMENT_PACKAGE_TITLE'); ?>">
							<?php echo $row->title_obj; ?> 
						</a>
					</td>
					<td align="center"><?php echo $row->name; ?>
					</td>
					<td align="center"><?php echo $row->created; ?>
					</td>
				</tr>
				<?php endforeach; ?>
				<?php endif; ?>
			</tbody>
		</table>
		<input type="hidden" name="task" value="" /> <input type="hidden"
			name="boxchecked" value="0" /> <input type="hidden"
			name="filter_order" value="<?php echo $listOrder; ?>" /> <input
			type="hidden" name="filter_order_Dir"
			value="<?php echo $listDirn; ?>" />
			<?php echo JHtml::_('form.token'); ?>
	</form>
</div>
