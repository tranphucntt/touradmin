<?php

/**
 * @package 	Bookpro
 * @author 		Ngo Van Quan
 * @link 		http://joombooking.com
 * @copyright 	Copyright (C) 2011 - 2012 Ngo Van Quan
 * @license 	GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 * @version 	$Id: view.html.php 26 2012-07-08 16:07:54Z quannv $
 **/

defined('_JEXEC') or die;
JHtml::_('behavior.formvalidation');
JHtml::_('formbehavior.chosen', 'select');
AImporter::helper('bookpro');
?>
<form action="<?php echo JRoute::_('index.php?option=com_bookpro&layout=edit&id=' . (int) $this->item->id); ?>" method="post" id="adminForm" name="adminForm" class="form-validate">

    <div class="row-fluid">
        <div class="span10 form-horizontal">
            <fieldset>
                <h3>Tour: <?php echo $this->tour->title; ?></h3>
                
                <div class="control-group">
					<div class="control-label"><?php echo $this->form->getLabel('title'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('title'); ?></div>
				</div>
				
				<div class="control-group">
					<div class="control-label"><?php echo $this->form->getLabel('path'); ?></div>
					<div class="controls">
							<?php 
								$this->addTemplatePath ( JPATH_COMPONENT_ADMINISTRATOR . '/views/media/tmpl' );
								echo $this->loadTemplate ( 'media' );
                        	?>
					</div>
				</div>
				
				<div class="control-group">
					<div class="control-label"><?php echo $this->form->getLabel('description'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('description'); ?></div>
				</div>       					
				
            </fieldset>	
        </div>
        <?php echo JLayoutHelper::render('joomla.edit.global', $this); ?>
        
    </div>

    <div>
        
        <input type="hidden" name="task" value="" /> 
         <input type="hidden" name="jform[obj_id]" value="<?php echo $this->obj_id ?>" /> 
          <input type="hidden" name="jform[type]" value="<?php echo $this->type ?>" /> 
        <?php echo JHtml::_('form.token'); ?>
    </div>
</form>