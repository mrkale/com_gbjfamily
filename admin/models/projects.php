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
	 * Method to set the default sorting parameters
	 *
	 * @param   string  $ordering   An optional ordering field.
	 * @param   string  $direction  An optional direction (asc|desc).
	 *
	 * @return  void
	 */
	protected function populateState($ordering = null, $direction = null)
	{
		$this->setFilterState('events', 'uint');
		parent::populateState($ordering, $direction);
	}

	/**
	 * Retrieve list of records from database.
	 *
	 * @return  object  The query for systems.
	 */
	protected function getListQuery()
	{
		$app = JFactory::getApplication();
		$db = $this->getDbo();
		$query = parent::getListQuery();

		// Filter by child agendas
		$this->setFilterQuerySome('events', $query);

		return $query;
	}

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
				->select('COALESCE(se.events, 0) AS events')
				->leftJoin('(' . $this->statQueryEvents . ') se ON se.id = a.id AND se.state = ' . Helper::COMMON_STATE_PUBLISHED);

			// Add total events. Allow null value for not existing code table.
			$query
				->select('te.events AS events_total')
				->leftJoin('(' . $this->statQueryEvents . ') te ON te.id = a.id AND te.state = ' . Helper::COMMON_STATE_TOTAL);
		}
		else
		{
			$query->select('null AS events, null AS events_total');
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
			->select('COUNT(*) AS events')
			->from($db->quoteName(Helper::getTableName('events')))
			->group($db->quoteName('id_project'));

		// Compose subquery for statistics of states distribution
		$this->statQueryEvents = $db->getQuery(true)
			->select($db->quoteName('id_project', 'id'))
			->select($db->quoteName('state'))
			->select('COUNT(*) AS events')
			->from($db->quoteName(Helper::getTableName('events')))
			->group($db->quoteName('id_project'))
			->group($db->quoteName('state'))
			->union($queryTotals);

		return $this->statQueryEvents;
	}

	/**
	 * Calculates statistcs from filtered records.
	 *
	 * @return  array  The list of statistics variables and values.
	 */
	public function getStatistics()
	{
		$statistics['events']['cnt'] = 0;
		$statistics['events']['sum'] = 0;
		$statistics['events']['avg'] = 0;

		foreach ($this->getItems() as $recordObject)
		{
			if (intval($recordObject->events))
			{
				$statistics['events']['cnt'] += 1;
				$statistics['events']['sum'] += intval($recordObject->events);
			}
		}

		if ($statistics['events']['cnt'] <> 0)
		{
			$statistics['events']['avg'] = $statistics['events']['sum'] / $statistics['events']['cnt'];
		}

		return $statistics;
	}
}
