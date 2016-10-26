<?php
/**
 * @package    Tjlms
 * @copyright  Copyright (C) 2009 -2010 Techjoomla, Tekdi Web Solutions . All rights reserved.
 * @license    GNU GPLv2 <http://www.gnu.org/licenses/old-licenses/gpl-2.0.html>
 * @link       http://www.com
 */

defined('_JEXEC') or die('Restricted access');
?>
<script>
	
	function validateform(form)
	{
		var content_id = <?php echo (int) $this->content_id; ?>;
		var user_id = <?php echo (int) $this->user_id; ?>;
		
		if(jQuery("#agree").is(':checked') == true)
		{
			return true;
		}
		else
		{
			alert('<?php echo JText::_("COM_TC_LATEST_TERMSANDCONDITIONS_NOT_ACCETED_ERROR"); ?>');
			return false;
		}
	}
</script>

<?php if (!empty($this->content_id))
{
?>
		<div class="alert-no-auto-hide alert-info">
			<?php
				echo JText::sprintf('COM_TC_LATEST_TERMSANDCONDITIONS', $this->termsandconditions->version);
?>
		</div>
		<div class="">
	<?php
	
	echo  html_entity_decode($this->termsandconditions->content);
}
?>
		</div>
		<div class="">
 <form action="" method="post" name="form" onsubmit="return validateform(this)">
 <input id="agree" type="checkbox" name="accept" value="1">
 <?php
		echo JText::_('COM_TC_LATEST_TERMSANDCONDITIONS_AGREE');
?>
  <input type="hidden" name="option" value="com_tc">
  <input type="hidden" name="task" value="content.accept()">
  <input type="hidden" name="user_id" value="<?php echo $this->user_id; ?>">
  <input type="hidden" name="content_id" value="<?php echo $this->content_id; ?>">
  <input type="submit" value="Submit" name="Submit">
</form>
</div>
