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
?>
<form action="<?php echo JRoute::_ ( 'index.php?option=com_bookpro&view=itinerary&layout=edit&id=' . ( int ) $this->item->id );?>"
	method="post" name="adminForm" id="adminForm" class="form-validate">
	<div class="row-fluid">
		<div class="span10 form-horizontal">
			<fieldset>
				<div class="control-group">
					<div class="control-label"><?php echo $this->form->getLabel ( 'tour_id' );?></div>
					<div class="controls"><?php echo $this->form->getInput ( 'tour_id',null,$this->tour_id);?></div>
				</div>
				<div class="control-group">
					<div class="control-label"><?php echo $this->form->getLabel ( 'dest_id' );?></div>
					<div class="controls"><?php echo $this->form->getInput ( 'dest_id' );?></div>
				</div>
				
				<div class="control-group">
					<div class="control-label"><?php echo $this->form->getLabel ( 'title' );?></div>
					<div class="controls"><?php echo $this->form->getInput ( 'title' );?></div>
				</div>
				
				<div class="control-group">
                    <label class="control-label" for="meal"><?php echo JText::_('COM_BOOKPRO_ITINERARY_MEAL'); ?>
                    </label>
                    <div class="controls">
                        <?php echo $this->form->renderFieldset('jmeal'); ?>
                    </div>
                </div>
                
				<div class="control-group">
					<div class="control-label"><?php echo $this->form->getLabel ( 'image' );?></div>
					<div class="controls"><?php echo $this->form->getInput ( 'image' );?></div>
				</div>				
				
				<div class="control-group">
					<div class="control-label"><?php echo $this->form->getLabel ( 'desc' );?></div>
					<div class="controls"><?php echo $this->form->getInput ( 'desc' );?></div>
				</div>
				
				<div class="control-group">
					<div class="control-label"><?php echo $this->form->getLabel ( 'state' );?></div>
					<div class="controls"><?php echo $this->form->getInput ( 'state' );?></div>
				</div>
								
			<?php echo $this->form->getInput ( 'id' );?>	
			<input type="hidden" name="task" value="" />
			<?php echo JHtml::_('form.token'); ?>
			</fieldset>
		</div>
	</div>
</form>