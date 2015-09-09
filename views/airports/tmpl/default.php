<?php

defined('_JEXEC') or die('Restricted access');

/* @var $this BookingViewSubjects */
BookProHelper::setSubmenu(6);

$listOrder	= $this->escape($this->state->get('list.ordering'));
$listDirn	= $this->escape($this->state->get('list.direction'));
$ordering 	= ($listOrder == 'a.lft');
$saveOrder 	= ($listOrder == 'a.lft' && $listDirn == 'asc');

$itemsCount = count($this->items);
$pagination = &$this->pagination;

$saveOrderingUrl = 'index.php?option=com_bookpro&controller=airports&task=saveOrderAjax&tmpl=component';
JHtml::_('sortablelist.sortable', 'airportList', 'adminForm', strtolower($listDirn), $saveOrderingUrl, false, true);
?>
<script type="text/javascript">
	Joomla.orderTable = function()
	{
		table = document.getElementById("sortTable");
		direction = document.getElementById("directionTable");
		order = table.options[table.selectedIndex].value;
		if (order != '<?php echo $listOrder; ?>') {
			dirn = 'asc';
		}
		else {
			dirn = direction.options[direction.selectedIndex].value;
		}
		Joomla.tableOrdering(order, dirn, '');
	}
</script>
<div class="span10" id="j-main-container">
<form action="index.php?option=com_bookpro&view=airports" method="post" name="adminForm" id="adminForm">
	<div id="filter-bar" class="btn-toolbar">
		<div class="filter-search fltlft form-inline">
			 <input class="text_area" type="text" name="filter_search" id="filter_search" size="20" maxlength="255" value="<?php echo $this->state->get('filter.search'); ?>"  placeholder="<?php echo JText::_('COM_BOOKPRO_DESTINATION')?>"/>
			 <?php echo $this->countries; ?>
		</div>
		
				<div class="btn-group pull-left hidden-phone fltlft">
					<button onclick="this.form.submit();" class="btn">
						<i class="icon-search"></i>
					</button>
					<button type="button" class="btn hasTooltip"
						title="<?php echo JHtml::tooltipText('JSEARCH_FILTER_CLEAR'); ?>"
						onclick="document.id('filter_search').value='';
								 document.id('filter.country_id').value=0;
								 this.form.submit();
						">
						<i class="icon-remove"></i>
					</button>
				</div>
				
		<div class="btn-group pull-right hidden-phone">
				<label for="limit" class="element-invisible"><?php echo JText::_('JFIELD_PLG_SEARCH_SEARCHLIMIT_DESC');?></label>
				<?php echo $this->pagination->getLimitBox(); ?>
		</div>
		
	</div>
	
		<table class="table-striped table" id="airportList">
			<thead>
				<tr>
					<th width="1%" class="nowrap center hidden-phone">
						<?php echo JHtml::_('grid.sort', '<i class="icon-menu-2"></i>', 'a.lft', $listDirn, $listOrder, null, 'asc', 'JGRID_HEADING_ORDERING'); ?>
					</th>
					
						<th width="1%" class="hidden-phone">
							<?php echo JHtml::_('grid.checkall'); ?>
						</th>
					
					<th width="1%">
				        <?php echo JHTML::_('grid.sort',JText::_('JSTATUS'), 'state', $listDirn, $listOrder); ?>
					</th>
					
					
					<th class="title" width="10%">
				        <?php echo JHTML::_('grid.sort',JText::_('COM_BOOKPRO_AIRPORT_TITLE'), 'title', $listDirn, $listOrder); ?>
					</th>
					
					<th width="5%">
				        <?php echo JText::_('COM_BOOKPRO_AIRPORT_IATA_CODE'); ?>
					</th>
					
						
					
					<th width="5%">
				        <?php echo JText::_('COM_BOOKPRO_COUNTRY'); ?>
					</th>
					
					<th width="1%" align="right" >
				        <?php echo JHTML::_('grid.sort', 'ID', 'id', $listDirn, $listOrder); ?>
					</th>
				</tr>
			</thead>
			<tfoot>
    			<tr>
    				<td colspan="7">
    				    <?php echo $pagination->getListFooter(); ?>
    				</td>
    			</tr>
			</tfoot>
			<tbody>
				<?php if (! is_array($this->items)) { ?>
					<tr><td colspan="<?php echo $colspan; ?>" class="emptyListInfo"><?php echo JText::_('No items found.'); ?></td></tr>
				<?php 
				
					} else {
												
						 for ($i = 0; $i < $itemsCount; $i++) { 
				    	 	$subject = &$this->items[$i]; 
				    		$link = JRoute::_(ARoute::edit(CONTROLLER_AIRPORT, $subject->id));
				    		
				    		if ($subject->level > 1)
				    		{
				    			$parentsStr = "";
				    			$_currentParentId = $subject->parent_id;
				    			$parentsStr = " " . $_currentParentId;
				    			for ($i2 = 0; $i2 < $subject->level; $i2++)
				    			{
					    			foreach ($this->ordering as $k => $v)
					    			{
						    			$v = implode("-", $v);
					    				$v = "-" . $v . "-";
					    				if (strpos($v, "-" . $_currentParentId . "-") !== false)
					    				{
						    				$parentsStr .= " " . $k;
						    				$_currentParentId = $k;
						    				break;
					    				}
				    				}
			    				}
			    			}
		    				else
		    				{
			    				$parentsStr = "";
			    			}
				    		
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
				    			
				    		<td class="hidden-phone">
								<?php echo JHtml::_('grid.id', $i, $subject->id); ?>
							</td>	
				    		<td>
							<?php echo JHtml::_('jgrid.published', $subject->state, $i, 'airports.', true, 'cb', null, null); ?>
							</td>
				    		<td>
				    		
					    		<?php echo str_repeat('<span class="gi">&mdash;</span>', $subject->level - 1) ?>
					    		<a href="<?php echo JRoute::_('index.php?option=com_bookpro&task=airport.edit&id='.$subject->id);?>"><?php echo $subject->title; ?></a>
					    		
				    		</td>
				    		
				    		<td>
						        <?php  echo $subject->code;?>
				    		</td>
				    		
				    		<td>
						        <?php  echo $subject->country_name;?>
				    		</td>
				    		<td><?php echo number_format($subject->id, 0, '', ' '); ?></td>
				    	</tr>
				    <?php 
				    	}
					} 
					?>
			</tbody>
		</table>
		
	<input type="hidden" name="task" value=""/>
	<input type="hidden" name="boxchecked" value="0"/>
	<input type="hidden" name="filter_order" value="<?php echo $order; ?>"/>
	<input type="hidden" name="filter_order_Dir" value="<?php echo $orderDir; ?>"/>
	
	<?php echo JHTML::_('form.token'); ?>
</form>	
</div>