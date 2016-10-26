<?php

/**
 * @version    CVS: 1.0.0
 * @package    Com_Tc
 * @author     Parth Lawate <contact@techjoomla.com>
 * @copyright  2016 Parth Lawate
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die;

jimport('joomla.application.component.modellist');

/**
 * Methods supporting a list of Tc records.
 *
 * @since  1.6
 */
class TcModelUsertcs extends JModelList
{
/**
	* Constructor.
	*
	* @param   array  $config  An optional associative array of configuration settings.
	*
	* @see        JController
	* @since      1.6
	*/
	public function __construct($config = array())
	{
		if (empty($config['filter_fields']))
		{
			$config['filter_fields'] = array(
				'id', 'a.`id`',
				'user_id', 'a.`user_id`',
				'name', 'uc.`name`',
				'title', 'c.`title`',
				'client', 'c.`client`',
				'accepted_date', 'a.`accepted_date`',
			);
		}

		parent::__construct($config);
	}

	/**
	 * Method to auto-populate the model state.
	 *
	 * Note. Calling getState in this method will result in recursion.
	 *
	 * @param   string  $ordering   Elements order
	 * @param   string  $direction  Order direction
	 *
	 * @return void
	 *
	 * @throws Exception
	 */
	protected function populateState($ordering = null, $direction = null)
	{
		// Initialise variables.
		$app = JFactory::getApplication('administrator');

		// Load the filter state.
		$search = $app->getUserStateFromRequest($this->context . '.filter.search', 'filter_search');
		$this->setState('filter.search', $search);

		// Load the parameters.
		$params = JComponentHelper::getParams('com_tc');
		$this->setState('params', $params);

		// List state information.
		parent::populateState('c.title', 'asc');
	}

	/**
	 * Method to get a store id based on model configuration state.
	 *
	 * This is necessary because the model is used by the component and
	 * different modules that might need different sets of data or different
	 * ordering requirements.
	 *
	 * @param   string  $id  A prefix for the store id.
	 *
	 * @return   string A store id.
	 *
	 * @since    1.6
	 */
	protected function getStoreId($id = '')
	{
		// Compile the store id.
		$id .= ':' . $this->getState('filter.search');
		$id .= ':' . $this->getState('filter.state');

		return parent::getStoreId($id);
	}

	/**
	 * Build an SQL query to load the list data.
	 *
	 * @return   JDatabaseQuery
	 *
	 * @since    1.6
	 */
	protected function getListQuery()
	{
		// Create a new query object.
		$db    = $this->getDbo();
		$query = $db->getQuery(true);

		// Select the required fields from the table.
		$query->select(
			$this->getState(
				'list.select', 'a.*,c.title,uc.name AS name,c.client'
			)
		);
		$query->from('`#__tc_users` AS a');

		// Join over the user field 'created_by'
		$query->join('LEFT', '#__tc_content AS `c` ON `c`.id = a.`content_id`');

		// Join over the users for the checked out user
		$query->join("LEFT", "#__users AS uc ON uc.id=a.user_id");

		$query->where('c.state=1');

		// Filter by search in title
		$search = $this->getState('filter.search');

		if (!empty($search))
		{
			if (stripos($search, 'id:') === 0)
			{
				$query->where('a.id = ' . (int) substr($search, 3));
			}
			else
			{
				$search = $db->Quote('%' . $db->escape($search, true) . '%');
				$query->where('( c.title LIKE ' . $search . '  OR  c.client LIKE ' . $search . '  OR  uc.name LIKE ' . $search . ')');
			}
		}

		// Add the list ordering clause.
		$orderCol  = $this->state->get('list.ordering');
		$orderDirn = $this->state->get('list.direction');

		if ($orderCol && $orderDirn)
		{
			$query->order($db->escape($orderCol . ' ' . $orderDirn));
		}

		return $query;
	}

	/**
	 * Get an array of data items
	 *
	 * @return mixed Array of data items on success, false on failure.
	 */
	public function getItems()
	{
		$items = parent::getItems();

		return $items;
	}

	/**
	 * Delet attempts
	 *
	 * @param   ARRAY  $cid  array of lesson track id
	 *
	 * @return  true
	 *
	 * @since   1.0.0
	 */
	public function delete($cid)
	{
		$db = JFactory::getDbo();

		if (!empty($cid))
		{
			$group_to_delet = implode(',', $cid);

			$query = $db->getQuery(true);

			// Delete all orders as selected
			$conditions = array(
				$db->quoteName('id') . ' IN ( ' . $group_to_delet . ' )',
			);

			$query->delete($db->quoteName('#__tc_users'));
			$query->where($conditions);

			$db->setQuery($query);

			if (!$db->execute())
			{
					$this->setError($this->_db->getErrorMsg());

					return false;
			}
		}

		return true;
	}
}
