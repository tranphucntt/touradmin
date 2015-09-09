<?php
/**
 * @package 	Bookpro
 * @author 		Ngo Van Quan
 * @link 		http://joombooking.com
 * @copyright 	Copyright (C) 2011 - 2012 Ngo Van Quan
 * @license 	GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 * @version 	$Id: default.php 26 2012-07-08 16:07:54Z quannv $
 **/

defined('_JEXEC') or die('Restricted access');
BookProHelper::setSubmenu(1);

JHtml::_('bootstrap.tooltip');
JHtml::_('behavior.multiselect');
JHtml::_('formbehavior.chosen', 'select');

$app		= JFactory::getApplication();
$listOrder 	= $this->escape ( $this->state->get ( 'list.ordering' ) );
$listDirn 	= $this->escape ( $this->state->get ( 'list.direction' ) );
$sortFields = array('a.state' => JText::_('JSTATUS'),
					'a.code' => JText::_('Code'),
					'a.title' => JText::_('JGLOBAL_TITLE'),
					'a.id' => JText::_('ID'), );
?>

<div class="span10" id="j-main-container">
<form action="<?php echo JRoute::_('index.php?option=com_bookpro&view=applications');?>" method="post" id="adminForm" name="adminForm">
<?php BookProHelper::getModuleHeaderBasic($this->state->get('filter.search'), $this->pagination,$listDirn,$sortFields,$listOrder); ?>

	<div id="editcell">
		<table class="adminlist table-striped table">
			<thead>
				<tr>
					<th width="1%" class="hidden-phone">
							<?php echo JHtml::_('grid.checkall'); ?>							
							
					</th>
					<th width="5%" style="min-width: 55px" class="nowrap center">
							<?php echo JHtml::_('grid.sort', 'JSTATUS', 'a.state', $listDirn, $listOrder);?>
					</th>
					<th style="min-width: 55px">
							<?php echo JHtml::_('grid.sort', 'JGLOBAL_TITLE', 'a.title', $listDirn, $listOrder);?>
					</th>
					<th style="min-width: 55px">
							<?php echo JHtml::_('grid.sort', 'Code', 'a.code', $listDirn, $listOrder);?>
					</th>
					<th width="1%" style="min-width: 55px" class="nowrap center">
							<?php echo JHtml::_('grid.sort', 'ID', 'a.id', $listDirn, $listOrder);?>
					</th>
				</tr>
			</thead>
			
			<tfoot>
					<tr>
						<td colspan="6">
						<?php echo $this->pagination->getListFooter(); ?>
						</td>
					</tr>
			</tfoot>
			
			<tbody>
				<?php if (empty($this->items)) { ?>
					<tr><td colspan="5" class="emptyListInfo"><?php echo JText::_('No items found.'); ?></td></tr>
				<?php }?>
				<?php foreach ( $this->items as $i => $item ) :?>
				<tr class="row<?php echo $i%2;?>" sorttable-group-id="1">
					<td class="center hidden-phone">
						<?php echo JHtml::_('grid.id', $i, $item->id);?>
					</td>
					<td class="center ">						
						<?php
							echo JHtml::_('jgrid.published', $item->state, $i, 'applications.', true, 'cb');
							
						?>					
					</td>
					<td class="nowrap has-context">
						<a href="<?php echo JRoute::_('index.php?option=com_bookpro&task=application.edit&id='.(int)$item->id);?>">
								<?php echo $this->escape($item->title); ?>
						</a>
					</td>
					<td class="left hidden-phone">
						<?php echo $this->escape($item->code);?>
					</td>
					<td class="center hidden-phone">
						<?php echo $this->escape($item->id);?>
					</td>
				</tr>				
				<?php endforeach;?>
				
				
			</tbody>
		</table>
	</div>
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="filter_order" value="<?php echo $listOrder; ?>" />
		<input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn; ?>" />
		<?php echo JHtml::_('form.token'); ?>
</form>	
</div>