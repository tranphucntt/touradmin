<?php
defined ( '_JEXEC' ) or die ( 'Restricted access' );

/* @var $this BookingViewCustomer */
$customer_span=12;
if($this->item->user){
	$customer_span = 9; 
}
?>

<form action="<?php echo JRoute::_ ( 'index.php?option=com_bookpro&layout=edit&id=' . ( int ) $this->item->id );?>" method="post" name="adminForm" id="adminForm" class="form-validate">	
<div class="row-fluid">
	<div class="span<?php echo $customer_span; ?>">
		<?php echo JHtml::_('bootstrap.startTabSet', 'myTab',array('active'=>'tab1'));?> 
		<?php echo JHtml::_('bootstrap.addTab', 'myTab', 'tab1', JText::_('Details')); ?> 	
		    <div class="form-horizontal">
		    	
				<div class="control-group">
					<div class="control-label"><?php echo $this->form->getLabel('user'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('user'); ?></div>
				</div>		        
		       
				<div class="control-group">
					<div class="control-label"><?php echo $this->form->getLabel('firstname'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('firstname'); ?></div>
				</div> 	
				<div class="control-group">
					<div class="control-label"><?php echo $this->form->getLabel('lastname'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('lastname'); ?></div>
				</div> 	
				<div class="control-group">
					<div class="control-label"><?php echo $this->form->getLabel('company'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('company'); ?></div>
				</div> 					
				<div class="control-group">
					<div class="control-label"><?php echo $this->form->getLabel('birthday'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('birthday'); ?></div>
				</div> 
				<div class="control-group">
					<div class="control-label"><?php echo $this->form->getLabel('email'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('email'); ?></div>
				</div> 	
				<div class="control-group">
					<div class="control-label"><?php echo $this->form->getLabel('gender'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('gender'); ?></div>
				</div> 	
				<div class="control-group">
					<div class="control-label"><?php echo $this->form->getLabel('state'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('state'); ?></div>
				</div> 								
			</div>
		    	<?php echo JHtml::_('bootstrap.endTab');?> 	
		      		<?php echo JHtml::_('bootstrap.addTab', 'myTab', 'tab3', JText::_('Contact')); ?>   
		    <div class="form-horizontal">
					
				<div class="control-group">
					<div class="control-label"><?php echo $this->form->getLabel('phone'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('phone'); ?></div>
				</div> 	
				<div class="control-group">
					<div class="control-label"><?php echo $this->form->getLabel('address'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('address'); ?></div>
				</div> 	
				<div class="control-group">
					<div class="control-label"><?php echo $this->form->getLabel('city'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('city'); ?></div>
				</div> 
				<div class="control-group">
					<div class="control-label"><?php echo $this->form->getLabel('telephone'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('telephone'); ?></div>
				</div> 	
				<div class="control-group">
					<div class="control-label"><?php echo $this->form->getLabel('mobile'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('mobile'); ?></div>
				</div> 	
				<div class="control-group">
					<div class="control-label"><?php echo $this->form->getLabel('fax'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('fax'); ?></div>
				</div> 
				<div class="control-group">
					<div class="control-label"><?php echo $this->form->getLabel('states'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('states'); ?></div>
				</div> 	
				<div class="control-group">
					<div class="control-label"><?php echo $this->form->getLabel('zip'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('zip'); ?></div>
				</div> 	
				<div class="control-group">
					<div class="control-label"><?php echo $this->form->getLabel('country_id'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('country_id'); ?></div>
				</div> 													
			</div>
		    	<?php echo JHtml::_('bootstrap.endTab');?>     	
		    	<?php echo JHtml::_('bootstrap.endTabSet');?>   	
				<input type="hidden" name="task" value="save" /> 
			<?php echo JHTML::_('form.token'); ?>
	
</div>
<?php if($this->item->user){?>
	<div class="span3">
			    <div class="" style="margin-top: 50px;">
				<div class="control-group">
					<div class="control-label"><?php echo $this->form->getLabel('discount'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('discount'); ?></div>
				</div> 						
				</div>			
			    <div class="" >
				<div class="control-group ">
							<div class="control-label">
									<label>
										<?php echo JText::_('COM_BOOKPRO_MONTH_IS_ORDERS')?>
									</label>
									</div>
									<div class="controls">
											<a class="btn btn-success" href="<?php echo 'index.php?option=com_bookpro&view=agentpage&id='.$this->item->id; ?>" target="_blank">
												<?php echo JText::_('COM_BOOKPRO_MONTH_IS_ORDERS')?>
											</a>							
								</div>
						</div>
				</div>					
	</div>
<?php }?>	
</div>	
</form>
