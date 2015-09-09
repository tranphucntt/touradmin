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

BookProHelper::setSubmenu(2);
JHtml::_('bootstrap.tooltip');
JHtml::_('behavior.multiselect');
JHtml::_('formbehavior.chosen', 'select');

$app		= JFactory::getApplication();
$listOrder = $this->escape ( $this->state->get ( 'list.ordering' ) );
$listDirn = $this->escape ( $this->state->get ( 'list.direction' ) );
$saveOrder = $listOrder == 'a.ordering';
if ($saveOrder) {
	$saveOrderingUrl = 'index.php?option=com_bookpro&controller=packagetypes&task=saveOrderAjax&tmpl=component';
	JHtml::_('sortablelist.sortable', 'packagetypeList', 'adminForm', strtolower($listDirn), $saveOrderingUrl);
}
$sortFields = $this->getSortFields ();
?>
<script type="text/javascript">

var add_item  = '<tr class="row0 dndlist-sortable">';
	add_item += '<td class="center">';
	add_item += '</td>';
	add_item += '<td class="center ">';
	add_item += '<select name="jform[state][]" id="jformstate" class="chzn-done">';
	add_item += '<option value="1">Active</option>';
	add_item += '<option value="0">InActive</option>';
	add_item += '</select>';
	add_item += '</td>';
	add_item += '<td class="center ">';
	add_item += '<input type="text" value="" maxlength="255" size="60"  name="jform[title][]" class="jform_title">';
	add_item += '</td>';
	add_item += '<td class="center hidden-phone">';
	add_item += '<textarea cols="30" rows="3" name="jform[desc][]" class="jform_desc"></textarea>';
	add_item += '</td>';
	add_item += '<td class="center hidden-phone">';
	add_item += '<a href="javascript:void(0);"><span class="icon-unpublish delete_item"></span></a>';	
	add_item += '<input type="hidden" value="" id="jform_id" name="jform[id][]">';
	add_item += '<input type="hidden" value="<?php echo $this->tour_id;?>" id="jform_tour_id" name="jform[tour_id][]">';
	add_item += '</td>';
	add_item += '</tr>';

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

	Joomla.submitbutton = function(task)
	{
		if(task=='add'){
			jQuery("#ui-sortable").append(add_item);
            var config = {
					 '.chzn-done' : {},
					 }
					 for (var selector in config) {
					 jQuery(selector).chosen(config[selector]);
					 }
			 
		}else{
			Joomla.submitform(task, document.getElementById('adminForm'));
		}	
	}
	jQuery(document).ready(function(){	
		jQuery('.delete_item').live('click',function(){
			jQuery(this).parent().parent().parent().remove()
			});
		
		jQuery('#add_item').hide();
	});
	
</script>



<table id="add_item">
	<tr class="row0 dndlist-sortable">
		<td class="center"></td>
		<td class="center "><?php echo AHtml::getDropBoxForState('jform[state][]',null,null)?></td>
		<td class="center "><input type="text" class="jform_title" name="jform[title][]" size="60" maxlength="255" value=""></td>
		<td class="center hidden-phone"><textarea class="jform_desc" name="jform[desc][]" rows="3" cols="30"></textarea></td>
		<td class="center hidden-phone"></td><td class="center hidden-phone"><a href="javascript:void(0);"><span class="icon-unpublish delete_item"></span></a>
		<input type="hidden" name="jform[id][]" id="jform_id" value="">
		<input type="hidden" name="jform[tour_id][]" value="<?php echo $this->tour_id; ?>" />
		</td>
	</tr>
</table>

<div class="span10" id="j-main-container">
<form action="<?php echo JRoute::_('index.php?option=com_bookpro&view=packagetypes');?>" method="post" id="adminForm" name="adminForm">
<div id="filter-bar" class="btn-toolbar">
		<!-- search input -->
		<div class="filter-search btn-group pull-left">
			<label for="filter_search" class="element-invisible">
				<?php echo JText::_('COM_BOOKPRO_SEARCH');?>
			</label>
			<input type="text" name="filter_search" id="filter_search" class="hasTooltip"
				placeholder="<?php echo JText::_('COM_BOOKPRO_PACKAGETYPE_TITLE');?>"
				value="<?php echo $this->escape($this->state->get('filter.search'));?>"
				title="<?php echo JText::_('COM_BOOKPRO_PACKAGETYPE_TITLE');?>"
			/>
			
		</div>
				
		<!-- search button -->
		<div class="btn-group pull-left">
			<button class="btn hasTooltip" type="submit" 
			title="<?php echo JText::_('JSEARCH_FILTER_SUBMIT');?>"	>
				<i class="icon-search"></i>
			</button>
			<button class="btn hasTooltip" type="button"
			title="<?php echo JText::_('JSEARCH_FILTER_CLEAR');?>"
			onclick="document.id('filter_search').value='';				
				this.form.submit();" >
				<i class="icon-remove"></i>
			</button>
		</div>
		
		<div class="btn-group pull-right hidden-phone">
					<label for="limit" class="element-invisible"><?php echo JText::_('JFIELD_PLG_SEARCH_SEARCHLIMIT_DESC');?></label>
					<?php echo $this->pagination->getLimitBox(); ?>
		</div>
		
		<!-- filter sort -->
		<div class="btn-group pull-right hidden-phone">	
			<label for="directionTable" class="element-invisible">
				<?php echo JText::_('JFIELD_ORDERING_DESC');?>
			</label>
			<select name="directionTable" id="directionTable" class="input-medium" onchange="Joomla.orderTable()">
				<option value="">
					<?php echo JText::_('JFIELD_ORDERING_DESC');?>
				</option>
				<option value="asc"	<?php if($listDirn == 'asc') echo 'selected="selected"' ?>>
					<?php echo JText::_('JGLOBAL_ORDER_ASCENDING');?>
				</option>
				<option value="desc" <?php if($listDirn=='desc') echo 'selected="selected"'?>>
					<?php echo JText::_('JGLOBAL_ORDER_DESCENDING');?>
				</option>
			</select>	
		</div>
		
		<div class="btn-group pull-right">
			<label for="sortTable" class="element-invisible">
				<?php echo JText::_('JGLOBAL_SORT_BY');?>
			</label>
			<select name="sortTable" id="sortTable" class="input-medium" onchange="Joomla.orderTable()">
				<option value=""><?php echo JText::_('JGLOBAL_SORT_BY');?></option>
				<?php echo JHtml::_('select.options', $sortFields, 'value', 'text', $listOrder); //option = columes of database?>
			</select>
		</div>
</div>
<div class="clearfix"></div>
	<table class="table table-striped" id="packagetypeList">
		<thead>
			<tr>
				<th width="2%" class="hidden-phone center">
							<?php echo JHtml::_('grid.checkall'); ?>							
							
				</th>
				<th width="5%" style="min-width: 55px" class="nowrap center">
							<?php echo JHtml::_('grid.sort', 'JSTATUS', 'a.state', $listDirn, $listOrder);?>
				</th>

				<th width="30%"  class="nowrap center">
							<?php echo JHtml::_('grid.sort', 'JGLOBAL_TITLE', 'a.ordering', $listDirn, $listOrder);?>
				</th>
				
				<th width="30%" class="nowrap center">
							<?php echo JText::_('COM_BOOKPRO_PACKAGETYPE_DESCRIPTION');?>
				</th>
				
				<th width="5%"  class="nowrap center">
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
				
		<tbody id="ui-sortable">
			<?php
				
				foreach ( $this->items as $i => $item ) :
				$ordering	= $listOrder == 'a.ordering';
			?>
				<tr class="row<?php echo $i%2;?>" sorttable-group-id="1">
					
					<td class="center hidden-phone">
					<?php echo JHtml::_('grid.id', $i, $item->id);?>
					</td>
					<td class="center ">
						<?php echo AHtml::getDropBoxForState('jform[state][]',null,$item->state)?>
					</td>
					<td class="center ">
						<input type="text" name="jform[title][]" size="60" maxlength="255" value="<?php echo $item->title; ?>" class="text_area"/>
					</td>
					
					<td class="center hidden-phone">
						<textarea name="jform[desc][]" rows="3" cols="30" aria-invalid="false" class="text_area jform_desc"><?php echo $item->desc;?></textarea>
					</td>
				
					<td class="center hidden-phone">
						<?php echo $this->escape($item->id);?>
						<input type="hidden" name="jform[id][]" value="<?php echo $item->id; ?>" />
						<input type="hidden" name="jform[tour_id][]" value="<?php echo $this->tour_id; ?>" />
					</td>
				</tr>
			<?php endforeach;?>
		</tbody>
	</table>


		<input type="hidden" name="task" value="" />
		<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="filter_order" value="<?php echo $listOrder; ?>" />
		<input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn; ?>" />
		<?php echo JHtml::_('form.token'); ?>

</form>
</div>	
