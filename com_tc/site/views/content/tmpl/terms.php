<?php
/**
 * @package    Tjlms
 * @copyright  Copyright (C) 2009 -2010 Techjoomla, Tekdi Web Solutions . All rights reserved.
 * @license    GNU GPLv2 <http://www.gnu.org/licenses/old-licenses/gpl-2.0.html>
 * @link       http://www.com
 */

defined('_JEXEC') or die('Restricted access');
?>
<?php if (!empty($this->content_id))
{
?>
		<div class="alert-no-auto-hide alert-info"><h2>
			<?php
				echo JText::sprintf('COM_TC_LATEST_TERMSANDCONDITIONS', $this->termsandconditions->version);
?>
		</h2></div>
		<div class="clarifix">
	<?php
	
	echo  html_entity_decode($this->termsandconditions->content);
}
?>
</div>
