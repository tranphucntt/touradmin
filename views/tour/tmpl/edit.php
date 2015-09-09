<?php
	defined('_JEXEC') or die;
	JHtml::_('behavior.formvalidation');
	//JHtml::_('formbehavior.chosen', 'select');
	JHtml::_('jquery.framework');
$document=JFactory::$document;
$document->addScript(JUri::root().'components/com_bookpro/assets/js/bootstrap-timepicker.min.js');
$document->addStyleSheet(JUri::root().'components/com_bookpro/assets/css/bootstrap-timepicker.min.css');
	
?>
<script type="text/javascript">
	Joomla.submitbutton = function(task)
	{
		var min = new Array();
		var max = new Array();
		var i = 0;
		
		if((task == 'tour.save') || (task == 'tour.apply')){
			
			jQuery('input[name="min[]"]').each(function(){
				min[i] = jQuery(this).val();
				i++;
			});
			
			i = 0;
			jQuery('input[name="max[]"]').each(function(){
				max[i] = jQuery(this).val();
				i++;
			});

			var flag = 0;
			var check_late = 0;
					for(i = 0; i<min.length; i++){
							if((min[i]=='' && max[i]!='') || (min[i]!='' && max[i]=='')){
								flag = 1;
									break;
								}

							   if((parseFloat(check_late) > parseFloat(min[i])) || (parseFloat(max[i]) < parseFloat(min[i])) || ((parseFloat(check_late) > parseFloat(min[i])) && (parseFloat(max[i]) < parseFloat(min[i])))){
									flag = 2;
									break;
							   }
							   
							if(min[i] && max[i]){
								flag = 3;
								}
							check_late = max[i];				
						}

					var flag_packagetype = 0;
					jQuery('input[name="packagetype[title][]"]').each(function(){
						if(jQuery(this).val()!=''){
								flag_packagetype = 1;
								return false;
							}
					});
									
					if(flag==0){
						alert("<?php echo JText::_('COM_BOOKPRO_PAX_GROUP_IS_MANDATORY'); ?>");
					}else if(flag==1){
						alert("<?php echo JText::_('COM_BOOKPRO_PAX_GROUP_NOT_RIGHT_FORMAT'); ?>");
					}else if(flag==2){
						alert("<?php echo JText::_('COM_BOOKPRO_PAX_GROUP_NOT_RIGHT_FORMAT'); ?>");
					}else if(flag_packagetype==0){
						alert("<?php echo JText::_('COM_BOOKPRO_REQUIRE_ATLEAST_ONE_OPTION'); ?>");
					}else if(flag==3 && flag_packagetype==1){
						Joomla.submitform(task, document.getElementById('tour-form'));
					}
					
		}else if(task == 'tour.cancel' || document.formvalidator.isValid(document.id('tour-form'))) {
			<?php //echo $this->form->getField('description')->save(); ?>
			Joomla.submitform(task, document.getElementById('tour-form'));
		}
		
	}
</script>
<script>
jQuery(document).ready(function($) {
	$('.timepicker').timepicker({	 
		   showMeridian: false
		});
	$("#tour-form").click(function(){
		$(".timepicker").show();
		});
	
});
</script>

<form
	action="<?php echo JRoute::_('index.php?option=com_bookpro&layout=edit&id=' . (int) $this->item->id); ?>"
	method="post" name="adminForm" id="tour-form" class="form-validate">
	<div class="row-fluid">
		<div class="span9">

			<?php echo JHtml::_('bootstrap.startTabSet', 'myTab',array('active'=>'tab1'));?>
			<?php echo JHtml::_('bootstrap.addTab', 'myTab', 'tab1', JText::_('COM_BOOKPRO_BASIC')); ?>
			<div class="row-fluid form-horizontal">
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

				<div class="control-group">
					<div class="control-label">
						<?php echo $this->form->getLabel('days'); ?>
					</div>
					<div class="controls">
						<?php echo $this->form->getInput('days'); ?>
					</div>
				</div>

				<span id="duration_group">
					<div class="control-group">
						<div class="control-label">
							<?php echo $this->form->getLabel('duration'); ?>
						</div>
						<div class="controls">
							<?php echo $this->form->getInput('duration'); ?>
						</div>
					</div> 
				</span>

				<span id="nights">
					<div class="control-group">
						<div class="control-label">
							<?php echo $this->form->getLabel('nights'); ?>
						</div>
						<div class="controls">
							<?php echo $this->form->getInput('nights'); ?>
						</div>
					</div> 
				</span>
				
				<div class="control-group">
					<div class="control-label">
						<?php echo $this->form->getLabel('cat_id'); ?>
					</div>
					<div class="controls">
						<?php echo $this->form->getInput('cat_id'); ?>
					</div>
				</div>

				<div class="control-group">
					<label class="control-label" for="pickup"> <?php echo JText::_('COM_BOOKPRO_TOUR_ATTACHMENT_FILE') ?>
					</label>
					<div class="controls">
						<?php
								$this->item->table='tour';
								$this->addTemplatePath ( JPATH_COMPONENT_ADMINISTRATOR . '/views/ajaxfile/tmpl' );
								echo $this->loadTemplate ( 'file' );
				
						 //AImporter::tpl('ajaxfile', 'form', 'file', ADMIN_VIEWS); ?>
					</div>
				</div>

				<div class="control-group">
					<div class="control-label">
						<?php echo $this->form->getLabel('description'); ?>
					</div>
					<div class="controls">
						<?php echo $this->form->getInput('description'); ?>
					</div>
				</div>


				<input type="hidden" name="task" value="" />
				<?php echo JHtml::_('form.token'); ?>
			</div>

			<?php echo JHtml::_('bootstrap.endTab');?>

			<?php echo JHtml::_('bootstrap.addTab', 'myTab', 'tab2', JText::_('COM_BOOKPRO_TOUR_PACKAGE_GROUP_SETTING')); ?>

			<?php echo $this->loadTemplate('packagetype')?>

			<?php echo JHtml::_('bootstrap.endTab');?>

			<?php echo JHtml::_('bootstrap.addTab', 'myTab', 'tab3', JText::_('COM_BOOKPRO_ADDONS')); ?>

			<div class="controls">
				<?php echo $this->form->getInput('addon'); ?>
			</div>

			<?php echo JHtml::_('bootstrap.endTab');?>

			<?php echo JHtml::_('bootstrap.addTab', 'myTab', 'tab4', JText::_('COM_BOOKPRO_TOUR_TERMS_AND_CONDITIONS')); ?>

			<div class="controls">
				<?php echo $this->form->getInput('condition'); ?>
			</div>

			<?php echo JHtml::_('bootstrap.endTab');?>

			<?php echo JHtml::_('bootstrap.endTabSet');?>


		</div>
		<div class="span3">
			<?php echo JLayoutHelper::render('joomla.edit.params', $this); ?>
			<?php echo JLayoutHelper::render('joomla.edit.global', $this); ?>

			<div class="control-group">
				<div class="control-label">
					<?php echo $this->form->getLabel('addroom'); ?>
				</div>
				<div class="controls">
					<?php echo $this->form->getInput('addroom'); ?>
				</div>
			</div>

			<div class="control-group">
				<div class="control-label">
					<?php echo $this->form->getLabel('catalog'); ?>
				</div>
				<div class="controls">
					<?php echo $this->form->getInput('catalog'); ?>
				</div>
			</div>



			<div class="control-group">
				<div class="control-label">
					<?php echo $this->form->getLabel('calendar_shared_group_one_tour'); ?>
				</div>
				<div class="controls">
					<?php echo $this->form->getInput('calendar_shared_group_one_tour'); ?>
				</div>
			</div>

			<div class="control-group">
				<div class="control-label">
					<?php echo $this->form->getLabel('deposit'); ?>
				</div>
				<div class="controls">
					<?php echo $this->form->getInput('deposit'); ?>
				</div>
			</div>

			<div class="control-group">
				<label class="control-label" for="pickup"><?php echo JText::_('COM_BOOKPRO_TIME_BOOKING'); ?>
				</label>
				<div class="controls">
					<div class="input-append bootstrap-timepicker">
						<input class="input-small required timepicker" type="text"
							name="jform[time_booking]" id="time_booking"
							value="<?php echo $this->item->time_booking?>" /> <span
							class="add-on"><i class="icon-clock"></i> </span>
					</div>
				</div>
			</div>

			<div class="control-group">
				<div class="control-label">
					<?php echo $this->form->getLabel('block_booking'); ?>
				</div>
				<div class="controls">
					<?php echo $this->form->getInput('block_booking'); ?>
				</div>
			</div>

			<div class="control-group">
				<div class="control-label">
					<?php echo $this->form->getLabel('time_before_booking'); ?>
				</div>
				<div class="controls">
					<?php echo $this->form->getInput('time_before_booking'); ?>
				</div>
			</div>

			<?php echo JLayoutHelper::render('joomla.edit.metadata', $this); ?>
		</div>

	</div>
</form>
<script type="text/javascript">
	jQuery(document).ready(function(){
		StatusCapacity();
		StatusDuration();
		jQuery('[name="jform[stype]"]').click(function(){
				StatusCapacity();
			});
		
		jQuery('[name="jform[days]"]').change(function(){
			StatusDuration();
			if(jQuery(this).val()!=1){
				jQuery("#nights option[value='"+(jQuery(this).val()-1)+"']").attr('selected', 'selected');
			}
		});
	});
	
	function StatusCapacity()
	{
		jQuery('[name="jform[stype]"]').each(function(){			
			if(jQuery(this).is(':checked')){
					if(jQuery(this).val()=="shared"){
						jQuery("#capacity_group").show();
					}else{
						jQuery("#capacity_group").hide();
					}
				}
		});
	}

	function StatusDuration()
	{
		if(jQuery('[name="jform[days]"]').val()==1){
			jQuery("#duration_group").show();
			jQuery("#nights").hide();
			
		}else{
			jQuery("#duration_group").hide();
			jQuery("#nights").show();
		}	
	}	
</script>


