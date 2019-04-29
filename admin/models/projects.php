<?php
/**
 * @package    Joomla.Component
 * @copyright  (c) 2018-2019 Libor Gabaj
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
class GbjfamilyModelProjects extends GbjSeedModelList
{
	/**
	 * The object with statistics query for events
	 *
	 * @var  object
	 */
	protected $statQueryEvents;

	/**
	 * The object with statistics query for incomes
	 *
	 * @var  object
	 */
	protected $statQueryIncomes;

	/**
	 * Extend and amend input query with sub queries, etc.
	 *
	 * @param   object  $query       Query to be extended inserted by reference.
	 * @param   array   $codeFields  List of coded fields.
	 *
	 * @return  void  The extended query for chaining.
	 */
	protected function extendQuery($query, $codeFields = array())
	{
		$db	= $this->getDbo();

		// Extend query with statistics of events
		$this->getStatQueryEvents();

		if (is_object($this->statQueryEvents))
		{
			// Add published events
			$query
				->select('COALESCE(se.events, 0) AS events, se.events_duration')
				->leftJoin('(' . $this->statQueryEvents . ') se ON se.id = a.id AND se.state = ' . Helper::COMMON_STATE_PUBLISHED);

			// Add total events. Allow null value for not existing code table.
			$query
				->select('te.events AS events_total, te.events_duration AS events_duration_total')
				->leftJoin('(' . $this->statQueryEvents . ') te ON te.id = a.id AND te.state = ' . Helper::COMMON_STATE_TOTAL);
		}
		else
		{
			$query->select('null AS events, null AS events_duration, null AS events_total, null AS events_duration_total'
			);
		}

		// Extend query with statistics of incomes
		$this->getStatQueryIncomes();

		if (is_object($this->statQueryIncomes))
		{
			// Add published incomes
			$query
				->select('COALESCE(si.incomes, 0) AS incomes, si.incomes_price')
				->leftJoin('(' . $this->statQueryIncomes . ') si ON si.id = a.id AND si.state = ' . Helper::COMMON_STATE_PUBLISHED);

			// Add total incomes. Allow null value for not existing code table.
			$query
				->select('ti.incomes AS incomes_total, ti.incomes_price AS incomes_price_total')
				->leftJoin('(' . $this->statQueryIncomes . ') ti ON ti.id = a.id AND ti.state = ' . Helper::COMMON_STATE_TOTAL);
		}
		else
		{
			$query->select('null AS incomes, null AS incomes_price, null AS incomes_total, null AS incomes_price_total');
		}

		return parent::extendQuery($query, $codeFields);
	}

	/**
	 * Retrieve statistics for events.
	 *
	 * @return  object  The query for statistics
	 */
	protected function getStatQueryEvents()
	{
		if (is_object($this->statQueryEvents))
		{
			return $this->statQueryEvents;
		}

		$db	= $this->getDbo();

		// Compose subquery for statistics of totals
		$queryTotals = $db->getQuery(true)
			->select($db->quoteName('id_project', 'id'))
			->select(Helper::COMMON_STATE_TOTAL . ' AS state')
			->select('COUNT(*) AS events, SUM(duration) AS events_duration'
			)
			->from($db->quoteName(Helper::getTableName('events')))
			->group($db->quoteName('id_project'));

		// Compose subquery for statistics of states distribution
		$this->statQueryEvents = $db->getQuery(true)
			->select($db->quoteName('id_project', 'id'))
			->select($db->quoteName('state'))
			->select('COUNT(*) AS events, SUM(duration) AS events_duration'
			)
			->from($db->quoteName(Helper::getTableName('events')))
			->group($db->quoteName('id_project'))
			->group($db->quoteName('state'))
			->union($queryTotals);

		return $this->statQueryEvents;
	}

	/**
	 * Retrieve statistics for incomes.
	 *
	 * @return  object  The query for statistics
	 */
	protected function getStatQueryIncomes()
	{
		if (is_object($this->statQueryIncomes))
		{
			return $this->statQueryIncomes;
		}

		$db	= $this->getDbo();

		// Compose subquery for statistics of totals
		$queryTotals = $db->getQuery(true)
			->select($db->quoteName('id_project', 'id'))
			->select(Helper::COMMON_STATE_TOTAL . ' AS state')
			->select('COUNT(*) AS incomes, SUM(price) AS incomes_price')
			->from($db->quoteName(Helper::getTableName('incomes')))
			->group($db->quoteName('id_project'));

		// Compose subquery for statistics of states distribution
		$this->statQueryIncomes = $db->getQuery(true)
			->select($db->quoteName('id_project', 'id'))
			->select($db->quoteName('state'))
			->select('COUNT(*) AS incomes, SUM(price) AS incomes_price')
			->from($db->quoteName(Helper::getTableName('incomes')))
			->group($db->quoteName('id_project'))
			->group($db->quoteName('state'))
			->union($queryTotals);

		return $this->statQueryIncomes;
	}

	/**
	 * Calculates statistics from filtered records.
	 *
	 * @return  array  The list of statistics variables and values.
	 */
	public function getStatistics()
	{
		$statistics['expenses'] = $this->getStatisticsExpenses();
		$statistics['events'] = $this->getStatisticsEvents();
		$statistics['incomes'] = $this->getStatisticsIncomes();

		return $statistics;
	}

	/**
	 * Calculates statistics from incomes for current record.
	 *
	 * @return  array  The list of statistics variables and values.
	 */
	public function getStatisticsExpenses()
	{
		$statistics = array();
		$statistics['recs'] = 0;
		$statistics['cnt'] = 0;
		$statistics['sum'] = 0;
		$statistics['avg'] = 0;

		// Calculation fields
		$fieldIncomes = 'expenses';
		$fieldPrice = $fieldIncomes . '_price';

		if (JFactory::getApplication()->isClient('administrator'))
		{
			$fieldIncomes .= '_total';
			$fieldPrice .= '_total';
		}

		foreach ($this->getItems() as $recordObject)
		{
			if (intval($recordObject->$fieldIncomes))
			{
				$statistics['recs'] += 1;
				$statistics['cnt'] += intval($recordObject->$fieldIncomes);
				$statistics['sum'] += floatval($recordObject->$fieldPrice);
			}
		}

		if ($statistics['recs'] <> 0)
		{
			$statistics['avg'] = $statistics['sum'] / $statistics['recs'];
		}

		return $statistics;
	}

	/**
	 * Calculates statistics from events for current record.
	 *
	 * @return  array  The list of statistics variables and values.
	 */
	public function getStatisticsEvents()
	{
		$statistics = array();
		$statistics['recs'] = 0;
		$statistics['cnt'] = 0;
		$statistics['sum'] = 0;
		$statistics['avg'] = 0;

		// Calculation fields
		$fieldEvents = 'events';
		$fieldDuration = $fieldEvents . '_duration';

		if (JFactory::getApplication()->isClient('administrator'))
		{
			$fieldEvents .= '_total';
			$fieldDuration .= '_total';
		}

		foreach ($this->getItems() as $recordObject)
		{
			if (intval($recordObject->$fieldEvents))
			{
				$statistics['recs'] += 1;
				$statistics['cnt'] += intval($recordObject->$fieldEvents);
				$statistics['sum'] += floatval($recordObject->$fieldDuration);
			}
		}

		if ($statistics['recs'] <> 0)
		{
			$statistics['avg'] = $statistics['sum'] / $statistics['recs'];
		}

		return $statistics;
	}

	/**
	 * Calculates statistics from incomes for current record.
	 *
	 * @return  array  The list of statistics variables and values.
	 */
	public function getStatisticsIncomes()
	{
		$statistics = array();
		$statistics['recs'] = 0;
		$statistics['cnt'] = 0;
		$statistics['sum'] = 0;
		$statistics['avg'] = 0;

		// Calculation fields
		$fieldIncomes = 'incomes';
		$fieldPrice = $fieldIncomes . '_price';

		if (JFactory::getApplication()->isClient('administrator'))
		{
			$fieldIncomes .= '_total';
			$fieldPrice .= '_total';
		}

		foreach ($this->getItems() as $recordObject)
		{
			if (intval($recordObject->$fieldIncomes))
			{
				$statistics['recs'] += 1;
				$statistics['cnt'] += intval($recordObject->$fieldIncomes);
				$statistics['sum'] += floatval($recordObject->$fieldPrice);
			}
		}

		if ($statistics['recs'] <> 0)
		{
			$statistics['avg'] = $statistics['sum'] / $statistics['recs'];
		}

		return $statistics;
	}
}
