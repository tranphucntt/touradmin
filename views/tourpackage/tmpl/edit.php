<?php
defined('_JEXEC') or die;
JHtml::_('behavior.formvalidation');
JHtml::_('formbehavior.chosen', 'select');
?>
<form action="<?php echo JRoute::_('index.php?option=com_bookpro&id=' . (int) $this->item->id); ?>" method="post" id="adminForm" name="adminForm" class="form-validate">
		<div class="form-horizontal">
	
		<div class="control-group">
			<label class="control-label" for="tours"><?php echo JText::_('COM_BOOKPRO_TOUR'); ?></label>
			<div class="controls">
				<?php echo $this -> tours; ?>
			</div>
		</div>

		<div class="control-group">
			<label class="control-label" for="packagetypes"><?php echo JText::_('COM_BOOKPRO_OPTION_TYPE'); ?></label>
			<div class="controls">
				<?php echo $this -> packagetypes; ?>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="tourgroups"><?php echo JText::_('COM_BOOKPRO_PACKAGE_PAX_MIN'); ?></label>
			<div class="controls">
				<?php echo $this->tourgroups; ?>
			</div>
		</div>
		<?php echo $this->form->renderField('group_price'); ?>		
		<?php //echo $this->form->renderField('roomtype_id'); ?>
		<?php echo $this->form->renderField('title'); ?>
		<?php echo $this->form->renderField('desc'); ?>
		<?php echo $this->form->renderField('state');  ?>	
	</div>
	<input type="hidden" name="task" value="" />
	 <?php echo JHtml::_('form.token'); ?>
	
</form>