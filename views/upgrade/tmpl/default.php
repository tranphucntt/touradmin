<?php
/**
 * @package 	Bookpro
 * @author 		Ngo Van Quan
 * @link 		http://joombooking.com
 * @copyright 	Copyright (C) 2011 - 2012 Ngo Van Quan
 * @license 	GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 * @version 	$Id: default.php 66 2012-07-31 23:46:01Z quannv $
 **/
defined('_JEXEC') or die('Restricted Access');
JHtmlBootstrap::framework();
BookProHelper::setSubmenu(1);
?>

<div class="span10" id="j-main-container">

	<form action="index.php" method="post" id="adminForm" name="adminForm">
		<input type="submit" value="Upgrade Database" class="btn btn-danger">
		<span class="text-error"> 
			<strong>
				<?php echo JText::_('COM_BOOKPRO_WARNING_UPDATE_TO_ALL')?>
			</strong> 
		</span>
		<input type="hidden" name="controller" value="upgrade" /> 
		<input type="hidden" name="option" value="com_bookpro" /> 
		<input type="hidden" name="task" value="upgrade" />
	</form>
</div>

