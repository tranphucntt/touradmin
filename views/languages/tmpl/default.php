<?php
/**
 * Support for work with request params.
 *
 * @package Bookpro
 * @author Ngo Van Quan
 * @link http://joombooking.com
 * @copyright Copyright (C) 2011 - 2012 Ngo Van Quan
 * @license 	GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 * @version $Id: request.php 44 2012-07-12 08:05:38Z quannv $
 */
defined ( '_JEXEC' ) or die ();
BookProHelper::setSubmenu (1);
JToolBarHelper::title(JText::_('Manager Language'), 'user.png');
jimport('joomla.filesystem.folder');
$administratorArray = array(
									'en-GB.com_bookpro.ini'=>'en-GB.com_bookpro.ini',
									'en-GB.com_bookpro.sys.ini'=>'en-GB.com_bookpro.sys.ini',
);

$siteArray          = array(
									'en-GB.com_bookpro.ini'=>'en-GB.com_bookpro.ini',
									'en-GB.mod_bookpro_tour.ini'=>'en-GB.mod_bookpro_tour.ini',
									'en-GB.mod_bookpro_travel_search.ini'=>'en-GB.mod_bookpro_travel_search.ini',
);
						  	

$folder					= JPATH_SITE .DS."language".DS."en-GB";
$itemsSite = JFolder::files($folder);

$folderadministrator	= JPATH_ADMINISTRATOR .DS."language".DS."en-GB";
$itemsAdministrator = JFolder::files($folderadministrator);
$stt=1;

?>
<div id="j-main-container" class="span10">
<form
	action="<?php echo JRoute::_('index.php?option=com_bookpro&view=languages'); ?>"
	method="post" name="adminForm" id="adminForm">

			<table class="table-striped table">
				<thead>
					<tr>
						<th width="" class="center"><?php echo JText::_('#'); ?>
						</th>
						
						<th width="" class="center"><?php echo JText::_('File name'); ?>
						</th>

						<th width="" class="center"><?php echo JText::_('Type'); ?>
						</th>

					</tr>
				</thead>
				<tbody>
				<?php  foreach ( $itemsSite as $i => $item ) { ?>
					  <?php if(in_array($item , $siteArray)){ ?>	
							<tr class="row<?php echo $i % 2; ?>">
								<td class="center"><?php echo $stt; $stt++?></td>
								<td class="center">
									<a href="index.php?option=com_bookpro&view=language&filename=<?php echo $item;?>&type=SITE">
										<?php echo $item; ?>
									</a>	
								</td>
								<td class="center">
									<?php echo JText::_('SITE'); ?>
								</td>
							</tr>
						<?php }?>	
				<?php } ?>
				
				<?php  foreach ( $itemsAdministrator as $i => $item ) { ?>
					  <?php if(in_array($item , $administratorArray)){ ?>	
							<tr class="row<?php echo $i % 2; ?>">
								<td class="center"><?php echo $stt; $stt++?></td>
								<td class="center">
									<a href="index.php?option=com_bookpro&view=language&filename=<?php echo $item;?>&type=ADMINISTRATOR">
										<?php echo $item; ?>
									</a>	
								</td>
								<td class="center">
									<?php echo JText::_('ADMINISTRATOR'); ?>
								</td>
							</tr>
						<?php }?>	
				<?php } ?>
				
				</tbody>
			</table>
</form>
</div>