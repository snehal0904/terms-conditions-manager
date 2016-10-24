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
	public function onUserLogin($user, $options)
	{
		die("Deepali");
		//GetUserTc($user_id) Get current terms & conditions accepted by the login user
		
		//CheckTCValidity($userid) Check if user accepted the current tc if not then show checkbox which will open model poup of t&c 
		
		// Store this in the #_tc_users table using StoreUserTc($userid,$version) 

		return true;
	}
}
