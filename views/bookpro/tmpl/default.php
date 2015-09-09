<?php
/**
 * @package 	Bookpro
 * @author 		Ngo Van Quan
 * @link 		http://joombooking.com
 * @copyright 	Copyright (C) 2011 - 2012 Ngo Van Quan
 * @license 	GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 * @version 	$Id: default.php 66 2012-07-31 23:46:01Z quannv $
 **/
defined('_JEXEC') or die('Restricted Access');
JHtmlBootstrap::framework();
BookProHelper::setSubmenu(1);
JToolBarHelper::title('JB TOUR');
JToolBarHelper::preferences('com_bookpro');
$itemsCount = count($this->items);
$db=JFactory::getDbo();
$query= $db->getQuery(true);
$query->select('count(*)')->from('#__bookpro_tour');
$db->setQuery($query);
$total_tour=$db->loadResult();

// total customer
$query= $db->getQuery(true);
$query->select('count(*)')->from('#__bookpro_customer');
$db->setQuery($query);
$total_customer=$db->loadResult();

//number order
$query= $db->getQuery(true);
$query->select('count(*)')->from('#__bookpro_orders');
$db->setQuery($query);
$total_booking=$db->loadResult();

//cumber customer
$query= $db->getQuery(true);
$query->select('count(*)')->from('#__bookpro_passenger');
$db->setQuery($query);
$total_passenger=$db->loadResult();
?>

<script type="text/javascript">

	var bsVersion = ( typeof jQuery.fn.typeahead !== 'undefined' ? '2.3.2' : '3.0.x' );
	console.log(bsVersion); // '3.3.4'

</script>
<div class="span10" id="j-main-container">
	<div class="row-fuild">
		<div class="lead">
			<h1 style="font-weight: normal; border-bottom: 1px #eeeeee solid;">
			<?php echo JText::_('COM_BOOKPRO_DASHBOARD'); ?>
			</h1>
		</div>

		<div class="row-fluid">
			<div class="span9">
				<div class="row-fluid">
					<div class="span12" style="background-color: #ccc; padding: 3px;">
						<div class="infobox infobox-blue infobox-dark">
							<div class="span3">
								<div class="infobox-icon">
									<img alt=""
										src="../administrator/components/com_bookpro/assets/images/about.png">
								</div>
								<div class="infobox-data">
									<span class="total-orders"><?php echo $total_tour;?> </span>
								</div>
								<div class="infobox-footer">
									<div class="infobox-content">
									<?php echo JText::_('COM_BOOKPRO_TOURS'); ?>
									</div>
								</div>
							</div>
						</div>
						<div class="infobox infobox-green infobox-dark">
							<div class="span3">
								<div class="infobox-icon">
									<img alt=""
										src="../administrator/components/com_bookpro/assets/images/people.png">
								</div>
								<div class="infobox-data">
									<span class="total-orders"><?php echo $total_customer;?> </span>
								</div>
								<div class="infobox-footer">
									<div class="infobox-content">
									<?php echo JText::_('COM_BOOKPRO_CUSTOMERS'); ?>
									</div>
								</div>
							</div>
						</div>
						<div class="infobox infobox-orange infobox-dark">
							<div class="span3">
								<div class="infobox-icon">
									<img alt=""
										src="../administrator/components/com_bookpro/assets/images/subscrip.png">
								</div>
								<div class="infobox-data">
									<span class="total-orders"><?php echo $total_booking;?> </span>
								</div>
								<div class="infobox-footer">
									<div class="infobox-content">
									<?php echo JText::_('COM_BOOKPRO_BOOKINGS'); ?>
									</div>
								</div>
							</div>
						</div>
						<div class="infobox infobox-red infobox-dark">
							<div class="span3">
								<div class="infobox-icon">
									<img alt=""
										src="../administrator/components/com_bookpro/assets/images/people.png">
								</div>
								<div class="infobox-data">
									<span class="total-orders"><?php echo $total_passenger;?> </span>
								</div>
								<div class="infobox-footer">
									<div class="infobox-content">
									<?php echo JText::_('COM_BOOKPRO_PASSENGERS'); ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="row-fluid">
					<h2 style="font-weight: normal; border-bottom: 1px #eeeeee solid;">
					<?php echo JText::_('COM_BOOKPRO_LATEST_BOOKING'); ?>
					</h2>

					<table class="table table-striped">
						<thead>
							<tr>
								<th><?php echo JText::_("#") ?></th>
								<th><?php echo JText::_("COM_BOOKPRO_CUSTOMER") ?></th>
								<th><?php echo JText::_("COM_BOOKPRO_ORDER_NUMBER"); ?></th>
								<th><?php echo JText::_("COM_BOOKPRO_ORDER_TOTAL")?></th>
								<th><?php echo JText::_("COM_BOOKPRO_ORDER_STATUS") ?></th>
								<th><?php echo JText::_("COM_BOOKPRO_ORDER_CREATED") ?></th>
							</tr>
						</thead>

						<tbody>
						<?php if ($itemsCount == 0) { ?>
							<tr>
								<td colspan="13" class="emptyListInfo"><?php echo JText::_('COM_BOOKPRO_NO_BOOKING'); ?>
								</td>
							</tr>
							<?php } ?>
							<?php 
							if($this->items)
							foreach($this->items AS $i => $subject) {
								$orderlink= JUri::root().'index.php?option=com_bookpro&view=orderdetail&order_number='.$subject->order_number.'&email='.$subject->email;
								?>

							<tr class="row<?php echo $i % 2; ?>">
								<td><?php echo ($i+1); ?>
								</td>
								<td>
									<a href="<?php echo 'index.php?option=com_bookpro&view=customer&layout=edit&id='.$subject->user_id; ?>"><?php echo $subject->firstname; ?>
									</a>
								</td>
								
								<td>
									<a href="<?php echo $orderlink ?>" target="_blank"> <?php echo $subject->order_number; ?>
										<span class="icon-print"></span> 
									</a>
								</td>
								<td><?php echo CurrencyHelper::formatprice($subject->total);?>
								</td>
								<td><?php echo OrderStatus::format($subject->order_status);	?></td>
								<td><?php echo DateHelper::formatDate($subject->created)?>
								</td>

							</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>

				<div class="row-fluid">
				<?php echo JText::_('COM_BOOKPRO_REVENUE_30_DAYS'); ?>
					<a href='index.php?option=com_bookpro&view=orders'
						class="btn-primary btn pull-right"> <?php echo JText::_('COM_BOOKPRO_MORE_BOOKING')?>
					</a> <a
						href="<?php echo JRoute::_('index.php?option=com_bookpro&view=bookpro&layout=default_chart')?>"
						class="btn-primary btn pull-right" style="margin-right: 5px;"> <i
						class="icon-chart"></i>&nbsp;<?php echo JText::_('COM_BOOKPRO_STATISTIC');?>
					</a>
				</div>
				<?php 
	AImporter::helper('chart');
	$chart = new ChartHelper(1,'LineChart','height:230,backgroundColor:"#F7F7F7",vAxis: {title: "Total '.JComponentHelper::getParams('com_bookpro')->get('currency_symbol').'"}');
	echo $chart->getRevenueChart('lastmonth');
?>
			</div>
			<div class="span3">
				<?php echo $this->loadTemplate('config')?>
			</div>

		</div>
	</div>