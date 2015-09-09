<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_bookpro
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access
defined('_JEXEC') or die;
JHtml::addIncludePath(JPATH_COMPONENT . '/helpers/html');
//JHtml::_('behavior.formvalidator');
JHtml::_('formbehavior.chosen', 'select#jform_hotel_id');
?>
<script type="text/javascript">
    jQuery(document).ready(function($){

	function loadajax($hotel_id,$obj_id) {
		var hotel_id = $hotel_id;
		var obj_id = $obj_id;
		var check = '#jform_obj_id option[value="'+obj_id+'"]';
		//console.log(check);
		 jQuery.ajax({
             'type': 'post',
             'data': 'hotel_id='+hotel_id,   
             'url': 'index.php?option=com_bookpro&controller=comment&task=selectpackageadmin&tmpl=component&format=raw',
             success: function(data){
                 jQuery("#jform_obj_id").html(data);
				if(obj_id) { jQuery(check).attr('selected','selected'); }
             } 
 		});
	}

	var obj_id = jQuery('#jform_obj_id option:selected').val();
	var hotel_id = jQuery('#jform_hotel_id option:selected').val();
	
	loadajax(hotel_id,obj_id);

    jQuery('#jform_hotel_id').on('change',function(){
                var hotel_id = jQuery(this).val();
                loadajax(hotel_id);
                
        return false;
      });
});

</script>
<form action="<?php echo JRoute::_('index.php?option=com_bookpro&layout=edit&id=' . (int) $this->item->id); ?>"
    method="post" name="adminForm" id="adminForm">
    <div class="form-horizontal">
		<div class="row-fluid">
			<div class="span9">
                <div id="title">
					<?php echo $this->form->renderField('title'); ?>
				</div>
				<?php echo $this->form->renderField('comment');
                        echo $this->form->renderField('obj_id');
                        echo $this->form->renderField('ratings');
                        echo $this->form->renderField('anonymous');  
                 ?>
				<div id="custom">
					<?php echo $this->form->renderField('name'); ?>
					<?php echo $this->form->renderField('address'); ?>
				</div>
				<?php
				   echo $this->form->renderField('email');
				   echo $this->form->renderField('created_by');
				?>
				<?php echo JLayoutHelper::render('joomla.edit.global', $this);?>
			</div>
			<div class="span3">
				
				
			</div> 
		</div>
     </div>   
     <input type="hidden" name="task" value="comment.edit" />
    <?php echo JHtml::_('form.token'); ?>
</form>    
