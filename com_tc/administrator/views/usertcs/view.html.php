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

jimport('joomla.application.component.view');

/**
 * View class for a list of Tc.
 *
 * @since  1.6
 */
class TcViewUsertcs extends JViewLegacy
{
	protected $items;

	protected $pagination;

	protected $state;

	/**
	 * Display the view
	 *
	 * @param   string  $tpl  Template name
	 *
	 * @return void
	 *
	 * @throws Exception
	 */
	public function display($tpl = null)
	{
		$this->state = $this->get('State');
		$this->items = $this->get('Items');
		$this->pagination = $this->get('Pagination');

		// Check for errors.
		if (count($errors = $this->get('Errors')))
		{
			throw new Exception(implode("\n", $errors));
		}

		TcHelpersTc::addSubmenu('usertcs');

		$this->addToolbar();

		$this->sidebar = JHtmlSidebar::render();
		parent::display($tpl);
	}

	/**
	 * Add the page title and toolbar.
	 *
	 * @return void
	 *
	 * @since    1.6
	 */
	protected function addToolbar()
	{
		$state = $this->get('State');
		$canDo = TcHelpersTc::getActions();

		JToolBarHelper::title(JText::_('COM_TC_TITLE_USERTCS'), 'usertcs.png');

		if ($canDo->get('core.edit.state'))
		{
			if (isset($this->items[0]))
			{
				// If this component does not use state then show a direct delete button as we can not trash
				JToolBarHelper::deleteList('', 'usertcs.delete', 'JTOOLBAR_DELETE');
			}
		}

		if ($canDo->get('core.admin'))
		{
			JToolBarHelper::preferences('com_tc');
		}

		// Set sidebar action - New in 3.0
		JHtmlSidebar::setAction('index.php?option=com_tc&view=usertcs');

		$this->extra_sidebar = '';
	}

	/**
	 * Method to order fields 
	 *
	 * @return void 
	 */
	protected function getSortFields()
	{
		return array(
			'a.`id`' => JText::_('JGRID_HEADING_ID'),
			'a.`user_id`' => JText::_('COM_TC_USERTCS_USERID'),
			'uc.`name`' => JText::_('COM_TC_USERTCS_NAME'),
			'u.`title`' => JText::_('COM_TC_USERTCS_TITLE'),
			'a.`client`' => JText::_('COM_TC_USERTCS_CLIENT'),
			'a.`accepted_date`' => JText::_('COM_TC_USERTCS_ACCEPTED_DATE'),
		);
	}
}
