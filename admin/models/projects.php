<?php
/**
 * @package    Joomla.Component
 * @copyright  (c) 2018 Libor Gabaj
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
				->select('COALESCE(se.events, 0) AS events, se.events_start, se.events_stop')
				->leftJoin('(' . $this->statQueryEvents . ') se ON se.id = a.id AND se.state = ' . Helper::COMMON_STATE_PUBLISHED);

			// Add total events. Allow null value for not existing code table.
			$query
				->select('te.events AS events_total, te.events_start AS events_total_start, te.events_stop AS events_total_stop')
				->leftJoin('(' . $this->statQueryEvents . ') te ON te.id = a.id AND te.state = ' . Helper::COMMON_STATE_TOTAL);
		}
		else
		{
			$query->select('null AS events, null AS events_start, null AS events_stop, null AS events_total, null AS events_total_start, null AS events_total_stop');
		}

		return parent::extendQuery($query, $codeFields);
	}

	/**
	 * Retrieve statistics for events of code books.
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
			->select('COUNT(*) AS events, MIN(date_on) AS events_start, MAX(date_on) AS events_stop')
			->from($db->quoteName(Helper::getTableName('events')))
			->group($db->quoteName('id_project'));

		// Compose subquery for statistics of states distribution
		$this->statQueryEvents = $db->getQuery(true)
			->select($db->quoteName('id_project', 'id'))
			->select($db->quoteName('state'))
			->select('COUNT(*) AS events, MIN(date_on) AS events_start, MAX(date_on) AS events_stop')
			->from($db->quoteName(Helper::getTableName('events')))
			->group($db->quoteName('id_project'))
			->group($db->quoteName('state'))
			->union($queryTotals);

		return $this->statQueryEvents;
	}

	/**
	 * Calculates statistics from filtered records.
	 *
	 * @return  array  The list of statistics variables and values.
	 */
	public function getStatistics()
	{
		$statistics['events'] = $this->getStatisticsEvents();

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
		$statistics['cnt'] = 0;
		$statistics['sum'] = 0;
		$statistics['avg'] = 0;

		foreach ($this->getItems() as $recordObject)
		{
			if (intval($recordObject->events))
			{
				$statistics['cnt'] += 1;
				$statistics['sum'] += intval($recordObject->events);
			}
		}

		if ($statistics['cnt'] <> 0)
		{
			$statistics['avg'] = $statistics['sum'] / $statistics['cnt'];
		}

		return $statistics;
	}
}
