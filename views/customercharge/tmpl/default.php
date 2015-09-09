<?php
defined ( '_JEXEC' ) or die ( 'Restricted access' );
AImporter::helper('currency');
$doc = JFactory::getDocument();
$doc->addScript("http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js");
?>


<form action="<?php echo JRoute::_ ( 'index.php');?>" method="post" name="adminForm" id="adminForm" class="form-validate">
	<div class="row-fluid">
		<div class="span6">
			<div class="control-group">
				<div class="control-label"><?php echo JText::_('COM_BOOKPRO_CUSTOMER_CHARGE_NOTES')?></div>
				<div class="controls"><input class="inputbox" type="text" name="notes"/></div>
			</div> 	
			<div class="control-group">
				<div class="control-label"><?php echo JText::_('COM_BOOKPRO_CUSTOMER_CHARGE_TOTAL')?></div>
				<div class="controls"><input class="inputbox" type="text" name="total" required value="<?php echo $this->order->total?>"/></div>
			</div> 
		</div>
		<div class="span6">
		<legend><?php echo JText::_('COM_BOOKPRO_BOOKING_INFORMATION')?></legend>
		<div class="control-group">
			<div class="control-label"><?php echo JText::_('COM_BOOKPRO_ORDER_NUMBER')?></div>
			<div class="controls"><?php echo $this->order->order_number?></div>
		</div> 
		<div class="control-group">
			<div class="control-label"><?php echo JText::_('COM_BOOKPRO_ORDER_TOTAL')?></div>
			<div class="controls"><?php echo CurrencyHelper::displayPrice($this->order->total)?></div>
		</div>
		<div class="control-group">
			<div class="control-label"><?php echo JText::_('COM_BOOKPRO_ORDER_STATUS')?></div>
			<div class="controls"><?php echo JText::_('COM_BOOKPRO_ORDER_STATUS_'.$this->order->order_status)?></div>
		</div>
		<div class="control-group">
			<div class="control-label"><?php echo JText::_('COM_BOOKPRO_STATUS')?></div>
			<div class="controls"><?php echo JText::_('COM_BOOKPRO_PAYMENT_STATUS_'.$this->order->pay_status)?></div>
		</div>
		
	</div>
	</div>
	
	
	<input type="hidden" name="task" value="" />
	<input type="hidden" name="option" value="com_bookpro" /> 
	<input type="hidden" name="order_id" value="<?php echo $this->order_id;?>" />
	<?php echo JHTML::_('form.token'); ?>
</form>
