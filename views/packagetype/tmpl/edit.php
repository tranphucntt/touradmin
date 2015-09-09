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

<form action="<?php echo JRoute::_('index.php?option=com_bookpro&layout=edit&id='.(int)$this->item->id);?>" method="post" name="adminForm" id="adminForm" class="form-validate">
	<div class="row-fluid">
		<div class="span10 form-horizontal">
				<div class="control-group">
					<div class="control-label"><?php echo $this->form->getLabel('title'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('title'); ?></div>
				</div> 	
				<div class="control-group">
					<div class="control-label"><?php echo $this->form->getLabel('state'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('state'); ?></div>
				</div> 	
				<div class="control-group">
					<div class="control-label"><?php echo $this->form->getLabel('desc'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('desc'); ?></div>
				</div> 												
			<input type="hidden" name="task" value="" />				
			<?php echo JHtml::_('form.token');?>				
		</div>
	</div>
</form>