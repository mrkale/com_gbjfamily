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
	 * The object with statistics query for expenses
	 *
	 * @var  object
	 */
	protected $statQueryExpenses;

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
	 * The object with statistics query for facts
	 *
	 * @var  object
	 */
	protected $statQueryFacts;

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

		// Extend query with statistics of expenses
		$this->getStatQueryExpenses();

		if (is_object($this->statQueryExpenses))
		{
			// Add published expenses
			$query
				->select('COALESCE(sx.expenses, 0) AS expenses, sx.expenses_price')
				->leftJoin('(' . $this->statQueryExpenses . ') sx ON sx.id = a.id AND sx.state = ' . Helper::COMMON_STATE_PUBLISHED);

			// Add archived expenses
			$query
				->select('COALESCE(ax.expenses, 0) AS expenses_arch, ax.expenses_price AS expenses_price_arch')
				->leftJoin('(' . $this->statQueryExpenses . ') ax ON ax.id = a.id AND ax.state = ' . Helper::COMMON_STATE_ARCHIVED);

			// Add total expenses. Allow null value for not existing code table.
			$query
				->select('COALESCE(tx.expenses, 0) AS expenses_total, tx.expenses_price AS expenses_price_total')
				->leftJoin('(' . $this->statQueryExpenses . ') tx ON tx.id = a.id AND tx.state = ' . Helper::COMMON_STATE_TOTAL);
		}
		else
		{
			$query->select('null AS expenses, null AS expenses_price'
				. ', null AS expenses_arch, null AS expenses_price_arch'
				. ', null AS expenses_total, null AS expenses_price_total'
			);
		}

		// Extend query with statistics of events
		$this->getStatQueryEvents();

		if (is_object($this->statQueryEvents))
		{
			// Add published events
			$query
				->select('COALESCE(se.events, 0) AS events, se.events_duration')
				->leftJoin('(' . $this->statQueryEvents . ') se ON se.id = a.id AND se.state = ' . Helper::COMMON_STATE_PUBLISHED);

			// Add archived events
			$query
				->select('COALESCE(ae.events, 0) AS events_arch, ae.events_duration AS events_duration_arch')
				->leftJoin('(' . $this->statQueryEvents . ') ae ON ae.id = a.id AND ae.state = ' . Helper::COMMON_STATE_ARCHIVED);

			// Add total events. Allow null value for not existing code table.
			$query
				->select('COALESCE(te.events, 0) AS events_total, te.events_duration AS events_duration_total')
				->leftJoin('(' . $this->statQueryEvents . ') te ON te.id = a.id AND te.state = ' . Helper::COMMON_STATE_TOTAL);
		}
		else
		{
			$query->select('null AS events, null AS events_duration'
				. ', null AS events_arch, null AS events_duration_arch'
				. ', null AS events_total, null AS events_duration_total'
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

			// Add archived incomes
			$query
				->select('COALESCE(ai.incomes, 0) AS incomes_arch, ai.incomes_price AS incomes_price_arch')
				->leftJoin('(' . $this->statQueryIncomes . ') ai ON ai.id = a.id AND ai.state = ' . Helper::COMMON_STATE_ARCHIVED);

			// Add total incomes. Allow null value for not existing code table.
			$query
				->select('COALESCE(ti.incomes, 0) AS incomes_total, ti.incomes_price AS incomes_price_total')
				->leftJoin('(' . $this->statQueryIncomes . ') ti ON ti.id = a.id AND ti.state = ' . Helper::COMMON_STATE_TOTAL);
		}
		else
		{
			$query->select('null AS incomes, null AS incomes_price'
				. ', null AS incomes_arch, null AS incomes_price_arch'
				. ', null AS incomes_total, null AS incomes_price_total'
			);
		}

		// Extend query with statistics of facts
		$this->getStatQueryFacts();

		if (is_object($this->statQueryFacts))
		{
			// Add published facts
			$query
				->select('COALESCE(sf.facts, 0) AS facts')
				->leftJoin('(' . $this->statQueryFacts . ') sf ON sf.id = a.id AND sf.state = ' . Helper::COMMON_STATE_PUBLISHED);

			// Add archived facts
			$query
				->select('COALESCE(af.facts, 0) AS facts_arch')
				->leftJoin('(' . $this->statQueryFacts . ') af ON af.id = a.id AND af.state = ' . Helper::COMMON_STATE_ARCHIVED);

			// Add total facts
			$query
				->select('COALESCE(tf.facts, 0) AS facts_total')
				->leftJoin('(' . $this->statQueryFacts . ') tf ON tf.id = a.id AND tf.state = ' . Helper::COMMON_STATE_TOTAL);
		}
		else
		{
			$query->select('null AS facts, null AS facts_arch, null AS facts_total');
		}

		return parent::extendQuery($query, $codeFields);
	}

	/**
	 * Retrieve statistics for expenses.
	 *
	 * @return  object  The query for statistics
	 */
	protected function getStatQueryExpenses()
	{
		if (is_object($this->statQueryExpenses))
		{
			return $this->statQueryExpenses;
		}

		$db	= $this->getDbo();

		// Compose subquery for statistics of totals
		$queryTotals = $db->getQuery(true)
			->select($db->quoteName('id_project', 'id'))
			->select(Helper::COMMON_STATE_TOTAL . ' AS state')
			->select('COUNT(*) AS expenses, SUM(price) AS expenses_price')
			->from($db->quoteName(Helper::getTableName('expenses')))
			->group($db->quoteName('id_project'));

		// Compose subquery for statistics of states distribution
		$this->statQueryExpenses = $db->getQuery(true)
			->select($db->quoteName('id_project', 'id'))
			->select($db->quoteName('state'))
			->select('COUNT(*) AS expenses, SUM(price) AS expenses_price')
			->from($db->quoteName(Helper::getTableName('expenses')))
			->group($db->quoteName('id_project'))
			->group($db->quoteName('state'))
			->union($queryTotals);

		return $this->statQueryExpenses;
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
	 * Retrieve statistics for facts.
	 *
	 * @return  object  The query for statistics
	 */
	protected function getStatQueryFacts()
	{
		if (is_object($this->statQueryFacts))
		{
			return $this->statQueryFacts;
		}

		$db	= $this->getDbo();

		// Compose subquery for statistics of totals
		$queryTotals = $db->getQuery(true)
			->select($db->quoteName('id_project', 'id'))
			->select(Helper::COMMON_STATE_TOTAL . ' AS state')
			->select('COUNT(*) AS facts'
			)
			->from($db->quoteName(Helper::getTableName('facts')))
			->group($db->quoteName('id_project'));

		// Compose subquery for statistics of states distribution
		$this->statQueryFacts = $db->getQuery(true)
			->select($db->quoteName('id_project', 'id'))
			->select($db->quoteName('state'))
			->select('COUNT(*) AS facts'
			)
			->from($db->quoteName(Helper::getTableName('facts')))
			->group($db->quoteName('id_project'))
			->group($db->quoteName('state'))
			->union($queryTotals);

		return $this->statQueryFacts;
	}

	/**
	 * Calculates statistics from child agenda records.
	 *
	 * @return  array  The list of statistics variables and values.
	 */
	public function getStatistics()
	{
		$fieldParent = 'id_project';
		$statistics = array();

		$statistics = array_merge($statistics,
			$this->getFilterStatisticsChild('expenses', $fieldParent, array('price'))
		);
		$statistics = array_merge($statistics,
			$this->getFilterStatisticsChild('events', $fieldParent, array('duration'))
		);
		$statistics = array_merge($statistics,
			$this->getFilterStatisticsChild('incomes', $fieldParent, array('price'))
		);
		$statistics = array_merge($statistics,
			$this->getFilterStatisticsChild('facts', $fieldParent)
		);

		return $statistics;
	}
}
