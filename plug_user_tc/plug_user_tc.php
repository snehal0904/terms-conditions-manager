<?php
/**
 * @version    SVN: <svn_id>
 * @package    Plg_System_Tc
 * @copyright  Copyright (C) 2015 - 2016. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 * Shika is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */

// No direct access.
defined('_JEXEC') or die( 'Restricted access');

jimport('joomla.filesystem.file');
jimport('joomla.application.application');
jimport('joomla.html.parameter');
jimport('joomla.plugin.plugin');

/**
 * Methods supporting a list of Tjlms action.
 *
 * @since  1.0.0
 */
class PlgUserplug_User_Tc extends JPlugin
{
	/**
	 * Function used as a trigger after User login
	 *
	 * @param   MIXED  $user     user ID
	 * @param   MIXED  $options  Options available
	 *
	 * @return  boolean true or false
	 *
	 * @since  1.0.0
	 */
	public function onUserAfterLogin($options)
	{
		if ($options['action'] == 'core.login.admin')
		{
			return true;
		}
		
		require_once JPATH_ADMINISTRATOR . '/components/com_tc/models/content.php';
		$model              = JModelLegacy::getInstance('Content', 'TcModel');

		// Call api to get user accepted version
		$version            = $model->getUserTc($options['user']->id);

		// Call api to get client last craeted version
		$client_version     = $model->getCurrentTc('com_tjlms');

		if (empty($version) || $version != $client_version[0]->id)
		{
			$app = JFactory::getApplication();

			// Redirect to Terms and condtitions view
			$app->redirect(JRoute::_(JURI::root() . 'index.php?option=com_tc&view=content&content_id=' . $client_version[0]->id));
		}

		return true;
	}
}
