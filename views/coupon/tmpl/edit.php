<?php
defined('_JEXEC') or die;
JHtml::_('behavior.formvalidation');
JHtml::_('formbehavior.chosen', 'select');
?>
<form action="<?php echo JRoute::_('index.php?option=com_bookpro&id=' . (int) $this->item->id); ?>" method="post" id="adminForm" name="adminForm" class="form-validate">
		<div class="form-horizontal">
	
		<?php echo $this->form->renderField('title'); ?>
		<?php echo $this->form->renderField('code'); ?>
		<?php echo $this->form->renderField('subtract_type'); ?>
		<?php echo $this->form->renderField('amount');  ?>
		<?php echo $this->form->renderField('total');  ?>
		<?php echo $this->form->renderField('remain');  ?>
		<?php echo $this->form->renderField('publish_date');  ?>
		<?php echo $this->form->renderField('unpublish_date');  ?>
		<?php echo $this->form->renderField('apply_per_passenger');  ?>		
		<?php echo $this->form->renderField('state');  ?>	
		
	</div>
	<input type="hidden" name="task" value="" />
	 <?php echo JHtml::_('form.token'); ?>
	
</form>