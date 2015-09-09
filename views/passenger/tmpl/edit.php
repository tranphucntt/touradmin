<?php
/**
 * @package 	Bookpro
 * @author 		Ngo Van Quan
 * @link 		http://joombooking.com
 * @copyright 	Copyright (C) 2011 - 2012 Ngo Van Quan
 * @license 	GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 * @version 	$Id: bookpro.php 80 2012-08-10 09:25:35Z quannv $
 **/

// no direct access
defined('_JEXEC') or die('Restricted access');
JHtml::_('behavior.formvalidation');

// Set toolbar items for the page
$edit		= JRequest::getVar('edit', true);
$text = !$edit ? JText::_( 'New' ) : JText::_( 'Edit' );
JToolBarHelper::title(   JText::_( 'Passenger' ).': <small><small>[ ' . $text.' ]</small></small>' );
JToolBarHelper::apply('passenger.apply');
JToolBarHelper::save('passenger.save');
JToolBarHelper::cancel('passenger.cancel');
?>

<form method="post"
	action="<?php echo JRoute::_('index.php?option=com_bookpro1&layout=edit&id='.(int) $this->item->id);  ?>"
	id="adminForm" name="adminForm">
	<div class="row-fluid">
		<div class="span10 form-horizontal">
			<fieldset>

				<div class="control-group">
					<div class="control-label">
					<?php echo $this->form->getLabel('firstname'); ?>
					</div>

					<div class="controls">
					<?php echo $this->form->getInput('firstname');  ?>
					</div>
				</div>

				<div class="control-group">
					<div class="control-label">
					<?php echo $this->form->getLabel('lastname'); ?>
					</div>

					<div class="controls">
					<?php echo $this->form->getInput('lastname');  ?>
					</div>
				</div>

				<div class="control-group">
					<div class="control-label">
					<?php echo $this->form->getLabel('email'); ?>
					</div>

					<div class="controls">
					<?php echo $this->form->getInput('email');  ?>
					</div>
				</div>
				
				<div class="control-group">
					<div class="control-label">
					<?php echo $this->form->getLabel('gender'); ?>
					</div>

					<div class="controls">
					<?php echo $this->form->getInput('gender');  ?>
					</div>
				</div>

				<div class="control-group">
					<div class="control-label">
					<?php echo $this->form->getLabel('passport'); ?>
					</div>

					<div class="controls">
					<?php echo $this->form->getInput('passport');  ?>
					</div>
				</div>

				<div class="control-group">
					<div class="control-label">
					<?php echo $this->form->getLabel('ppvalid'); ?>
					</div>

					<div class="controls">
					<?php echo $this->form->getInput('ppvalid');  ?>
					</div>
				</div>

				<div class="control-group">
					<div class="control-label">
					<?php echo $this->form->getLabel('age'); ?>
					</div>

					<div class="controls">
					<?php echo $this->form->getInput('age');  ?>
					</div>
				</div>
				
				<div class="control-group">
					<div class="control-label">
					<?php echo $this->form->getLabel('birthday'); ?>
					</div>

					<div class="controls">
					<?php echo $this->form->getInput('birthday');  ?>
					</div>
				</div>


				<div class="control-group">
					<div class="control-label">
					<?php echo $this->form->getLabel('country_id'); ?>
					</div>

					<div class="controls">
					<?php echo $this->form->getInput('country_id');  ?>
					</div>
				</div>
				
				<div class="control-group">
					<div class="control-label">
					<?php echo $this->form->getLabel('notes'); ?>
					</div>

					<div class="controls">
					<?php echo $this->form->getInput('notes');  ?>
					</div>
				</div>				

			</fieldset>
		</div>
	</div>

	<input type="hidden" name="option" value="com_bookpro" /> <input
		type="hidden" name="cid[]" value="<?php echo $this->item->id ?>" /> <input
		type="hidden" name="task" value="" /> <input type="hidden" name="view"
		value="passenger" />
		<?php echo JHTML::_( 'form.token' ); ?>
</form>
