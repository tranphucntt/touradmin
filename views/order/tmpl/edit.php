<?php

/**
 * @package 	Bookpro
 * @author 		Ngo Van Quan
 * @link 		http://joombooking.com
 * @copyright 	Copyright (C) 2011 - 2012 Ngo Van Quan
 * @license 	GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 * @version 	$Id: form.php 105 2012-08-30 13:20:09Z quannv $
 **/
defined('_JEXEC') or die('Restricted access');

JHtml::_('behavior.formvalidation');
JHtml::_('jquery.framework');
?>

<form
	action="<?php echo JRoute::_('index.php?option=com_bookpro&view=order&layout=edit&id='.(int)$this->item->id);?>"
	method="post" name="adminForm" id="adminForm" class="form-validate">
	<div class="row-fluid">
		<div class="form-horizontal">
				<div class="control-group">
					<div class="control-label">
					<?php echo $this->form->getLabel('order_number');?>
					</div>
					<div class="controls">
					<?php echo $this->form->getInput('order_number');?>
					</div>
				</div>


				<div class="control-group">
					<div class="control-label">
					<?php echo $this->form->getLabel('pay_status');?>
					</div>
					<div class="controls">
					<?php echo $this->form->getInput('pay_status');?>
					</div>
				</div>

				<div class="control-group">
					<label class="control-label" for="paymethod"><?php echo $this->form->getLabel('pay_method');?>
					</label>
					<div class="controls">
					<?php echo $this->form->getInput('pay_method');?>
					</div>
				</div>

				<div class="control-group">
					<div class="control-label">
					<?php echo $this->form->getLabel('order_status');?>
					</div>
					<div class="controls">
					<?php echo $this->form->getInput('order_status');?>
					</div>
				</div>

				<!-- 	
				<div class="control-group">
						<div class="control-label"><?php //echo $this->form->getLabel('notify_customer');?></div>
						<div class="controls"><?php //echo $this->form->getInput('notify_customer');?></div>
				</div>	
			 -->

				<div class="control-group">
					<div class="control-label">
					<?php echo $this->form->getLabel('total');?>
					</div>
					<div class="controls">
					<?php echo $this->form->getInput('total');?>
					</div>
				</div>

				<div class="control-group">
					<div class="control-label">
					<?php echo $this->form->getLabel('discount');?>
					</div>
					<div class="controls">
					<?php echo $this->form->getInput('discount');?>
					</div>
				</div>

				<div class="control-group">
					<div class="control-label">
					<?php echo $this->form->getLabel('tx_id');?>
					</div>
					<div class="controls">
					<?php echo $this->form->getInput('tx_id');?>
					</div>
				</div>

				<div class="control-group">
					<div class="control-label">
					<?php echo $this->form->getLabel('deposit');?>
					</div>
					<div class="controls">
					<?php echo $this->form->getInput('deposit');?>
					</div>
				</div>

				<div class="control-group">
					<div class="control-label">
					<?php echo $this->form->getLabel('notes');?>
					</div>
					<div class="controls">
					<?php echo $this->form->getInput('notes');?>
					</div>
				</div>
		</div>

	
	<input type="hidden" name="task" value="" />
	<input type="hidden" name="jform[user_id]" value="<?php echo $this->item->user_id?>" />
					
					<?php echo JHTML::_('form.token'); ?>
	</div>
</form>
