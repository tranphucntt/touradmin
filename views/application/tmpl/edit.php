<?php
/**
 * @package 	Bookpro
 * @author 		Ngo Van Quan
 * @link 		http://joombooking.com
 * @copyright 	Copyright (C) 2011 - 2012 Ngo Van Quan
 * @license 	GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 * @version 	$Id: bookpro.php 27 2012-07-08 17:15:11Z quannv $
 **/
defined('_JEXEC') or die;
?>
<div class="row-fluid">
	<div class="span12">
		<form
			action="<?php echo JRoute::_('index.php?option=com_bookpro&layout=edit&id='.(int)$this->item->id);?>"
			method="post" name="adminForm" id="adminForm" class="form-validate">
			<div class="form-horizontal">
			<?php echo JHtml::_('bootstrap.startTabSet', 'myTab',array('active'=>'tab1'));?>
			<?php echo JHtml::_('bootstrap.addTab', 'myTab', 'tab1', JText::_('COM_BOOKPRO_BASIC_CONFIGURATION')); ?>

				<div class="control-group">
					<div class="control-label">
					<?php echo $this->form->getLabel('title'); ?>
					</div>
					<div class="controls">
					<?php echo $this->form->getInput('title'); ?>
					</div>
				</div>
				<div class="control-group">
					<div class="control-label">
					<?php echo $this->form->getLabel('code'); ?>
					</div>
					<div class="controls">
					<?php echo $this->form->getInput('code'); ?>
					</div>
				</div>
				<?php echo JHtml::_('bootstrap.endTab');?>

				<?php echo JHtml::_('bootstrap.addTab', 'myTab', 'tab2', JText::_('COM_BOOKPRO_CUSTOMER')); ?>
				<div class="control-group">
					<div class="control-label">
					<?php echo $this->form->getLabel('email_send_from'); ?>
					</div>
					<div class="controls">
					<?php echo $this->form->getInput('email_send_from'); ?>
					</div>
				</div>
				<div class="control-group">
					<div class="control-label">
					<?php echo $this->form->getLabel('email_send_from_name'); ?>
					</div>
					<div class="controls">
					<?php echo $this->form->getInput('email_send_from_name'); ?>
					</div>
				</div>
				<div class="control-group">
					<div class="control-label">
					<?php echo $this->form->getLabel('email_customer_subject'); ?>
					</div>
					<div class="controls">
					<?php echo $this->form->getInput('email_customer_subject'); ?>
					</div>
				</div>
				<div class="control-group">
					<div class="control-label">
					<?php echo $this->form->getLabel('email_customer_body'); ?>
					</div>
					<div class="controls">
					<?php echo $this->form->getInput('email_customer_body'); ?>
					</div>
				</div>
				<?php echo JHtml::_('bootstrap.endTab');?>
				<?php echo JHtml::_('bootstrap.addTab', 'myTab', 'tab3', JText::_('COM_BOOKPRO_ADMIN')); ?>

				<div class="control-group">
					<div class="control-label">
					<?php echo $this->form->getLabel('email_admin'); ?>
					</div>
					<div class="controls">
					<?php echo $this->form->getInput('email_admin'); ?>
					</div>
				</div>
				<div class="control-group">
					<div class="control-label">
					<?php echo $this->form->getLabel('email_admin_subject'); ?>
					</div>
					<div class="controls">
					<?php echo $this->form->getInput('email_admin_subject'); ?>
					</div>
				</div>
				<div class="control-group">
					<div class="control-label">
					<?php echo $this->form->getLabel('email_admin_body'); ?>
					</div>
					<div class="controls">
					<?php echo $this->form->getInput('email_admin_body'); ?>
					</div>
				</div>
				<?php echo JHtml::_('bootstrap.endTab');?>

				<?php echo JHtml::_('bootstrap.endTabSet');?>
			</div>
			<input type="hidden" name="task" value="" />
			<?php echo JHtml::_('form.token');?>
		</form>
	</div>
</div>
