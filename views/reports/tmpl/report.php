<?php
/**
 * @package 	Bookpro
 * @author 		Ngo Van Quan
 * @link 		http://joombooking.com
 * @copyright 	Copyright (C) 2011 - 2012 Ngo Van Quan
 * @license 	GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 * @version 	$Id: default.php 81 2012-08-11 01:16:36Z quannv $
 **/
defined ( '_JEXEC' ) or die ( 'Restricted access' );


AImporter::helper ( 'currency', 'bookpro', 'date' );

	$itemsCount = count ( $this->items );
	$date 		= $this->state->get ( 'filter.depart_date' );
	$tour_id 	= $this->state->get('filter.tour_id');
	$search		= $this->state->get('filter.search');
	
	$params = JComponentHelper::getParams ( 'com_bookpro' );
	$input = JFactory::getApplication ()->input;
	$company_name = $params->get ( 'company_name' );
	$logo = $params->get ( 'company_logo' );
	$address = $params->get ( 'company_address' );
	echo '<script type="text/javascript">window.onload = function() { window.print(); }</script>';
?>
<div style="width: 680px;" class="container">
	<table style="text-align: left; width: 100%;">
		<tr>
			<td style="border: none; width: 30%;"><img
				src="<?php echo JUri::root().$logo; ?>" style="width: 150px;"></td>
			<td style="border: none; width: 20%;"><?php echo $company_name; ?><br />
			<?php echo $address; ?>
			</td>
			<td style="border: none; width: 50%; text-align: right;">
				<?php if($date){?>	
				 	<?php echo JText::sprintf('COM_BOOKPRO_DATE_SPRINTF',JFactory::getDate($date)->format('d-m-Y'))?><br />
				<?php }?>

				<?php if($tour_id){
					AImporter::model('tour');
					$tourModel 	= new BookProModelTour();
					$tour 		= $tourModel->getItem($tour_id);
				?>	
				 	<?php echo JText::_('COM_BOOKPRO_TOUR').':'.$tour->title;?><br />
				<?php }?>

				<?php if($search){?>	
				 	<?php echo JText::_('COM_BOOKPRO_TITLE').':'.$search;?><br />
				<?php }?>
				 	
			</td>
		</tr>

	</table>

	<hr />

	<h2>
	<?php echo JText::_('COM_BOOKPRO_PASSENGERS') ?>
	</h2>


	<table class="table table-bordered" cellpadding="5" border="1">
		<thead>
			<tr>
					<th width="1%"><?php echo JText::_('#');?></th>
					
				<?php if ($params->get('ps_firstname', 1)){?>	
					<th><?php echo  JText::_('COM_BOOKPRO_PASSENGER_FIRSTNAME') ?></th>
				<?php }?>
				
				<?php if ($params->get('ps_lastname', 1)){?>
					<th><?php echo JText::_('COM_BOOKPRO_PASSENGER_LASTNAME'); ?></th>
				<?php }?>

				<?php if ($params->get('ps_email', 0)){?>
					<th><?php echo JText::_('COM_BOOKPRO_PASSENGER_EMAIL'); ?></th>
				<?php }?>
								
				<?php if($params->get('ps_gender')){?>
					<th><?php echo JText::_('COM_BOOKPRO_PASSENGER_GENDER')?></th>
				<?php } ?>
				
				<?php if($params->get('ps_birthday')){?>
					<th><?php echo JText::_('COM_BOOKPRO_PASSENGER_BIRTHDAY'); ?></th>
				<?php } ?>

				<?php if($params->get('ps_passport')){?>
					<th><?php echo JText::_('COM_BOOKPRO_PASSENGER_PASSPORT'); ?></th>
				<?php } ?>

				<?php if($params->get('ps_ppvalid')){?>
					<th><?php echo JText::_('COM_BOOKPRO_PASSENGER_PASSPORT_EXPIRED'); ?></th>
				<?php } ?>
				
				<?php if ($params->get('ps_country', 1)){?>
					<th><?php echo JText::_('COM_BOOKPRO_PASSENGER_COUNTRY'); ?></th>
				<?php }?>
				
				<?php if ($params->get('ps_notes', 0)){?>
					<th><?php echo JText::_('COM_BOOKPRO_PASSENGER_NOTES'); ?></th>
				<?php }?>
								
				<?php if ($params->get('ps_group', 1)){?>
					<th><?php echo JText::_('COM_BOOKPRO_PASSENGER_GROUP') ?></th>
				<?php }?>	
				
					<th><?php echo JText::_('COM_BOOKPRO_ORDER_NUMBER')?></th>
				
			</tr>
		</thead>

		<tbody>
		<?php

		for($i = 0; $i < $itemsCount; $i ++) {
			$subject = &$this->items [$i];
			?>
			<tr>
				<td width="2%"><?php echo $i+1;?></td>
				
				<?php if ($params->get('ps_firstname', 1)){?>
					<td><?php echo $subject->firstname; ?></td>
				<?php }?>
				<?php if ($params->get('ps_lastname', 1)){?>	
					<td><?php  echo $subject->lastname;?></td>
				<?php }?>
				<?php if ($params->get('ps_email', 1)){?>	
					<td><?php  echo $subject->email;?></td>
				<?php }?>				
				<?php if($params->get('ps_gender')){?>
					<td><?php echo BookProHelper::formatGender($subject->gender) ?></td>
				<?php }?>
				<?php if($params->get('ps_birthday')){?>
					<td><?php echo JHtml::_('date',$subject->birthday,"d-m-Y"); ?></td>
				<?php } ?>

				<?php if($params->get('ps_passport')){?>
					<td><?php echo $subject->passport; ?></td>
				<?php } ?>

				<?php if($params->get('ps_ppvalid')){?>
					<td><?php echo JHtml::_('date',$subject->ppvalid,"d-m-Y"); ?></td>
				<?php } ?>
				
				<?php if ($params->get('ps_country', 1)){?>
					<td><?php echo $subject->country;?></td>
				<?php }?>
				
				<?php if ($params->get('ps_notes', 0)){?>
					<td><?php echo $subject->notes;?></td>
				<?php }?>
									
				<?php if ($params->get('ps_group', 1)){?>
					<td><?php echo BookProHelper::formatAge($subject->group_id); ?></td>
				<?php }?>

				<td><?php echo $subject->order_number; ?><br>
				</td>
			</tr>
			<?php
		}

		?>
		</tbody>
	</table>
</div>
