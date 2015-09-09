<?php

/**
 * @package 	Bookpro
 * @author 		Ngo Van Quan
 * @link 		http://joombooking.com
 * @copyright 	Copyright (C) 2011 - 2012 Ngo Van Quan
 * @license 	GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 * @version 	$Id: view.html.php 26 2012-07-08 16:07:54Z quannv $
 **/
defined ( '_JEXEC' ) or die ();
JHtml::_ ( 'behavior.formvalidation' );
JHtml::_ ( 'formbehavior.chosen', 'select' );
jimport ( 'joomla.html.html.select' );
?>
<form
	action="<?php echo JRoute::_('index.php?option=com_bookpro&layout=edit&id=' . (int) $this->item->id); ?>"
	method="post" id="adminForm" name="adminForm" class="form-validate">
    <div class="row-fluid">
		<div class="span10 form-horizontal">

                
            <?php echo $this->form->renderField('title'); ?>
			<?php echo $this->form->renderField('name'); ?>
			<?php echo $this->form->renderField('symbol'); ?>
			<?php echo $this->form->renderField('display'); ?>
			<?php echo $this->form->renderField('thousand'); ?>
			<?php echo $this->form->renderField('exchange_rate');  ?>
			<?php echo $this->form->renderField('state');  ?>
				
		</div>


	</div>

		<input type="hidden" name="task" value="" /> <input type="hidden"
			name="boxchecked" value="1" />

        <?php echo JHtml::_('form.token'); ?>
    </div>
</form>

