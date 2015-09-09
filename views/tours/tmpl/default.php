<?php

/**
 * @package 	Bookpro
 * @author 		Ngo Van Quan
 * @link 		http://joombooking.com
 * @copyright 	Copyright (C) 2011 - 2012 Ngo Van Quan
 * @license 	GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 * @version 	$Id: view.html.php 26 2012-07-08 16:07:54Z quannv $
 **/
defined ( '_JEXEC' ) or die ( 'Restricted access' );

JHtml::_('bootstrap.tooltip');
JHtml::_('behavior.multiselect');
JHtml::_ ( 'formbehavior.chosen', 'select' );

BookProHelper::setSubmenu ( 2 );
JToolbarHelper::addNew('tour.add');
JToolbarHelper::editList('tour.edit');
JToolBarHelper::divider ();
JToolbarHelper::custom('tours.featured', 'featured.png', 'featured_f2.png', 'JFEATURED', true);
JToolbarHelper::publish('tours.publish', 'JTOOLBAR_PUBLISH', true);
JToolbarHelper::unpublish('tours.unpublish', 'JTOOLBAR_UNPUBLISH', true);
JToolbarHelper::deleteList('', 'tours.delete', 'JTOOLBAR_DELETE');
JToolbarHelper::custom('tours.duplicate', 'copy.png', 'copy_f2.png', 'JTOOLBAR_DUPLICATE', true);

$user = JFactory::getUser ();
$userId = $user->get ( 'id' );
$listOrder = $this->escape ( $this->state->get ( 'list.ordering' ) );
$listDirn = $this->escape ( $this->state->get ( 'list.direction' ) );
$saveOrder	= $listOrder == 'a.ordering';
if ($saveOrder)
{
	$saveOrderingUrl = 'index.php?option=com_bookpro&controller=tours&task=saveOrderAjax&tmpl=component';
	JHtml::_('sortablelist.sortable', 'weblinkList', 'adminForm', strtolower($listDirn), $saveOrderingUrl);
}
$params = (isset ( $this->state->params )) ? $this->state->params : new JObject ();

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
	<form action="<?php echo JRoute::_('index.php?option=com_bookpro&view=tours');?>" method="post" name="adminForm" id="adminForm">
		<div class="form-inline">
					<input type="text" name="filter_search"
						value="<?php echo $this->state->get('filter.search')?>"
						placeholder="<?php echo JText::_('COM_BOOKPRO_KEYWORD')?>"
						id="filter_search">

						<?php echo $this->duration; ?>
						<?php echo $this->category; ?>
					<button onclick="this.form.submit();" class="btn">
						<i class="icon-search"></i>
					</button>
					<button type="button" class="btn hasTooltip"
						title="<?php echo JHtml::tooltipText('JSEARCH_FILTER_CLEAR'); ?>"
						onclick="document.id('filter_search').value='';
								 document.id('filter_days').value='';
								 document.id('filter_cat_id').value=0;
								 this.form.submit();
						">
						<i class="icon-remove"></i>
					</button>
			<div class="btn-group pull-right hidden-phone">
				<label for="limit" class="element-invisible"><?php echo JText::_('JFIELD_PLG_SEARCH_SEARCHLIMIT_DESC');?>
				</label>
				<?php echo $this->pagination->getLimitBox(); ?>
			</div>
		</div>

		<table class="table-striped table" id="weblinkList">
			<thead>
				<tr>
					<th width="1%" class="nowrap center hidden-phone">
						<?php echo JHtml::_('grid.sort', '<i class="icon-menu-2"></i>', 'a.ordering', $listDirn, $listOrder, null, 'asc', 'JGRID_HEADING_ORDERING'); ?>
					</th>				
					<th width="1%"><?php echo JHtml::_('grid.checkall'); ?></th>
					<th width="1%" style="min-width: 55px" class="nowrap center"><?php echo JHtml::_('grid.sort', 'JSTATUS', 'a.state', $listDirn, $listOrder); ?></th>
					<th></th>
					<th><?php echo JHtml::_('grid.sort', 'JGLOBAL_TITLE', 'a.title', $listDirn, $listOrder); ?></th>
					<th><?php echo JText::_('COM_BOOKPRO_TOUR_DURATION')?></th>
					<th><?php echo JText::_('COM_BOOKPRO_TOUR_RATE_MANAGER'); ?></th>
					<th><?php echo JText::_('COM_BOOKPRO_GALLERY')?></th>
					<th><?php echo JText::_('COM_BOOKPRO_TOUR_ITINERARY')?></th>
					<th><?php echo JText::_('COM_BOOKPRO_AVAILABILITY')?></th>
					<th><?php echo JText::_('COM_BOOKPRO_ADDONS')?></th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<td colspan="10"><?php echo $this->pagination -> getListFooter(); ?>
					</td>
				</tr>
			</tfoot>
			<tbody>
			<?php

			for($i = 0; $i < count($this->items); $i ++) {
				$subject = $this->items [$i];
				$ordering = ($listOrder == 'a.ordering');
				?>
				<tr>
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
									<input type="text" style="display:none" name="order[]" size="5" value="<?php echo $subject->ordering; ?>" />
								<?php endif; ?>
						</td>
							
					<td class="checkboxCell"><?php echo JHTML::_('grid.checkedout', $subject, $i); ?>
					</td>
					<td class="center">
						<div class="btn-group">
						<?php echo JHtml::_('jgrid.published', $subject->state, $i, 'tours.', true, 'cb'); ?>
						<?php echo JHtml::_('touradministrator.featured', $subject->featured, $i, true); ?>
						</div>
					</td>
					<td>
					<?php
							if($subject->img_path){
								$thumb = JUri::root().$subject->img_path;
							}else {
								$thumb = JUri::root().'components/com_bookpro/assets/images/no_image.jpg';
							}
					?> 
						<img src="<?php echo $thumb ?>" width="50"/ style="float:none; margin-bottom: 3px;">  
					
					</td>
					<td>
						<a href="<?php echo JRoute::_('index.php?option=com_bookpro&task=tour.edit&id='.(int) $subject->id); ?>">
							<?php echo $subject -> title; ?> </a>
						<br> 
						<label class="label"><?php echo $subject->cat_title?></label>
					</td>
					
					<td><?php echo TourHelper::buildDuration($subject); ?>
					</td>
					
					<td class="center">
						<?php echo CurrencyHelper::formatprice($subject->price); ?>
						<br/>
						<a href="<?php echo JRoute::_ ( 'index.php?option=com_bookpro&view=tourpackages&tour_id=' . $subject -> id ); ?>"
							class="btn btn-success">
							<?php echo JText::_('COM_BOOKPRO_MANAGE')?>
						</a>
					</td>
				

					<td class="center" >
						<br/>
						<div class="">
							<a	href="<?php echo JRoute::_ ( 'index.php?option=com_bookpro&view=galleries&type=tour&obj_id=' . $subject -> id ); ?>"
								class="btn btn-success"><?php echo JText::_('COM_BOOKPRO_MANAGE')?> </a>	
						</div>
					</td>

					<td>
						
					<a	href="<?php echo JRoute::_ ( 'index.php?option=com_bookpro&view=itineraries&tour_id=' . $subject -> id ); ?>"
						class="btn btn-success"><?php echo JText::_('COM_BOOKPRO_MANAGE')?></a>
						
						<br/>
						<?php echo TourHelper::getTourDestination($subject->id) ?>
						</td>
					<td>
						
					<a	href="<?php echo JRoute::_ ( 'index.php?option=com_bookpro&view=avail&tour_id=' . $subject -> id ); ?>"
						class="btn btn-success"><?php echo JText::_('COM_BOOKPRO_MANAGE')?></a>
						
					</td>
												
						
					<td style="width:150px;">
						<?php echo TourHelper::getTourAddon($subject->id) ?>
					</td>
					
					
				</tr>
				<?php  } ?>
				<?php
				?>
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
