<?php
/**
 * @package 	Bookpro
 * @author 		Ngo Van Quan
 * @link 		http://joombooking.com
 * @copyright 	Copyright (C) 2011 - 2012 Ngo Van Quan
 * @license 	GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 * @version 	$Id: default.php 105 2012-08-30 13:20:09Z quannv $
 **/
defined('_JEXEC') or die('Restricted access');
BookProHelper::setSubmenu(12);
JToolbarHelper::addNew('tourpackage.add');
JToolBarHelper::custom('addrates', 'new icon-white', 'icon over', JText::_('COM_BOOPRO_MULTI_RATE_MANAGER'), false, false);
JToolbarHelper::editList('tourpackage.edit');
JToolbarHelper::divider();
JToolbarHelper::publish('tourpackages.publish', 'Publish', true);
JToolbarHelper::unpublish('tourpackages.unpublish', 'UnPublish', true);
JToolbarHelper::deleteList('', 'tourpackages.delete');
JToolBarHelper::cancel('tourpackages.cancel');


$editSubject = $this->escape(JText::_('COM_BOOKPRO_TOUR_OPTION_MANAGER'));

$itemsCount = count($this->items);
$pagination = &$this->pagination;
$listOrder	= $this->escape($this->state->get('list.ordering'));
$listDirn	= $this->escape($this->state->get('list.direction'));

?>
<script type="text/javascript">
Joomla.submitbutton = function(task)
{
	if(task=="addrates"){
		window.location.href='index.php?option=com_bookpro&view=packageratebygrid&tour_id=<?php echo $this->state->get('filter.tour_id');?>';
		}else{
			Joomla.submitform(task, document.getElementById('adminForm'));	
		}
}
</script>

<div class="span10" id="j-main-container">
	<form
		action="<?php echo 'index.php?option=com_bookpro&view=tourpackages';?>"
		method="post" name="adminForm" id="adminForm">
		<fieldset id="filter-bar">
			<div class="filter-search fltlft">
				<div class="btn-group pull-left hidden-phone fltlft">
				<?php echo $this->tours;?>
				</div>
				<div class="btn-group pull-left hidden-phone fltlft">
				<?php echo $this->packagetypes;?>
				</div>
				<div class="btn-group pull-left hidden-phone fltlft">
					<button onclick="this.form.submit();" class="btn">
					<?php echo JText::_('COM_BOOKPRO_SEARCH'); ?>
					</button>
				</div>
			</div>
			<div class="btn-group pull-right hidden-phone">
				<label for="limit" class="element-invisible"><?php echo JText::_('JFIELD_PLG_SEARCH_SEARCHLIMIT_DESC');?>
				</label>
				<?php echo $this->pagination->getLimitBox(); ?>
			</div>

		</fieldset>
		<table class="table-striped table">
			<thead>
				<tr>
					<th width="1%"><input type="checkbox" class="inputCheckbox"
						name="toggle" value="" onclick="Joomla.checkAll(this);" />
					</th>

					<th width="1%"><?php echo JHTML::_('grid.sort',JText::_('COM_BOOKPRO_STATE'), 'state', $listDirn, $listOrder); ?>
					</th>
					<th class="title" width="10%"><?php echo JHTML::_('grid.sort',JText::_('COM_BOOKPRO_TOUR_PACKAGE_NAME'), 'title', $listDirn, $listOrder); ?>
					</th>
					<th width="15%"><?php echo JText::_('COM_BOOKPRO_OPTION_TYPE'); ?>
					</th>
					<th width="15%"><?php echo JText::_('COM_BOOKPRO_PACKAGE_PAX_MIN'); ?>
					</th>
					<th width="15%"><?php echo JText::_('COM_BOOKPRO_TOUR_RATE_MANAGER'); ?>
					</th>
					
					<th width="5%" style="text-align: right;"><?php echo JHTML::_('grid.sort', 'ID', 'id', $listDirn, $listOrder); ?>
					</th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<td colspan="8"><?php echo $pagination->getListFooter(); ?>
					</td>
				</tr>
			</tfoot>
			<tbody>
			<?php if (! is_array($this->items)) { ?>
				<tr>
					<td colspan="8" class="emptyListInfo"><?php echo JText::_('No items found.'); ?>
					</td>
				</tr>
				<?php
					} else {
		
						for ($i = 0; $i < $itemsCount; $i++) {
							$subject = $this->items[$i];
							$packageRates = TourHelper::getPackageRateByTouridAndTourPackageid($this->tour->id,$subject->id);
							$link = 'index.php?option=com_bookpro&task=tourpackage.edit&id='.(int) $subject->id;
				?>
				
				<tr class="<?php if (($packageRates) ) echo "success"; else echo "warning" ?>">
					<td class="checkboxCell"><?php echo JHTML::_('grid.checkedout', $subject, $i); ?>
					</td>

					<td class="center"><?php echo JHtml::_('jgrid.published', $subject->state, $i, 'tourpackages.', true, 'cb', null, null); ?>
					</td>

					<td><a href="<?php echo $link; ?>"
						title="<?php echo $subject->title; ?>"><?php echo $subject->title; ?>
					</a>
					</td>
					<td><?php  echo $subject->packagetype_name;?>
					</td>
					<td><?php  echo $subject->min_person;?>
					</td>
					
					<td><?php $linkr = ARoute::view('packagerate',null,null,array('tourpackage_id'=>$subject->id,'tour_id'=>$this->tour->id));?>
						<a href="<?php echo $linkr;?>" title="New" class="btn btn-success">
						<?php echo JText::_('JACTION_EDIT') ?>
						
						 </a> <?php $linkrd = ARoute::view('packagerates',null,null,array('tourpackage_id'=>$subject->id,'tour_id'=>$this->tour->id));?>
					</td>
					

					<td style="text-align: right; white-space: nowrap;"><?php echo number_format($subject->id, 0, '', ' '); ?>
					</td>
				</tr>
				<?php
				}
			}
			?>
			</tbody>
		</table>

		<input type="hidden" name="option" value="<?php echo OPTION; ?>" /> <input
			type="hidden" name="task"
			value="<?php echo JRequest::getCmd('task'); ?>" /> <input
			type="hidden" name="boxchecked" value="0" /> <input type="hidden"
			name="filter_order" value="<?php echo $listOrder; ?>" /> <input
			type="hidden" name="filter_order_Dir"
			value="<?php echo $listDirn; ?>" />
			<?php echo JHTML::_('form.token'); ?>
	</form>
</div>
