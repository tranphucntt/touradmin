<?php

/**
 * @package 	Bookpro
 * @author 		Ngo Van Quan
 * @link 		http://joombooking.com
 * @copyright 	Copyright (C) 2011 - 2012 Ngo Van Quan
 * @license 	GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 * @version 	$Id: tours.php 21 2012-07-06 04:06:17Z quannv $
 **/

defined('_JEXEC') or die;
JHtml::_('behavior.formvalidation');
JHtml::_('formbehavior.chosen', 'select');
?>

<script type="text/javascript">	
		Joomla.submitbutton = function(pressbutton)
		{
			var form = document.adminForm;
			if (pressbutton == 'field.cancel') {
				Joomla.submitform(pressbutton, form);
				return;				
			} else {
				if (jQuery('input[name="jform[name]"]').val() == "") {
					alert('<?php echo JText::_('COM_BOOKPRO_ENTER_CUSTOM_FIELD_NAME'); ?>');
					form.name.focus();
					return ;
				}
				if (jQuery('input[name="jform[title]"]').val() == "") {
					alert("<?php echo JText::_("COM_BOOKPRO_ENTER_CUSTOM_FIELD_TITLE"); ?>");
					form.title.focus();
					return ; 
				}
				if (jQuery('input[name="jform[name]"]').val() == -1) {
					alert("<?php echo JText::_("COM_BOOKPRO_CHOOSE_CUSTOM_FIELD_TYPE") ; ?>");
					return ; 
				}									
				Joomla.submitform(pressbutton, form);
			}
		}											
</script>

<form action="<?php echo JRoute::_('index.php?option=com_bookpro&view=field&layout=edit&id=' . (int) $this->item->id); ?>" method="post" name="adminForm" id="adminForm" class="form-validate">
	<div class="row-fluid">
		<div class="span10 form-horizontal">
		<fieldset>	
				
			<span id="field_plan">			
				<div class="control-group">
					<div class="control-label"><?php echo JText::_('COM_BOOKPRO_FIELD_PLAN'); ?></div>
					<div class="controls"><?php echo $this->categories; ?></div>
				</div>			
			</span>
			<span id="name">			
				<div class="control-group">
					<div class="control-label"><?php echo $this->form->getLabel('name'); ?> 
					</div>
					<div class="controls"><?php echo $this->form->getInput('name'); ?>
					<?php echo JText::_('COM_BOOKPRO_PLEASE_ONLY_USE_THE_FOLOWING_CHARACTER_FOR_FIELD_NAME_A_Z_A_Z_0_9____NO_SPACE_NO_SPECIAL_CHARACTER_IN_THE_FIELD_NAME'); ?>
					
					</div>
				</div>		
			</span>
			<span id="title">				
				<div class="control-group">
					<div class="control-label"><?php echo $this->form->getLabel('title'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('title'); ?></div>
				</div>
			</span>
			<span id="fieldtype">				
				<div class="control-group">
					<div class="control-label"><?php echo JText::_('COM_BOOKPRO_FIELD_TYPE'); ?></div>
					<div class="controls"><?php echo $this->fieldtype; ?></div>
				</div>	
			</span>
			<span id="description">					
				<div class="control-group">
					<div class="control-label"><?php echo $this->form->getLabel('description'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('description'); ?></div>
				</div>
			</span>
			<span id="required">									
				<div class="control-group">
					<div class="control-label"><?php echo $this->form->getLabel('required'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('required'); ?></div>
				</div>	
			</span>
			<span id="values">						
				<div class="control-group">
					<div class="control-label"><?php echo $this->form->getLabel('values'); ?>	
					</div>
					<div class="controls"><?php echo $this->form->getInput('values'); ?>
					<?php echo JText::_('COM_BOOKPRO_EACH_ITEM_IN_ONE_LINE'); ?>
					 
					</div>
				</div>
			</span>
			<span id="default_values">							
				<div class="control-group">
					<div class="control-label"><?php echo $this->form->getLabel('default_values'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('default_values'); ?>
					<?php echo JText::_('COM_BOOKPRO_EACH_ITEM_IN_ONE_LINE'); ?>
					
					</div>
				</div>	
			</span>
			<span id="fee_field">						
				<div class="control-group">
					<div class="control-label"><?php echo $this->form->getLabel('fee_field'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('fee_field'); ?></div>
				</div>		
			</span>
			<span id="datatype_validation">				
				<div class="control-group">
					<div class="control-label"><?php echo JText::_('COM_BOOKPRO_DATATYPE_VALIDATION'); ?></div>
					<div class="controls"><?php echo $this->datatype_validation; ?></div>
				</div>
			</span>
			<span id="validation_rules">				
				<div class="control-group">
					<div class="control-label"><?php echo $this->form->getLabel('validation_rules'); ?> 
					</div>
					<div class="controls"><?php echo $this->form->getInput('validation_rules'); ?>
					<?php echo JText::_('COM_BOOKPRO_THE_VALUE_FOR_THIS_FIELD_WILL_BE_GENERATED_AUTOMATICALLY_BASED_ON_THE_DATA_VALIDATION_YOU_CHOOSE_DONT_CHANGE_IT_UNLESS_YOU_ARE_EXPERIENCED_USERS'); ?>
					
					</div>
				</div>	
			</span>
			<span id="validation_error_message">					
				<div class="control-group">
					<div class="control-label"><?php echo $this->form->getLabel('validation_error_message'); ?> 
					</div>
					<div class="controls"><?php echo $this->form->getInput('validation_error_message'); ?>
					<?php echo JText::_('COM_BOOKPRO_THE_ERROR_MESSAGE_DISPLAYED_TO_USER_IF_THE_VALIDATION_FAILED'); ?>
					
					</div>
				</div>
			</span>
			<span id="size">									
				<div class="control-group">
					<div class="control-label"><?php echo $this->form->getLabel('size'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('size'); ?></div>
				</div>		
			</span>
			<span id="css_class">				
				<div class="control-group">
					<div class="control-label"><?php echo $this->form->getLabel('css_class'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('css_class'); ?></div>
				</div>			
			</span>
			<span id="place_holder">
				<div class="control-group">
					<div class="control-label"><?php echo $this->form->getLabel('place_holder'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('place_holder'); ?></div>
				</div>		
			</span>
			<span id="max_length">
				<div class="control-group">
					<div class="control-label"><?php echo $this->form->getLabel('max_length'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('max_length'); ?></div>
				</div>
			</span>
			<span id="extra">				
				<div class="control-group">
					<div class="control-label"><?php echo $this->form->getLabel('extra'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('extra'); ?></div>
				</div>	
			</span>

			<span id="published">				
				<div class="control-group">
					<div class="control-label"><?php echo $this->form->getLabel('published'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('published'); ?></div>
				</div>	
			</span>						


			<?php echo $this->form->getInput('id'); ?>
			</fieldset>	
			</div>
			<?php //echo JLayoutHelper::render('joomla.edit.details', $this); ?>
		
	</div>
	<div>
		<input type="hidden" name="task" value="" /> 
		<input type="hidden" name="return" value="<?php echo JRequest::getCmd('return');?>" />
		<?php echo JHtml::_('form.token'); ?>
	</div>


	<script type="text/javascript">		
		(function($){
			$(document).ready(function(){				
				var validateEngine = <?php  echo BookproHelper::validateEngine(); ?>;
				$("input[name='required']").bind( "click", function() {
					validateRules();
				});
				$( "#datatype_validation" ).bind( "change", function() {
					validateRules();
				});

				$( 'select[name="jform[fieldtype]"]' ).bind( "change", function() {
						changeFiledType($(this).val());
				});
				
				changeFiledType('<?php echo $this->item->fieldtype;  ?>');
				<?php
					if($this->item->id && $this->item->fee_field)
				 	{
				?>
					$('.osm-fee-field').show();
				<?php
				 	}  
				?>
				function validateRules()
				{
					var validationString;
					if ($("input[name='name']").val() == 'email')
					{
						//Hardcode the validation rule for email
						validationString = 'validate[required,custom[email],ajax[ajaxEmailCall]]';
					}	
					else 
					{
						var validateType = parseInt($('#datatype_validation').val());
						validationString = validateEngine[validateType];
						var required = $("input[name='required']:checked").val();					
						if (required == 1)
						{
							if (validationString == '')
							{
								validationString = 'validate[required]';
							}
							else 
							{
								if (validationString.indexOf('required') == -1)
								{
									validationString = [validationString.slice(0, 9), 'required,', validationString.slice(9)].join('');
								}
							}
						}
						else 
						{						
							if (validationString == 'validate[required]')
							{
								validationString = '';
							}
							else 
							{							
								validationString = validationString.replace('validate[required', 'validate[');
							}
						}		
					}							
																					
					$("input[name='validation_rules']").val(validationString);
				}
				
				
				function changeFiledType(fieldType)
				{
					
					if(fieldType == 'List' || fieldType == 'Checkboxes' || fieldType == 'Radio' || fieldType == 'Text')
					{
						if($('input[name="jform[fee_field]"]').val() == 0)
						{
							$('#fee_field').hide();
						}
						else
						{
							$('#fee_field').show();
						}
						<?php
							if($this->item->id && $this->item->fee_field)
						 	{
						?>
							$('#fee_field').show();
						<?php
						 	}  
						?>
						$('#values').show();
					}else{
						$('#values').hide();
						}																											
				}

				//change fee field
				$('[name^=fee_field]').click(function(){
					if($(this).val() == 1)
					{
						$('tr.osm-fee-field').show();
					}						
					else
					{
						$('tr.osm-fee-field').hide();
					}						
				})
				
			});
		})(jQuery);		
		
		function checkFieldName() {
			var name = jQuery('input[name="jform[name]"]').val();
			var oldValue = name ;			
			name = name.replace('jb_', '');
			while(name.indexOf('  ') >=0)
			 	name = name.replace('  ', ' ');											
			while(name.indexOf(' ') >=0)
			 	name = name.replace(' ', '_');
		 	name = name.replace(/[^a-zA-Z0-9_]*/ig, '');
		 	jQuery('input[name="jform[name]"]').val('jb_' + name);		
		}
	</script>	
	
	</form>