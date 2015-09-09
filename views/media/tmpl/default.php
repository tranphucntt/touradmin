<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_media
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JHtml::_('formbehavior.chosen', 'select');

// Load tooltip instance without HTML support because we have a HTML tag in the tip
JHtml::_('bootstrap.tooltip', '.noHtmlTip', array('html' => false));

$user  = JFactory::getUser();
$input = JFactory::getApplication()->input;
?>

<script type='text/javascript'>
var image_base_path = '<?php $params = JComponentHelper::getParams('com_media');
echo $params->get('image_path', 'images'); ?>/';
</script>
<form action="index.php?option=com_bookpro&view=media&amp;tmpl=component&amp;asset=<?php echo $input->getCmd('asset');?>&amp;author=<?php echo $input->getCmd('author'); ?>&numberId=<?php echo $this->numberId?>" class="form-vertical" id="imageForm" method="post" enctype="multipart/form-data">
	<div id="messages" style="display: none;">
		<span id="message"></span><?php echo JHtml::_('image', 'media/dots.gif', '...', array('width' => 22, 'height' => 12), true) ?>
	</div>
	<div class="well">
		<div class="row row-fluid">
				 <div class="" style="width:60%; float:left;">
					<div class="control-group">
						<div class="control-label">
							<label class="control-label" for="folder"><?php echo JText::_('COM_BOOKPRO_MEDIA_DIRECTORY') ?></label>
						</div>
						<div class="controls">
							<?php echo $this->folderList; ?>
							<button class="btn" type="button" id="upbutton" title="<?php echo JText::_('COM_BOOKPRO_MEDIA_DIRECTORY_UP') ?>"><?php echo JText::_('COM_BOOKPRO_MEDIA_MEDIA_UP') ?></button>
						</div>
					</div>
					
					<div control-group">
						<div class="control-label">
							<label class="control-label" for="folder"><?php echo JText::_('COM_BOOKPRO_MEDIA_NEW_DIRECTORY') ?></label>
						</div>
						<div class="controls">
							<input type="text" name="dirname" id="dirname" value="">
							<input type="submit" value="<?php echo JText::_('COM_BOOKPRO_MEDIA_OK');?>" class="btn" style="margin-bottom:10px;"/>
						</div>
					</div>
				</div>
				<div class="" style="width:40%; float:left;">	
					<div class="pull-right">
						<button class="btn btn-primary" type="button" onclick="window.parent.jInsertFieldValue(document.id('f_url').value,'jform_path<?php echo $this->numberId;?>');window.parent.SqueezeBox.close();"><?php echo JText::_('COM_BOOKPRO_MEDIA_INSERT') ?></button>
						<button class="btn" type="button" onclick="window.parent.SqueezeBox.close();"><?php echo JText::_('COM_BOOKPRO_MEDIA_CANCEL') ?></button>
					</div>
				</div>	
		</div>
	</div>
	<iframe id="imageframe" name="imageframe" src="index.php?option=com_media&amp;view=imagesList&amp;tmpl=component&amp;folder=<?php echo $this->folderlist?>&amp;asset=<?php echo $input->getCmd('asset');?>&amp;author=<?php echo $input->getCmd('author');?>"></iframe>
	
	<div class="well">
		<div class="row">
			<div class="span6 control-group">
				<div class="control-label">
					<label for="f_url"><?php echo JText::_('COM_BOOKPRO_MEDIA_IMAGE_URL') ?></label>
				</div>
				<div class="controls">
					<input type="text" id="f_url" value="" />
				</div>
			</div>
		</div>
		<input type="hidden" id="dirPath" name="dirPath" />
		<input type="hidden" id="f_file" name="f_file" />
		<input type="hidden" id="tmpl" name="component" />
		<input type="hidden" id="numberId" name="numberId" value="<?php echo $this->numberId;?>"/>
		
	</div>
</form>


	<form action="<?php echo JUri::base(); ?>index.php?option=com_media&amp;task=file.upload&amp;tmpl=component&amp;<?php echo $this->session->getName() . '=' . $this->session->getId(); ?>&amp;<?php echo JSession::getFormToken();?>=1&amp;asset=<?php echo $input->getCmd('asset');?>&amp;author=<?php echo $input->getCmd('author');?>&amp;view=images.&numberId=<?php echo $this->numberId?>" id="uploadForm" class="form-horizontal" name="uploadForm" method="post" enctype="multipart/form-data">
		<div id="uploadform" class="well">
			<fieldset id="upload-noflash" class="actions">
				<div class="control-group">
					<div class="control-label">
						<label for="upload-file" class="control-label"><?php echo JText::_('COM_BOOKPRO_MEDIA_UPLOAD_FILE'); ?></label>
					</div>
					<div class="controls">
						<input type="file" id="upload-file" name="Filedata[]" multiple /><button class="btn btn-primary" id="upload-submit"><i class="icon-upload icon-white"></i> <?php echo JText::_('COM_BOOKPRO_MEDIA_START_UPLOAD'); ?></button>
						<p class="help-block"><?php echo $this->config->get('upload_maxsize') == '0' ? JText::_('COM_MEDIA_UPLOAD_FILES_NOLIMIT') : JText::sprintf('COM_BOOKPRO_MEDIA_UPLOAD_FILES', $this->config->get('upload_maxsize', 10)); ?></p>
					</div>
				</div>
			</fieldset>
			<?php JFactory::getSession()->set('com_media.return_url', 'index.php?option=com_bookpro&view=media&tmpl=component&folderCheck='.$this->folderCheck.'&folderlist='.$this->folderlist.'&fieldid=' . $input->getCmd('fieldid', '') . '&e_name=' . $input->getCmd('e_name') . '&asset=' . $input->getCmd('asset') . '&author=' . $input->getCmd('author')).'&numberId='.$this->numberId; ?>
		</div>
	</form>

