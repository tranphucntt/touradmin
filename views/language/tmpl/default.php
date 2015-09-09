<?php
/**
 * @package 	Bookpro
 * @author 		Ngo Van Quan
 * @link 		http://joombooking.com
 * @copyright 	Copyright (C) 2011 - 2012 Ngo Van Quan
 * @license 	GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 * @version 	$Id: default.php 91 2012-08-24 16:29:55Z quannv $
 **/

defined('_JEXEC') or die('Restricted access');

JToolBarHelper::apply();
JToolBarHelper::cancel();
JHtml::_('behavior.formvalidation');
JToolBarHelper::title(JText::_('Edit Language'), 'user.png');
?>

   <form action="index.php" method="post" name="adminForm" id="adminForm" class="form-validate">
	  <div class="form-horizontal">
		 
	<?php if($this->dev){?>
	<script type="text/javascript">
	
      function stringGo()
      {
            var string1  = jQuery("#string").val();
            var string2 = changeSign(string1);         
            var string = string2.toUpperCase();    
            var stringreplace = jQuery("#prefix").val()+string; 
                jQuery("#stringreplace").val(stringreplace);
            var stringall = stringreplace+'="'+string1+'"'
            jQuery("#stringall").val(stringall);
            fillData();
      }

      function stringreplaceGo()
      {
          var stringreplace1  	= jQuery("#stringreplace").val();
          var stringreplace2  	= stringreplace1.replace(jQuery("#prefix").val(), "");
          var stringreplace3  	= stringreplace2.toLowerCase();
          stringreplace3      	=  stringreplace3.substr(0, 1).toUpperCase() + stringreplace3.substr(1);
          var stringreplace4    = stringreplace3.replace(/-+-/g,"-");
          stringreplace4		= stringreplace4.replace(/^\_+|\_+$/g,""); 
          var stringreplace5 	= stringreplace4.replace(/_|-/g, ' ');
          jQuery("#string").val(stringreplace5);  
          var stringall = jQuery("#stringreplace").val()+'="'+stringreplace5+'"'
          jQuery("#stringall").val(stringall);
         fillData();
      }
      function fillData()
      {
    	  var filedata 	= jQuery("#filedata").html();
    	  var stringall = jQuery("#stringall").val();
    	  var n = filedata.search(stringall); 
    	  if(n>0){
    		  var r = confirm('<?php echo JText::_('The string have exists, are you sure'); ?>');
    		  if (r == true) {
    			  jQuery("#filedata").html(filedata+'\n'+stringall);
    		  }  
          }else{
        	  jQuery("#filedata").html(filedata+'\n'+stringall);
          }
      }
      function changeSign(str) {  
          str= str.toLowerCase();  
          str= str.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g,"a");  
          str= str.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g,"e");  
          str= str.replace(/ì|í|ị|ỉ|ĩ/g,"i");  
          str= str.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g,"o");  
          str= str.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g,"u");  
          str= str.replace(/ỳ|ý|ỵ|ỷ|ỹ/g,"y");  
          str= str.replace(/đ/g,"d");  
          str= str.replace(/!|@|%|\^|\*|\(|\)|\+|\=|\<|\>|\?|\/|,|\.|\:|\;|\'|\"|\&|\#|\[|\]|~|$/g,""); 
        /* tìm và thay thế các kí tự đặc biệt trong chuỗi sang kí tự - */ 
          str= str.replace(/-+-/g,"-"); //thay thế 2- thành 1- 
          str= str.replace(/^\-+|\-+$/g,"");      
        //cắt bỏ ký tự - ở đầu và cuối chuỗi  
          str= str.replace(/ |-/g, '_'); 
          return str;  
          }
  
</script>
		
				<h1>Support file language</h1>
				<div class="control-group">
					<label class="control-label" ><?php echo JText::_('Prefix'); ?>
					</label>
					<div class="controls">
						<input type="input" name="" id="prefix" value="COM_BOOKPRO_" style="width:200px"/>
					</div>
				</div>
				
				<div class="control-group">
					<label class="control-label"><?php echo JText::_('String'); ?>
					</label>
					<div class="controls">
						<input type="input" name="" id="string" value="Passwords" style="width:500px"/> <input type="button" name="" value="<?php echo JText::_('Go'); ?>" onclick="stringGo();"/>
					</div>
				</div>
				
				<div class="control-group">
					<label class="control-label"><?php echo JText::_('String replace'); ?>
					</label>
					<div class="controls">
						<input type="input" name="" id="stringreplace" value="COM_BOOKPRO_PASSWORDS" style="width:550px"/> <input type="button" name="" value="<?php echo JText::_('Go'); ?>" onclick="stringreplaceGo();"/>
					</div>
				</div>
								
				<div class="control-group">
					<label class="control-label"><?php echo JText::_('String all'); ?>
					</label>
					<div class="controls">
						<input type="input" name="dadich" id="stringall" value='COM_BOOKPRO_PASSWORDS="Passwords"' style="width:900px"/>
					</div>
				</div>					 	
		
	<?php }?>

				<div class="control-group">
					<label class="control-label" for="amount"><?php echo JText::_('Type'); ?>
					</label>
					<div class="controls">
						<input type="text" name="type" placeholder="Type" value="<?php echo $this->type; ?>" id="type" readonly="true">
					</div>
				</div>
				
				<div class="control-group">
					<label class="control-label" for="dests"><?php echo JText::_('File name'); ?>
					</label>
					<div class="controls">
						<input type="text" name="filename" placeholder="File name" value="<?php echo $this->filename; ?>" id="filename" readonly="true">
					</div>
				</div>
				
				<div class="control-group">
					<label class="control-label" for="title"><?php echo JText::_('File data'); ?>
					</label>
					<div class="controls">
						<textarea rows="20" id="filedata" name="filedata" class="" aria-invalid="false" style="width:800px;"><?php echo $this->filedata?></textarea>
					</div>
				</div> 
		</div>
		
	<input type="hidden" name="dev" value="<?php echo $this->dev; ?>" />
	<input type="hidden" name="option" value="<?php echo OPTION; ?>" /> 
	<input type="hidden" name="controller" value="language" /> 
	<input type="hidden" name="task" value="save" /> 
	<input type="hidden" name="boxchecked" value="1" /> 
		<?php echo JHTML::_('form.token'); ?>
</form>
