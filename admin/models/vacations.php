<?php
/**
 * @package    Joomla.Component
 * @copyright  (c) 2017 Libor Gabaj
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
class GbjfamilyModelVacations extends GbjSeedModelList
{
	/**
	 * Constructor
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
	 * @return  none
	 */
	protected function populateState($ordering = null, $direction = null)
	{
		$this->setFilterState('year', 'uint');
		$this->setFilterState('month', 'uint');

		parent::populateState($ordering, $direction);
	}

	/**
	 * Retrieve list of records from database.
	 *
	 * @return  object  The query for vacations.
	 */
	protected function getListQuery()
	{
		$db = $this->getDbo();
		$query = parent::getListQuery();

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
