<?php
/**
 * Support for work with request params.
 *
 * @package Bookpro
 * @author Ngo Van Quan
 * @link http://joombooking.com
 * @copyright Copyright (C) 2011 - 2012 Ngo Van Quan
 * @license 	GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 * @version $Id: request.php 44 2012-07-12 08:05:38Z quannv $
 */
defined ( '_JEXEC' ) or die ();
JHtml::_ ( 'dropdown.init' );
JHtml::_ ( 'formbehavior.chosen', 'select' );
JHtml::_('bootstrap.tooltip');
JHtml::_('behavior.multiselect');
BookProHelper::setSubmenu ( 1 );
$listOrder	= $this->escape($this->state->get('list.ordering'));
$listDirn	= $this->escape($this->state->get('list.direction'));
$saveOrder	= $listOrder == 'a.ordering';
if ($saveOrder)
{
	$saveOrderingUrl = 'index.php?option=com_bookpro&task=fields.saveOrderAjax&tmpl=component';
	JHtml::_('sortablelist.sortable', 'weblinkList', 'adminForm', strtolower($listDirn), $saveOrderingUrl);
}
$sortFields = array(
				'state' => JText::_('JSTATUS'),
				'title' => JText::_('COM_BOOKPRO_TITLE'),
				'name' => JText::_('COM_BOOKPRO_NAME'),
				'id' => JText::_('JGRID_HEADING_ID'),
				);
?>
<div id="j-main-container" class="span10">
<form action="<?php echo JRoute::_('index.php?option=com_bookpro&view=fields'); ?>" method="post" name="adminForm" id="adminForm">

	<?php BookProHelper::getModuleHeaderBasic($this->state->get('filter.search'), $this->pagination,$listDirn,$sortFields,$listOrder); ?>

			<table class="adminlist table-striped table">
				<thead>
					<tr>
						<th width="1%" class="hidden-phone">
							<?php echo JHtml::_('grid.checkall'); ?>
						</th>
						<th width="1%" style="min-width: 55px" class="nowrap center">
							<?php echo JHtml::_('grid.sort', 'JSTATUS', 'a.state', $listDirn, $listOrder);?>
						</th>
						<th>
							<?php echo JText::_('COM_BOOKPRO_TITLE'); ?>
						</th>						
						<th>
							<?php echo JText::_('COM_BOOKPRO_NAME'); ?>
						</th>						
						<th>
							<?php echo JText::_('COM_BOOKPRO_FIELD_TYPE'); ?>
						</th>
						<th>
							<?php echo JText::_('COM_BOOKPRO_FIELD_REQUIRED'); ?>
						</th>
						<th>
							<?php echo JText::_('COM_BOOKPRO_FIELD_SIZE'); ?>
						</th>						
						<th width="1%" class="nowrap">
							<?php echo JText::_('JGRID_HEADING_ID'); ?>
						</th>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<td colspan="9">
					<?php echo $this->pagination->getListFooter(); ?>
				</td>
					</tr>
				</tfoot>
				<tbody>
			
			<?php foreach ( $this->items as $i => $item ) {
				$ordering = ($listOrder == 'a.ordering');
				
		        $required 	= $item->required ? 'tick.png' : 'publish_x.png';
		        $required   = JHtml::_('image','admin/'.$required, null, array('border' => 0), true);
        
				?>
				<tr class="row<?php echo $i % 2; ?>">

					<td class="center">
						<?php echo JHtml::_('grid.id', $i, $item->id); ?>
					</td>

						<td class="center">
						<?php echo JHtml::_('jgrid.published', $item->state, $i, 'fields.', true, 'cb'); ?>
					</td>
						<td>
						
						<a
							href="<?php echo JRoute::_('index.php?option=com_bookpro&task=field.edit&id='.$item->id);?>">
							<?php echo $this->escape($item->title); ?>
						</a>
						</td>
						<td>
							<?php					
								echo $item->name;								
						 	?>
						</td>
						<td>
							<?php					
								echo $item->fieldtype;								
						 	?>
						</td>									
						<td class="">
							<?php echo $required ; ?>
						</td>
						<td class="">
							<?php echo $item->size ; ?>
						</td>
						
						<td class="center">
						<?php echo (int) $item->id; ?>
					</td>
					</tr>
			<?php } ?>
		</tbody>
			</table>
			<div>
				<input type="hidden" name="task" value="" /> 
				<input type="hidden" name="boxchecked" value="0" />
				<input type="hidden" name="filter_order" value="<?php echo $listOrder; ?>" />
				<input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn; ?>" />
		<?php echo JHtml::_('form.token'); ?>
		</form>	
	</div>

