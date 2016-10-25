<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_users
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/**
 * User controller class.
 *
 * @since  1.6
 */
class TcControllerContent extends JControllerForm
{
	/**
	 * Method which will redirect to home page after accepted the Terms & conditions
	 *
	 * @return void
	 */
	public function accept()
	{
		$app        = JFactory::getApplication();
		$input      = $app->input;

		$user_id    = $input->get('user_id', '', 'INT');
		$content_id = $input->get('content_id', '', 'INT');

		// Update #_tc_users table

		require_once JPATH_ADMINISTRATOR . '/components/com_tc/models/content.php';

		// Call api to get user accepted version
		$model                         = JModelLegacy::getInstance('Content', 'TcModel');
		$updatedsuccessfully           = $model->storeUserTc($user_id, $content_id);

		$message = JText::_('COM_TC_LATEST_TERMSANDCONDITIONS_ACCEPTED');

		// Redirect to Terms and condtitions view
		$app->redirect(JRoute::_(JURI::base()), $message);
	}
}
