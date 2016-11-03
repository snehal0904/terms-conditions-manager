<?php
/**
* @package		EasySocial
* @copyright	Copyright (C) 2010 - 2014 Stack Ideas Sdn Bhd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* EasySocial is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See COPYRIGHT.php for copyright notices and details.
*/
defined( '_JEXEC' ) or die( 'Unauthorized Access' );
?>
<ul class="list-unstyled">
	<?php foreach( $options as $option ) { ?>
	<li>
        <?php echo $option->get( 'title' ); ?>
		<span data-checkbox-title><?php echo JText::_("PLG_FIELDS_TCCHECKBOX_TERMSANDCONDITIONS_ACCETED"); ?></span><a rel="{handler: 'iframe', size: {x: 500, y: 450}, closable: true}" href="<?php echo $link; ?>" class="modal" onclick="javascript:OpenModal();"><?php echo JText::_("PLG_FIELDS_TCCHECKBOX_LATEST_TERMSANDCONDITIONS"); ?></a>
    </li>
	<?php } ?>
</ul>
