
<?php
/**
 * @package 	Bookpro
 * @author 		Ngo Van Quan
 * @link 		http://joombooking.com
 * @copyright 	Copyright (C) 2011 - 2012 Ngo Van Quan
 * @license 	GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 * @version 	$Id: bookpro.php 80 2012-08-10 09:25:35Z quannv $
 **/


// no direct access
defined('_JEXEC') or die('Restricted access');
AImporter::helper('date');

JHtml::_('bootstrap.tooltip');
JHtml::_('behavior.multiselect');
JHtml::_('dropdown.init');
JHtml::_('formbehavior.chosen', 'select');
$config	= JBFactory::getConfig();
BookProHelper::setSubmenu(1);

$listOrder 	= $this->escape ( $this->state->get ( 'list.ordering' ) );
$listDirn 	= $this->escape ( $this->state->get ( 'list.direction' ) );
?>

<div class="span10" id="j-main-container">
	<form action="<?php echo JRoute::_('index.php?option=com_bookpro&view=reports'); ?>" method="post" name="adminForm1" id="adminForm1">
		<div class="well">
			<div class="row-fluid">
				<div class="form-inline">
				<?php echo TourHelper::getToursFilter('filter_tour_id',$this->state->get('filter.tour_id'),true); ?>
				<?php echo JHtml::calendar($this->state->get('filter.depart_date'), 'filter_depart_date','filter_depart_date','%Y-%m-%d', array('placeholder'=>JText::_('COM_BOOKPRO_SYSTEM_DATE'), 'class'=>'input-small', 'readonly'=>'true')) ?>
				<?php echo $this->orderstatus ?>
					<button onclick="this.form.submit();" class="btn">
						<i class="icon-search"></i>
					</button>
					<button type="button" class="btn hasTooltip"
						title="<?php echo JHtml::tooltipText('JSEARCH_FILTER_CLEAR'); ?>"
						onclick="this.form.filter_tour_id.value=0;
								this.form.filter_depart_date.value='';
								this.form.filter_order_status.value=0;
								this.form.submit();">
						<i class="icon-remove"></i>
					</button>

				</div>
			</div>
		</div>
		<?php if($this->packagetypes){?>
		<h4>
		<?php echo JText::_('COM_BOOKPRO_PACKAGES_AND_SEATS_BOOKED');?>
		</h4>
		<div class="row-fluid">
			<table class="table table-striped">
				<thead>
					<tr>
						<th><?php echo JText::_('COM_BOOKPRO_PACKAGE_OPTIONS'); ?>
						</th>
						<th><?php echo JText::_('COM_BOOKPRO_TOUR_SEATS_BOOKED'); ?>
						</th>
						<th><?php echo JText::_('COM_BOOKPRO_MAX_PERSIONS_CAN_BOOKING'); ?>
						</th>
						<th><?php echo JText::_('COM_BOOKPRO_TOUR_SEATS'); ?>
						</th>
					</tr>
				</thead>
				<tbody>
				<?php foreach ($this->packagetypes AS $key => $packagetype){
					
					$modelPackagetype 	= new BookProModelAvail();
					$avail 				= $modelPackagetype->getItemByPackagetypeIdAndDate($packagetype->id, $this->state->get('filter.depart_date'));
				
					$seatAvail 			= TourHelper::getTotalBookedSeat($this->tour->id,$this->state->get('filter.depart_date'), $packagetype->id);
					if($avail){
					?>
					<tr>
						<td><?php echo $packagetype->title;?>
						</td>
						<td><?php echo $seatAvail;?>
						</td>
						<td><?php echo $avail->quantity - $seatAvail;?>
						</td>
						<td><?php echo $avail->quantity;?>
						</td>
					</tr>
					<?php }else{?>
						<tr>
							<td>
							</td>
							<td>
							</td>
							<td>
							</td>
							<td>
							</td>
						</tr>
					<?php }?>
					<?php }?>
				</tbody>
			</table>
		</div>

		<div class="btn-group pull-right hidden-phone">
		<?php //echo $this->pagination->getLimitBox(); ?>
		</div>

		<h4>
		<?php echo JText::_('COM_BOOKPRO_PASSENGERS');?>
		</h4>
		<table class="table table-striped">
			<thead>
				<tr>
					<th width="1%">#</th>
					<?php if ($config->get('ps_firstname', 1)){?>
					<th><?php echo JText::_('COM_BOOKPRO_PASSENGER_FIRSTNAME'); ?></th>
					<?php }?>

					<?php if ($config->get('ps_lastname', 1)){?>
					<th><?php echo JText::_('COM_BOOKPRO_PASSENGER_LASTNAME'); ?></th>
					<?php }?>

					<?php if ($config->get('ps_email', 0)){?>
					<th><?php echo JText::_('COM_BOOKPRO_PASSENGER_EMAIL'); ?></th>
					<?php }?>

					<?php if ($config->get('ps_gender', 1)){?>
					<th><?php echo JText::_('COM_BOOKPRO_PASSENGER_GENDER'); ?></th>
					<?php } ?>

					<?php if ($config->get('ps_birthday', 1)){?>
					<th><?php echo JText::_('COM_BOOKPRO_PASSENGER_BIRTHDAY');?></th>
					<?php }?>

					<?php if ($config->get('ps_passport', 1)){?>
					<th><?php echo JText::_('COM_BOOKPRO_PASSENGER_PASSPORT')?></th>
					<?php }?>

					<?php if ($config->get('ps_ppvalid', 1)){?>
					<th><?php echo JText::_('COM_BOOKPRO_PASSENGER_PASSPORT_EXPIRED');?>
					</th>
					<?php }?>

					<?php if ($config->get('ps_country', 1)){?>
					<th><?php echo JText::_('COM_BOOKPRO_PASSENGER_COUNTRY')?>
					
					</td>
					<?php }?>

					<?php if ($config->get('ps_notes', 0)){?>
					<th><?php echo JText::_('COM_BOOKPRO_PASSENGER_NOTES')?></th>
					<?php }?>

					<?php if ($config->get('ps_group', 1)){?>
					<th><?php echo JText::_('COM_BOOKPRO_PASSENGER_GROUP')?></th>
					<?php }?>

					<th><?php echo JText::_('COM_BOOKPRO_ORDER_NUMBER'); ?>
				
				</tr>
			</thead>
			<tfoot>
				<tr>
					<td colspan="11"><?php echo $this->pagination->getListFooter(); ?>
					</td>
				</tr>
			</tfoot>
			<tbody>
			<?php
			if (count($this->items)){
				foreach ($this->items as $i => $item){
					$link 		= JRoute::_( 'index.php?option=com_bookpro&view=passenger&task=passenger.edit&id='. $item->id );
					$checked 	= JHTML::_('grid.id', $i, $item->id);

					$tour=	TourHelper::getBookedTour($item->order_id);
					$orderlink= JUri::root().'index.php?option=com_bookpro&view=orderdetail&order_number='.$item->order_number.'&email='.$item->email;

					?>
				<tr class="row<?php echo $i % 2; ?>">
					<td><?php echo $i+1; ?></td>

					<?php if ($config->get('ps_firstname', 1)){?>
					<td><a href="<?php  echo $link; ?>"><?php  echo $this->escape($item->firstname); ?>
					</a></td>
					<?php }?>

					<?php if ($config->get('ps_lastname', 1)){?>
					<td><?php echo $item->lastname; ?></td>
					<?php }?>

					<?php if ($config->get('ps_email', 0)){?>
					<td><?php echo $item->email; ?></td>
					<?php }?>

					<?php if ($config->get('ps_gender', 1)){?>
					<td><?php echo BookProHelper::formatGender($item->gender); ?></td>
					<?php } ?>

					<?php if ($config->get('ps_birthday', 1)){?>
					<td><?php echo JHtml::_('date',$item->birthday,"d-m-Y"); ?></td>
					<?php }?>

					<?php if ($config->get('ps_passport', 1)){?>
					<td><?php echo $item->passport; ?></td>
					<?php }?>

					<?php if ($config->get('ps_ppvalid', 1)){?>
					<td><?php echo JHtml::_('date',$item->ppvalid,"d-m-Y"); ?></td>
					<?php }?>

					<?php if ($config->get('ps_country', 1)){?>
					<td><?php echo $item->country; ?></td>
					<?php }?>

					<?php if ($config->get('ps_notes', 0)){?>
					<td><?php echo $item->notes; ?></td>
					<?php }?>

					<?php if ($config->get('ps_group', 1)){?>
					<td><?php echo BookProHelper::formatAge($item->group_id); ?></td>
					<?php }?>
					<td><a href="<?php echo $orderlink ?>" target="_blank"> <?php echo $item->order_number; ?>
							<span class="icon-print"></span> </a> <br /> <label class="label">
							<?php echo JHtmlString::truncate($tour->title, 20,true); ?> </label>
					</td>
				</tr>
				<?php
				}
			}
			?>
			</tbody>
		</table>
		<?php }?>

		<input type="hidden" name="task" value="" /> <input type="hidden"
			name="boxchecked" value="0" /> <input type="hidden"
			name="filter_order" value="<?php echo $listOrder; ?>" /> <input
			type="hidden" name="filter_order_Dir"
			value="<?php echo $listDirn; ?>" />
			<?php echo JHtml::_('form.token'); ?>
	</form>
</div>
