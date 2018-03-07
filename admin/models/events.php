<?php
/**
 * @package    Joomla.Component
 * @copyright  (c) 2017 Libor Gabaj. All rights reserved.
 * @license    GNU General Public License version 2 or later. See LICENSE.txt, LICENSE.php.
 * @since      3.7
 */

// No direct access
defined('_JEXEC') or die;

/**
 * Methods handling list of records.
 *
 * @since  3.7
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

		// Filter by year
		$year = $this->getState('filter.year');

		if (is_numeric($year))
		{
			$query->where('(YEAR(' . $db->quoteName('date_on') . ') = ' . (int) $year . ')');
		}

		// Filter by month
		$month = $this->getState('filter.month');

		if (is_numeric($month))
		{
			$query->where('(MONTH(' . $db->quoteName('date_on') . ') = ' . (int) $month . ')');
		}

		return $query;
	}
}
