<?php

/**
 * @version    CVS: 1.0.0
 * @package    Com_Tc
 * @author     Parth Lawate <contact@techjoomla.com>
 * @copyright  2016 Parth Lawate
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */
// No direct access
defined('_JEXEC') or die;

/**
 * Tc Listhelper.
 * 
 * @since  1.6
 */
abstract class JHtmlListhelper
{
/**
	* Tc Listhelper.
	* 
	* @param   integer  $value  The value .
	* @param   integer  $value  The value .
	* @param   integer  $field  The field .
	* @param   integer  $i      The i .
	* 
	* @return $html 
	* 
	* @since  1.6
	*/
	public static function toggle($value , $value, $field, $i)
	{
		$states = array(
		0 => array(
		'icon-remove',
		JText::_('Toggle'),
		'inactive btn-danger'
		),
		1 => array(
		'icon-checkmark',
		JText::_('Toggle'),
		'active btn-success'
		)
		);

		$state = \Joomla\Utilities\ArrayHelper::getValue($states, (int) $value, $states[0]);
		$text  = '<span aria-hidden="true" class="' . $state[0] . '"></span>';
		$html  = '<a href="#" class="btn btn-micro ' . $state[2] . '"';
		$html .= 'onclick="return toggleField(\'cb' . $i . '\',\'' . $view . '.toggle\',\'' . $field . '\')" title=
		"' . JText::_($state[1]) . '">' . $text . '</a>';

	return $html;
	}
}
