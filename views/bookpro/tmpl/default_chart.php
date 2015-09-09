<?php
/**
 * @package 	Bookpro
 * @author 		Ngo Van Quan
 * @link 		http://joombooking.com
 * @copyright 	Copyright (C) 2011 - 2012 Ngo Van Quan
 * @license 	GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 * @version 	$Id: default.php 66 2012-07-31 23:46:01Z quannv $
 **/
// No direct access to this file <?php echo $this->loadTemplate('config')?
defined('_JEXEC') or die('Restricted Access');
BookProHelper::setSubmenu(1);
AImporter::helper('chart');

JToolBarHelper::title(JText::_('COM_BOOKPRO_STATISTIC'),'chart');
JToolBarHelper::custom('orders.back','arrow-left','','Back',false);
JHtml::_('bootstrap.tooltip');
JHtml::_('behavior.multiselect');
JHtml::_('formbehavior.chosen', 'select');
$chartState = new JObject();
$input					= JFactory::getApplication()->input;
$chartState->range 		= $input->get('filter_range');
$chartState->chartType 	= $input->get('filter_charttype');
$chartState->fromDate 	= $input->get('filter_from_date');
$chartState->toDate 	= $input->get('filter_to_date');

?>
<script type="text/javascript">
function isDate(val) {
    var d = new Date(val);
    return !isNaN(d.valueOf());
}

jQuery(document).ready(function($) {
	
	$("#submit_chart").click(function(){
		var fromdate = $("#filter_from_date").val();
		var todate = $("#filter_to_date").val();
		
		if((fromdate != '') || (todate != '')){
			if((fromdate != '') && (todate == '')){
				$("#error_notice").html('<b style="color:red"><?php echo JText::_('COM_BOOKPRO_MISSING_TO_DATE');?>!</b>');
				return false;
				}
			
			if((fromdate == '') && (todate != '')){
				$("#error_notice").html('<b style="color:red"><?php echo JText::_('COM_BOOKPRO_MISSING_FROM_DATE');?>!</b>');
				return false;
				}
			
			if( isDate(fromdate) == false || isDate(todate) == false ){
				$("#error_notice").html('<b style="color:red"><?php echo JText::_('COM_BOOKPRO_DATE_WRONG_FORMAT');?>!</b>');
				return false;
				}
			else{
				var intfrom  = Date.parse(fromdate)/(60*60*24*1000);
				var intto  = Date.parse(todate)/(60*60*24*1000);
				var range = intto - intfrom;
				if(range < 0){
					$("#error_notice").html('<b style="color:red"><?php echo JText::_('COM_BOOKPRO_FROM_DATE_GREATER_THAN_TO_DATE');?>!</b>');
					return false;
				}
				if(range > 60){
					$("#error_notice").html('<b style="color:red"><?php echo JText::_('COM_BOOKPRO_TIME_IS_TOO_LONG');?>!</b>');
					return false;
				}
				this.form.submit();
			}
		}
		else{
			this.form.submit();
			}
	});
});


Joomla.submitbutton = function(task)
{
	if(task=='orders.back'){
		window.location.href='index.php?option=com_bookpro';
	}	
}
</script>
<div class="span10" id="j-main-container">
	<form method="post"
		action="<?php JRoute::_('index.php?option=com_bookpro')?>"
		id="adminForm" name="adminForm">

		<div class="row-fluid">
			<div class="filter-search fltlft form-inline">
			<?php echo getRangeSelect($chartState->range);?>
			<?php echo getChartTypeSelect($chartState->chartType);?>
			<?php echo JHtml::calendar($chartState->fromDate, 'filter_from_date','filter_from_date','%Y-%m-%d','for =1 placeholder="From date" readonly="true" style="width: 100px;"') ?>
			<?php echo JHtml::calendar($chartState->toDate, 'filter_to_date','filter_to_date','%Y-%m-%d','for=1 readonly="true" placeholder="To date" style="width: 100px;"') ?>

				<button class="btn btn-primary" type="submit" id="submit_chart">
					<i class="icon-bars "></i>&nbsp;
					<?php echo JText::_('COM_BOOKPRO_SHOW');?>
				</button>
				<button class="btn btn-primary" type="button"
					onclick="
			document.id('filter_from_date').value='';	
			document.id('filter_to_date').value='';
			document.id('filter_range').value='0';
			this.form.submit();">
					<i class="icon-remove "></i>&nbsp;
				</button>

			</div>
			<div class="clearfix"></div>
			<div class="row-fluid fltlft" id="statistic_chart"
				style="margin-top: 10px;" align="left">
				<div id="error_notice"></div>
				<div class="clearfix"></div>
				<div id="month_chart">
				<?php
				$chart = new ChartHelper(1,$chartState->chartType,'height:440');
				echo $chart->getRevenueChart($chartState->range, $chartState->fromDate, $chartState->toDate);
				?>
				</div>


				<div id="draw_chart" class="span12"></div>
				<div id="loading_chart" style="display: none">LOADING...</div>
			</div>
		</div>

		<input type="hidden" name="task" value="" />

	</form>
</div>
				<?php
				function getRangeSelect($selected = 'lastmonth'){

					$option[] = JHtml:: _('select.option','0', JText::_("COM_BOOKPRO_QUICK_FILTER_DATE"));
					$option[] = JHtml:: _('select.option','lastmonth', JText::_("COM_BOOKPRO_LAST_MONTH"));
					$option[] = JHtml:: _('select.option', 'lastyear', JText::_("COM_BOOKPRO_LAST_YEAR"));
					return JHtml::_('select.genericlist',$option,'filter_range','class="input input-medium"','value','text',$selected);


				}

				function getChartTypeSelect($selected = 'LineChart'){

					$option[] = JHtml:: _('select.option','LineChart', JText::_("COM_BOOKPRO_STATISTIC_LINECHART"));
					$option[] = JHtml:: _('select.option','ColumnChart', JText::_("COM_BOOKPRO_STATISTIC_COLUMNT"));
					$option[] = JHtml:: _('select.option', 'PieChart', JText::_("COM_BOOKPRO_STATISTIC_PIECHART"));
					return JHtml::_('select.genericlist',$option,'filter_charttype','class="input input-medium"','value','text',$selected);


}

?>