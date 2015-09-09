<?php
defined('_JEXEC') or die;
JHtml::_('behavior.formvalidation');
JHtml::_('formbehavior.chosen', 'select');
?>
<form action="<?php echo JRoute::_('index.php?option=com_bookpro&id=' . (int) $this->item->id); ?>" method="post" id="adminForm" name="adminForm" class="form-validate">
		<div class="form-horizontal">
	
		<?php echo $this->form->renderField('title'); ?>
		<?php echo $this->form->renderField('max_person'); ?>
		<?php echo $this->form->renderField('desc'); ?>
		<?php echo $this->form->renderField('state');  ?>	
	</div>
	<input type="hidden" name="task" value="" />
	 <?php echo JHtml::_('form.token'); ?>
	
</form>