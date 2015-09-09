<?php

/**
 * @package 	Bookpro
 * @author 		Ngo Van Quan
 * @link 		http://joombooking.com
 * @copyright 	Copyright (C) 2011 - 2012 Ngo Van Quan
 * @license 	GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 * @version 	$Id: view.html.php 26 2012-07-08 16:07:54Z quannv $
 **/
// No direct access to this file
defined('_JEXEC') or die('Restricted Access');
AImporter::helper('currency','paystatus');
BookProHelper::setSubmenu(1);
JToolBarHelper::custom('orders.paytatuspaid', 'publish', 'icon over', JText::_('COM_BOOKPRO_MARK_AS_PAID'), true, false);
JToolBarHelper::custom('orders.ordertatusconfimer', 'publish', 'icon over', JText::_('COM_BOOKPRO_MARK_AS_COMFIMED'), true, false);
$listOrder	= $this->escape($this->state->get('list.ordering'));
$listDirn	= $this->escape($this->state->get('list.direction'));

$itemsCount = count($this->items);
$pagination = &$this->pagination;


?>
<style>

</style>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		 var olddata;
	    $(".td_paystatus").on('focus', function () {
	       olddata = $(this).val()
	      
	    }).change(function(){		
			var value=$(this).val();
			//get name or id of a control		
			var id= $(this).attr('id').substring(9);
			var id_all= $(this).attr('id');
			//Ask user for continue
			var result1 = window.confirm('<?php echo JText::_('ARE_YOU_SURE');?>');
			
			if ( result1 == true ){
				jQuery.ajax({
					type: 'POST',
					url: "index.php?option=com_bookpro&controller=orders&task=changePayStatus",
					data: 'paystatus='+value+'&paystatus_id='+id,
					dataType: 'json',
					success : function(result) {      
					  },
				});
			}
			else{
				this.form.submit();
			}
		});
	});

	function sendEmailForCustomer($order_id)
	{
		jQuery.ajax({
			type: 'POST',
			url: "index.php?option=com_bookpro&controller=orders&task=sendEmailForCustomer",
			data: 'order_id='+$order_id,
			success : function(result) {   
				alert(result);   
			  },
		});
	} 
</script>

<script type="text/javascript">
	jQuery(document).ready(function($) {
		 var olddata;
		    $(".td_orderstatus").on('focus', function () {
		       olddata = $(this).val()
		      
		    }).change(function(){		
			var value=$(this).val();
			//get name or id of a control		
			var id= $(this).attr('id').substring(6);
			var id_all= $(this).attr('id');
			//Ask user for continue
			var result1 = window.confirm('<?php echo JText::_('ARE_YOU_SURE');?>');
			
			if ( result1 == true ){
				jQuery.ajax({
					type: 'POST',
					url: "index.php?option=com_bookpro&controller=orders&task=changeOrderstatus",
					
					data: 'orderstatus='+value+'&orderstatus_id='+id,
				 
					dataType: 'json',
					success : function(result) {   
					  },
				});
			}
			else{
				this.form.submit();
			}
		});
	});
	
</script>

<div class="span10" id="j-main-container">
	<form
		action="<?php echo JRoute::_('index.php?option=com_bookpro&view=orders');?>"
		method="post" name="adminForm" id="adminForm">
		<div class="well">
			<div class="row-fluid">
				<div class="form-inline">
				<?php echo JHtmlSelect::booleanlist('filter_date_type','class="btn-group"',$this->state->get('filter.date_type'),'Booking date','Depart date')?>

				<?php echo JHtml::calendar($this->state->get('filter.from_date'), 'filter_from_date','filter_from_date','%Y-%m-%d','for =1 placeholder="From date" style="width: 100px;"') ?>
				<?php echo JHtml::calendar($this->state->get('filter.to_date'), 'filter_to_date','filter_to_date','%Y-%m-%d','for=1 placeholder="To date" style="width: 100px;"') ?>
					<input type="text"
						placeholder="<?php echo JText::_('COM_BOOKPRO_TITLE_ORDER_SEARCH'); ?>"
						value="<?php echo $this->state->get('filter.search')?>"
						id="filter_search" name="filter_search"
						title="<?php echo JText::_('COM_BOOKPRO_TITLE_ORDER_SEARCH'); ?>">
						<?php echo $this->paystatus ?>
						<?php echo $this->orderstatus ?>

					<button onclick="this.form.submit();" class="btn">
						<i class="icon-search"></i>
					</button>
					<button type="button" class="btn hasTooltip"
						title="<?php echo JHtml::tooltipText('JSEARCH_FILTER_CLEAR'); ?>"
						onclick="
								this.form.filter_search.value='';
								this.form.filter_from_date.value='';
								this.form.filter_to_date.value='';
								this.form.filter_order_status.value='0';
								this.form.filter_pay_status.value='0';	
								this.form.submit();
						">
						<i class="icon-remove"></i>
					</button>
				</div>
			</div>
		</div>

		<div class="btn-group pull-right hidden-phone">
			<label for="limit" class="element-invisible"><?php echo JText::_('JFIELD_PLG_SEARCH_SEARCHLIMIT_DESC');?>
			</label>
			<?php echo $this->pagination->getLimitBox(); ?>
		</div>

		<table class="table-striped table">
			<thead>
				<tr>
					<th width="1%">#</th>
					<th width="2%"><input type="checkbox" class="inputCheckbox"
						name="toggle" value="" onclick="Joomla.checkAll(this);" /></th>
					<th><?php echo JText::_("COM_BOOKPRO_ORDER_NUMBER"); ?></th>
					<th><?php echo JHTML::_('grid.sort',JText::_("COM_BOOKPRO_TOUR_DEPART_DATE"), 'p.start', $listDirn, $listOrder); ?>
					</th>
					<th><?php echo JHTML::_('grid.sort',JText::_("COM_BOOKPRO_CUSTOMER"), 'firstname', $listDirn, $listOrder); ?>
					</th>
					<th><?php echo JHTML::_('grid.sort',JText::_("COM_BOOKPRO_ORDER_TOTAL"), 'total', $listDirn, $listOrder); ?>
					</th>
					<th><?php echo JHTML::_('grid.sort',JText::_("COM_BOOKPRO_ORDER_PAY_STATUS"), 'pay_status', $listDirn, $listOrder); ?>
					</th>
					<th><?php echo JHTML::_('grid.sort',JText::_("COM_BOOKPRO_STATUS"), 'order_status', $listDirn, $listOrder); ?>

					</th>
					<th><?php echo JText::_("COM_BOOKPRO_EMAIL_CUSTOMER"); ?></th>
					<th width="10%"><?php echo JHTML::_('grid.sort',JText::_("COM_BOOKPRO_ORDER_CREATED_DATE"), 'created', $listDirn, $listOrder); ?>
					</th>

				</tr>
			</thead>
			<tfoot>
				<tr>
					<td colspan="13"><?php echo $pagination->getListFooter(); ?></td>
				</tr>
			</tfoot>
			<tbody>
			<?php if ($itemsCount == 0) { ?>
				<tr>
					<td colspan="13" class="emptyListInfo"><?php echo JText::_('No reservations.'); ?>
					</td>
				</tr>
				<?php } ?>
				<?php
				if($this->items)
				foreach ($this->items AS $i => $subject) {
					$model 			= new BookProModelOrder();
					$orderComplex 	= $model->getComplexItem($subject->id);
					$orderlink= JUri::root().'index.php?option=com_bookpro&view=orderdetail&order_number='.$subject->order_number.'&email='.$subject->email;
					?>

				<tr class="row<?php echo $i % 2; ?>">
					<td style="text-align: right; white-space: nowrap;"><?php echo number_format($pagination->getRowOffset($i), 0, '', ' '); ?>
					</td>
					<td class="checkboxCell"><?php echo JHTML::_('grid.checkedout', $subject, $i); ?>
					</td>
					<td><a href="<?php echo $orderlink ?>" target="_blank"> <?php echo $subject->order_number; ?>
							<span class="icon-print"></span> </a> <br /> <label class="label">
							<?php echo JHtmlString::truncate($orderComplex->tour->title, 20,true); ?>
					</label>
					</td>
					</td>
					<td><?php echo JFactory::getDate($subject->start)->format('d-m-Y');?>
					</td>
					<td><a
						href="<?php echo 'index.php?option=com_bookpro&view=customer&layout=edit&id='.$subject->user_id; ?>">
						<?php echo $subject->firstname.' '.$subject->lastname; ?> </a> <br />
						<?php if($subject->company){?> <label class="label"><?php echo $subject->company; ?>
					</label> <?php }?>
					</td>
					<td><?php echo CurrencyHelper::formatprice($subject->total); ?></td>
					<td><?php  echo $this->td_getPayStatusSelect($subject->pay_status,'tdpayment'.$subject->id);?>
						<br /> 
						<?php 
							$params = json_decode($subject->params, true);
							if($subject->pay_method){
						?>
							<a href="javascript.void(0)" data-toggle="modal" data-target=".bs-example-modal-sm<?php echo $i;?>">
								<label class="label"><?php echo $subject->pay_method; ?> </label>
							</a>
							
							<div aria-labelledby="mySmallModalLabel" role="dialog" tabindex="-1" class="modal fade bs-example-modal-sm<?php echo $i;?>" style="display: none;">
							    <div class="modal-dialog modal-sm">
							      <div class="modal-content">
							
							        <div class="modal-header">
							          <button aria-label="Close" data-dismiss="modal" class="close" type="button"><span aria-hidden="true">x</span></button>
							          <h4 id="mySmallModalLabel" class="modal-title"><?php echo ucfirst($subject->pay_method); ?>&nbsp<?php echo JText::_('COM_BOOKPRO__INFORMATION'); ?></h4>
							        </div>
							        <div class="modal-body" >
							          <?php 
											foreach ($params['plugins'] AS $fields){
											if(is_array($fields)){?>
												<table class="table-striped table">
													<?php 
													foreach ($fields AS $key => $field){
													?> 
														<tr>
															<td>
																<?php echo ucfirst($key)?>
															</td>
															<td> 
																<?php echo $field; ?>
															</td>	
														</tr>			
													<?php } ?>
												</table>
													
											<?php }
											}
										?>
							        </div>
							      </div><!-- /.modal-content -->
							    </div><!-- /.modal-dialog -->
							</div>
						
						<?php }?>
						
						
					</td>
				
					
					<td><?php echo $this->td_getOrderStatusSelect($subject->order_status,'status'.$subject->id);?>
					</td>

					<td class="center"><input type="button"
						onclick="sendEmailForCustomer('<?php echo $subject->id;?>');"
						class="btn" value="Send" /> <?php 
						$params = json_decode($subject->params);
						if($params->relay){
							?> <a
						href="<?php echo 'index.php?option=com_bookpro&view=customercharge&order_id='.$subject->id; ?>">
							<input type="button" class="btn"
							value="<?php echo JText::_('COM_BOOKPRO_CHARGE'); ?>" /> </a> <?php }?>
					</td>

					<td><?php echo DateHelper::formatDate($subject->created); ?>
					</td>

				</tr>
				<?php } ?>
			</tbody>
		</table>

		<input type="hidden" name="task" value="" /> <input type="hidden"
			name="boxchecked" value="0" /> <input type="hidden"
			name="filter_order" value="<?php echo $listOrder; ?>" /> <input
			type="hidden" name="filter_order_Dir"
			value="<?php echo $listDirn; ?>" />
			<?php echo JHTML::_('form.token'); ?>
	</form>

</div>
