<?php

/**
 * @package 	Bookpro
 * @author 		Ngo Van Quan
 * @link 		http://joombooking.com
 * @copyright 	Copyright (C) 2011 - 2012 Ngo Van Quan
 * @license 	GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 * @version 	$Id: default.php 26 2012-07-08 16:07:54Z quannv $
 **/
defined('_JEXEC') or die('Restricted access');

JHTML::_('behavior.tooltip');

BookProHelper::setSubmenu(1);
JToolBarHelper::title(JText::_('COM_BOOKPRO_AVAILABILITY_MANAGER'), 'calendar');
AImporter::model('packagetypes','tour','avail');
AImporter::helper('tour');
//JToolBarHelper::apply();
JToolBarHelper::custom('search','search','',JText::_('COM_BOOKPRO_SEARCH'),'');
JToolBarHelper::custom('bulk','bulk','',JText::_('COM_BOOKPRO_BULK_GENERATE_AVAILABILITY_BY_DATE'),'');
JToolBarHelper::cancel();


// date
$input 			= JFactory::$application->input;
$from    		=   $input->get('from', '', 'string');
$to      		=   $input->get('to', '', 'string');
$tour_id      	=   $input->get('tour_id', '', 'int');

if(!$from && !$to){
	$from = JFactory::getDate()->format('Y-m-d');
	$todate = JFactory::getDate()->format('Y-m-d');
	$to = date('Y-m-d',strtotime($todate.'14 day'));
}elseif(!$to){
	$todate = JFactory::getDate()->format($from);
	$to = date('Y-m-d',strtotime($todate.'14 day'));
}elseif(!$from){
	$todate = JFactory::getDate()->format($to);
	$from = date('Y-m-d',strtotime($to.'-14 day'));
}
$fromdate1 = new JDate($from);
$todate1   = new JDate($to);

$fromToto =  $fromdate1->diff($todate1)->days;

//List room
$modelPackagetype 	= new BookProModelPackageTypes();
$state 	   			= $modelPackagetype->getState();
$state->set('filter.tour_id',$tour_id);
$packagetypes 	   = $modelPackagetype->getItems();

if($tour_id){
	$modelTour = new BookProModelTour();
	$tour = $modelTour->getItem($tour_id);
}
?>


<script type="text/javascript">
	Joomla.submitbutton = function(task)
	{
		var checked = true;
		var input 	= null; 
		if(task=="search"){
			 var form 		= document.adminForm;
			 var from 		= new Date(form.from.value);
			 var to 		= new Date(form.to.value);
			  
			 if (from >= to){
		            alert('<?php echo JText::_('COM_BOOKPRO_TO_DATE_MUST_BE_GREATER_THAN_FROM_DATE'); ?>');
		        }else {
			        alert("<?php echo $tour_id; ?>");
				        window.location.href='index.php?option=com_bookpro&view=avail&tour_id=<?php echo $tour_id;?>&from='+form.from.value+'&to='+form.to.value;
			 } 
			 
			}else if(task=="bulk"){
				 var form 		= document.adminForm;
				 var from 		= new Date(form.from.value);
				 var to 		= new Date(form.to.value);
				 var quantity 	= jQuery("#qtt").val();
				 
				 if (from >= to){
			            alert('<?php echo JText::_('COM_BOOKPRO_TO_DATE_MUST_BE_GREATER_THAN_FROM_DATE'); ?>');
			        }else if(!quantity){
			        	alert('<?php echo JText::_('COM_BOOKPRO_SEATS_IS_INQUIRED'); ?>');
				        }else{
					        jQuery("#typesavemulti").val('true');
					        jQuery('#adminForm').submit();
				 }
			}
	}
</script>

<div class="span10" id="j-main-container">
	<form action="index.php" method="post" name="adminForm" id="adminForm">
		<div id="editcell">
		<?php if($tour){ ?>
			<h3>
			<?php echo JText::_('COM_BOOKPRO_TOUR').': '.$tour->title; ?>
			</h3>
			<?php } ?>
			<fieldset id="filter-bar" style="margin-bottom: 10px;">
			
				<div class="filter-search fltlft form-inline">
					<div class="filter-search fltlft">
						<label for="From Airport"><?php echo JText::_('COM_BOOKPRO_FROM'); ?>:</label>
						<?php echo JHtml::calendar($from, 'from', 'from','%Y-%m-%d','readonly="readonly" class="input-small"') ?>

						<label for="To Airport"><?php echo JText::_('COM_BOOKPRO_TO'); ?>:</label>
						<?php echo JHtml::calendar($to, 'to', 'to','%Y-%m-%d','readonly="readonly" class="input-small"') ?>
					</div>
				</div>
			</fieldset>
			
			<div style="margin-bottom: 10px;">	
				<div class="form-inline">	
					<label><?php echo JText::_('COM_BOOKPRO_WEEK_DAY'); ?>:</label>
					<?php echo $this->getDayWeek('weekday[]') ?>
				</div>
			</div>
			
			<div style="margin-bottom: 10px;">
				<div class="form-inline">
						<label for="qtt"><?php echo JText::_('COM_BOOKPRO_SEATS'); ?>: </label>
						<input type="number" value="" id="qtt" name="qtt" class="input input-mini">
						<label for="qtt"><?php echo JText::_('COM_BOOKPRO_STATES'); ?>: </label>
						<?php echo AHtml::getRadioBoxForStatusFullText('stt', null, null);?>
				</div>
			</div>
			
			
			<div style="width: 100%; overflow-x: auto; margin-top: 10px; height: 400px;">
				<table cellspacing="0" cellpadding="0" border="0"
					class="table table-striped table-bordered">
					<thead class="table-bordered">
						<tr>
							<th width="50px;"></th>
							<?php
							for($i=0; $i<= $fromToto; $i++){
								$datet = date('Y-m-d',strtotime($from.$i.' day'));
								?>
							<th>
								<div
									style="width: 54px; border: 2px solid #FFFFFF; margin-left: 0 !important; margin-right: 0 !important; text-align: center; font-size: 12px;">
									<?php  echo  date('M d',strtotime($datet)); ?>
									<br>
									<?php  echo  date('Y',strtotime($datet)); ?>
								</div>
							</th>
							<?php
							}
							?>
						</tr>
					</thead>
					<?php
					if(count($packagetypes)>0){
						?>
						<?php
						foreach($packagetypes AS $j => $packagetype)
						{
							?>
					<input type="hidden" name="pkt_ids[]"
						value="<?php echo $packagetype->id; ?>" />
					<tbody class="table-bordered">
						<tr>
							<th width="50px;"><?php echo $packagetype->title; ?>
							</th>
							<?php
							for($k=0; $k<= $fromToto; $k++){
								$date = date('Y-m-d',strtotime($from.$k.' day'));
								$modelAvail = new BookProModelAvail();
								$avail = $modelAvail->getItemByPackagetypeIdAndDate($packagetype->id, $date);
								if(is_null($avail))
								{
									$avail 				= new JObject();
									$avail->quantity	= '';
									$avail->id			= '';
									$avail->status			= null;
								}

								?>
							<td class="center"><input type="text"
								style="width: 35px; height: 22px; text-align: center; margin: 1px 0 0px 0px;"
								value="<?php echo TourHelper::getTotalBookedSeat($tour_id,$date, $packagetype->id);?>" disabled="true" id="max_beds" size="7" name="max_beds">
								<br> <input type="text"
								style="width: 35px; height: 22px; text-align: center; margin: 1px 1px 1px 0px;"
								id="" name="quantity[]" value="<?php echo $avail->quantity; ?>">
								<br>
								<?php echo AHtml::getRadioBoxForStatus('status[]', null, $avail->status);?>
								<input type="hidden" name="id[]"
								value="<?php echo $avail->id;?>"> <input type="hidden"
								name="packagetype_id[]" value="<?php echo $packagetype->id; ?>">
								<input type="hidden" name="date[]" value="<?php echo $date; ?>">
							</td>
							<?php
							}
							?>
						</tr>
					</tbody>
					<?php
						}
					}
					?>
				</table>
			</div>
			
		</div>
		<div style="margin-top: 10px;">
			<strong> <?php echo JText::_('COM_BOOKPRO_NOTE');?> </strong>:
			<?php echo JText::_('COM_BOOKPRO_MAX_PERSIONS_CAN_BOOKING');?>
			<input type="text"
				style="width: 35px; height: 22px; text-align: center; margin: 1px 0 0px 0px;"
				size="7" disabled="true"> ,
				<?php echo JText::_('COM_BOOKPRO_TOUR_SEATS');?>
			<input type="text"
				style="width: 30px; height: 22px; text-align: center; margin: 1px 1px 1px 0px;"
				size="7">
				,
				<?php echo JText::_('COM_BOOKPRO_STATUS');?>:
				<?php echo JText::_('COM_BOOKPRO_O');?>(<?php echo JText::_('COM_BOOKPRO_OPEN');?>)-<?php echo JText::_('COM_BOOKPRO_C');?>(<?php echo JText::_('COM_BOOKPRO_CLOSE');?>)
		</div>

		<input type="hidden" name="option" value="<?php echo OPTION; ?>" /> <input
			type="hidden" name="task" value="apply" id="task"/> <input type="hidden"
			name="tour_id" value="<?php echo $tour_id?>" /> <input type="hidden"
			name="controller" value="avail" />
		<input type="hidden" name="typesavemulti" id="typesavemulti" value="">	
			<?php echo JHTML::_('form.token'); ?>

	</form>
</div>

