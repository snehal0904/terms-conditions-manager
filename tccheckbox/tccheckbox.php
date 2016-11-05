<?php
/**
	* @package    EasySocial
	* @copyright  Copyright (C) 2010 - 2014 Stack Ideas Sdn Bhd. All rights reserved.
	* @license    GNU/GPL, see LICENSE.php
	* EasySocial is free software. This version may have been modified pursuant
	* to the GNU General Public License, and as distributed it includes or
	* is derivative of works licensed under the GNU General Public License or
	* other free or open source software licenses.
	* See COPYRIGHT.php for copyright notices and details.
	*/
defined('_JEXEC') or die('Unauthorized Access');

// Include the fields library
FD::import('admin:/includes/fields/dependencies');

/**
	* class for SocialFieldsUserTccheckboxValue which will add custom field to registration form.
	*
	* @return	void.
	*
	* @since  1.0
	*/
class SocialFieldsUserTccheckbox extends SocialFieldItem
{
/**
	* Will get getOptions of the terms and conditions checkbox.
	*
	* @return	object.
	*
	* @since  1.0
	*/
	public function getOptions()
	{
		$options = array(
			1 => JText::_('PLG_FIELDS_TCCHECKBOX_TERMSANDCONDITIONS_ACCETED')
		);

		return $options;
	}

/**
	* Will get value of the terms and conditions checkbox.
	*
	* @return	object.
	*
	* @since  1.0
	*/
	public function getValue()
	{
		$container = $this->getValueContainer();

		$tccheckbox = new stdClass;

		switch ($container->data)
		{
			case 1:
			case '1':
				$tccheckbox->text = 'PLG_FIELDS_TCCHECKBOX_TERMSANDCONDITIONS_ACCETED';
				break;
		}

		$tccheckbox->value = $container->data;
		$tccheckbox->title = JText::_($tccheckbox->text);

		$container->value = $tccheckbox;

		return $container;
	}

/**
	* class for SocialFieldsUserTccheckboxValue.
	*
	* @return	String.
	*
	* @since  1.0
	*/
	public function getDisplayValue()
	{
		$value = $this->getValue();

		$term = 'PLG_FIELDS_TCCHECKBOX_OPTION_NOT_ACCEPTED';

		if ($value == 1)
		{
			$term = 'PLG_FIELDS_TCCHECKBOX_TERMSANDCONDITIONS_ACCETED';
		}

		return JText::_($term);
	}

/**
	* Performs validation for the gender field.
	* 
	* @param   INT  $value  value of the checkbox
	*
	* @since	1.0
	* 
	* @return boolean
	*/
	public function validate( $value )
	{
		// Catch for errors if this is a required field.
		if ( $this->isRequired() && empty( $value ) )
		{
			$this->setError(JText::_('PLG_FIELDS_TCCHECKBOX_TERMSANDCONDITIONS_ACCETED_REQUIRED'));

			return false;
		}

		return true;
	}

/**
	* Displays the field input for user when they register their account.
	* 
	* @param   array                    &$post	         The posted data.
	* @param   SocialTableRegistration  &$registration  The registration ORM table.
	* 
	* @since	1.0
	* 
	* @return	string	The html output.
	*/
	public function onRegister( &$post, &$registration )
	{
		// Get the default value.
		$value 		= '';

		// Test if the user had tried to submit any values.
		if (!empty($post[$this->inputName]))
		{
			$value = json_decode($post[$this->inputName]);
		}

		// Detect if there's any errors.
		$error = $registration->getErrors($this->inputName);

		require_once JPATH_ADMINISTRATOR . '/components/com_tc/models/content.php';
		$model              = JModelLegacy::getInstance('Content', 'TcModel');

		// Call api to get client last craeted version
		$client_version     = $model->getCurrentTc('com_tjlms');

		// Store value in the session
		$session = JFactory::getSession();
		$session->set('content_id', $client_version[0]->id);
		$link = JRoute::_(JURI::root() . 'index.php?option=com_tc&view=content&layout=terms&content_id=' . $client_version[0]->id . '&tmpl=component');
		$this->set('link', $link);
		$this->set('error', $error);
		$this->set('value', $value);

		// Display the output.
		return $this->display();
	}

/**
	* Determines whether there's any errors in the submission in the registration form.
	*
	* @param   array                    &$post	         The posted data.
	* @param   SocialTableRegistration  &$registration  The registration ORM table.
	* 
	* @since	1.0
	* 
	* @return	bool	Determines if the system should proceed or throw errors.
	*/
	public function onRegisterValidate(&$post, &$registration)
	{
		$value = !empty($post[$this->inputName]) ? $post[$this->inputName] : '';

		return $this->validate($value);
	}

/**
	* Displays the sample html codes when the field is added into the profile.
	*
	* @since	1.0
	* 
	* @return	string	The html output.
	*/
	public function onSample()
	{
		return $this->display();
	}

/**
	* Checks if this field is complete.
	*
	* @param   array       &$post  The post values.
	* @param   SocialUser  &$user  The user being checked.
	* 
	* @since  1.2
	* 
	* @return	boolean.
	*/
	public function onRegisterAfterSaveFields (array &$post, SocialUser &$user)
	{
		$session = JFactory::getSession();
		$content_id = $session->get('content_id', '');

		// Update #_tc_users table
		if (!empty($post[$this->inputName]))
		{
			require_once JPATH_ADMINISTRATOR . '/components/com_tc/models/content.php';

			// Call api to get user accepted version
			$model                         = JModelLegacy::getInstance('Content', 'TcModel');
			$updatedsuccessfully           = $model->storeUserTc($user->id, $content_id);
		}
	}

/**
	* Checks if this field is complete.
	*
	* @param   SocialUser  $user  The user being checked.
	* 
	* @since  1.2
	* 
	* @return	boolean.
	*/
	public function onFieldCheck($user)
	{
		return $this->validate($this->value);
	}
}

/**
	* class for SocialFieldsUserTccheckboxValue.
	*
	* @return	void.
	*
	* @since  1.0
	*/
class SocialFieldsUserTccheckboxValue extends SocialFieldValue
{
/**
	* Will return title 
	* 
	* @return	string	The html output.
	* 
	* @since	1.0
	*/
	public function toString()
	{
		return $this->value->title;
	}
}
