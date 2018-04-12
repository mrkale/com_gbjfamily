<?php
/**
 * @package    Joomla.Component
 * @copyright  (c) 2017-2018 Libor Gabaj
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 * @since      3.8
 */

// No direct access
defined('_JEXEC') or die;

/**
 * Methods handling list of records.
 *
 * @since  3.8
 */
class GbjfamilyModelEvents extends GbjSeedModelList
{
	/**
	 * Constructor.
	 *
	 * @param   array  $config  Associative array of configuration settings.
	 */
	public function __construct($config = array())
	{
		$config['filter_fields'][] = 'duration_state';
		$config['filter_fields'][] = 'year';
		$config['filter_fields'][] = 'month';
		$config['filter_fields'][] = 'project';

		parent::__construct($config);
	}

	/**
	 * Method to set the default sorting parameters
	 *
	 * @param   string  $ordering   An optional ordering field.
	 * @param   string  $direction  An optional direction (asc|desc).
	 *
	 * @return  void
	 */
	protected function populateState($ordering = null, $direction = null)
	{
		$this->setFilterState('duration_state', 'float');
		$this->setFilterState('year', 'uint');
		$this->setFilterState('month', 'uint');
		$this->setFilterState('project', 'uint');
		
		parent::populateState($ordering, $direction);
		}

	/**
	 * Retrieve list of records from database.
	 *
	 * @return  object  The query for events.
	 */
	protected function getListQuery()
	{
		$db = $this->getDbo();
		$query = parent::getListQuery();

		// Filter by Duration
		$duration_state = $this->getState('filter.duration_state');

		if (is_numeric($duration_state))
		{
			switch ($duration_state)
			{
				// None duration
				case '0':
					$query->where('(' . $db->quoteName('duration') . ' IS NULL)');
					break;

				// Some duration
				case '1':
					$query->where('(' . $db->quoteName('duration') . ' > 0)');
					break;
			}
		}

		// Othe filters
		$this->setFilterQueryYear('year', $query, 'date_on');
		$this->setFilterQueryMonth('month', $query, 'date_on');
		$this->setFilterQueryNumeric('project', $query, 'id_project');

		return $query;
	}
}
