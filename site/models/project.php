<?php
/**
 * @package    Joomla.Component
 * @copyright  (c) 2018-2019 Libor Gabaj
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 * @since      3.8
 */

// No direct access
defined('_JEXEC') or die;

require_once JPATH_COMPONENT_ADMINISTRATOR . '/models/projects.php';

/**
 * General model methods for agenda record.
 *
 * @since  3.8
 */
class GbjfamilyModelProject extends GbjfamilyModelProjects
{
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
		$statistics['facts'] = $this->getStatisticsFacts();

		return $statistics;
	}

	/**
	 * Calculates statistics from expenses for current record.
	 *
	 * @return  array  The list of statistics variables and values.
	 */
	public function getStatisticsExpenses()
	{
		$db	= $this->getDbo();
		$tableName = Helper::getTableName('expenses');
		$query = $db->getQuery(true)
			->select('COUNT(*) AS cnt,'
				. 'MIN(date_on) as dateon_min, MAX(date_on) AS dateon_max,'
				. 'SUM(price) as price_sum, AVG(price) as price_avg, MIN(price) AS price_min, MAX(price) AS price_max'
			)
			->from($db->quoteName($tableName))
			->where('state=' . Helper::COMMON_STATE_PUBLISHED)	// Only published expenses
			->where('id_project=' . $db->quote($this->id)	// Events belonging to the project
			);
		$db->setQuery($query);

		try
		{
			$result = $db->loadAssoc();
			$statistics[JText::_('LIB_GBJ_STAT_CNT')] = $result['cnt'];

			if ($result['cnt'])
			{
				$this->addStatisticsDate($statistics, $result['dateon_min'], JText::_('LIB_GBJ_FIELD_DATEON_LABEL'));
				$this->addStatisticsDate($statistics, $result['dateon_max'], JText::_('LIB_GBJ_FIELD_DATEOFF_LABEL'));

				$measure = JText::_('LIB_GBJ_FIELD_PRICE_LABEL');
				$unit = JText::_('LIB_GBJ_UNIT_EUR');

				$this->addStatisticsNumber($statistics, $result['price_sum'], JText::_('LIB_GBJ_STAT_SUM'), $measure, $unit);
				$this->addStatisticsNumber($statistics, $result['price_avg'], JText::_('LIB_GBJ_STAT_AVG'), $measure, $unit);
				$this->addStatisticsNumber($statistics, $result['price_min'], JText::_('LIB_GBJ_STAT_MIN'), $measure, $unit);
				$this->addStatisticsNumber($statistics, $result['price_max'], JText::_('LIB_GBJ_STAT_MAX'), $measure, $unit);
			}
		}
		catch (RuntimeException $e)
		{
			$statistics = null;
			JFactory::getApplication()->enqueueMessage($e->getMessage(), 'warning');
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
		$db	= $this->getDbo();
		$tableName = Helper::getTableName('events');
		$query = $db->getQuery(true)
			->select('COUNT(*) AS cnt,'
				. 'MIN(date_on) as dateon_min, MAX(date_on) AS dateon_max,'
				. 'SUM(duration) as duration_sum, AVG(duration) as duration_avg, MIN(duration) AS duration_min, MAX(duration) AS duration_max'
			)
			->from($db->quoteName($tableName))
			->where('state=' . Helper::COMMON_STATE_PUBLISHED)	// Only published events
			->where('id_project=' . $db->quote($this->id)	// Events belonging to the project
			);
		$db->setQuery($query);

		try
		{
			$result = $db->loadAssoc();
			$statistics[JText::_('LIB_GBJ_STAT_CNT')] = $result['cnt'];

			if ($result['cnt'])
			{
				$this->addStatisticsDate($statistics, $result['dateon_min'], JText::_('LIB_GBJ_FIELD_DATEON_LABEL'));
				$this->addStatisticsDate($statistics, $result['dateon_max'], JText::_('LIB_GBJ_FIELD_DATEOFF_LABEL'));

				$measure = JText::_('COM_GBJFAMILY_EVENT_DURATION_LABEL');
				$unit = JText::_('LIB_GBJ_UNIT_HOURS');

				$this->addStatisticsNumber($statistics, $result['duration_sum'], JText::_('LIB_GBJ_STAT_SUM'), $measure, $unit);
				$this->addStatisticsNumber($statistics, $result['duration_avg'], JText::_('LIB_GBJ_STAT_AVG'), $measure, $unit);
				$this->addStatisticsNumber($statistics, $result['duration_min'], JText::_('LIB_GBJ_STAT_MIN'), $measure, $unit);
				$this->addStatisticsNumber($statistics, $result['duration_max'], JText::_('LIB_GBJ_STAT_MAX'), $measure, $unit);
			}
		}
		catch (RuntimeException $e)
		{
			$statistics = null;
			JFactory::getApplication()->enqueueMessage($e->getMessage(), 'warning');
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
		$db	= $this->getDbo();
		$tableName = Helper::getTableName('incomes');
		$query = $db->getQuery(true)
			->select('COUNT(*) AS cnt,'
				. 'MIN(date_on) as dateon_min, MAX(date_on) AS dateon_max,'
				. 'SUM(price) as price_sum, AVG(price) as price_avg, MIN(price) AS price_min, MAX(price) AS price_max'
			)
			->from($db->quoteName($tableName))
			->where('state=' . Helper::COMMON_STATE_PUBLISHED)	// Only published incomes
			->where('id_project=' . $db->quote($this->id)	// Events belonging to the project
			);
		$db->setQuery($query);

		try
		{
			$result = $db->loadAssoc();
			$statistics[JText::_('LIB_GBJ_STAT_CNT')] = $result['cnt'];

			if ($result['cnt'])
			{
				$this->addStatisticsDate($statistics, $result['dateon_min'], JText::_('LIB_GBJ_FIELD_DATEON_LABEL'));
				$this->addStatisticsDate($statistics, $result['dateon_max'], JText::_('LIB_GBJ_FIELD_DATEOFF_LABEL'));

				$measure = JText::_('LIB_GBJ_FIELD_PRICE_LABEL');
				$unit = JText::_('LIB_GBJ_UNIT_EUR');

				$this->addStatisticsNumber($statistics, $result['price_sum'], JText::_('LIB_GBJ_STAT_SUM'), $measure, $unit);
				$this->addStatisticsNumber($statistics, $result['price_avg'], JText::_('LIB_GBJ_STAT_AVG'), $measure, $unit);
				$this->addStatisticsNumber($statistics, $result['price_min'], JText::_('LIB_GBJ_STAT_MIN'), $measure, $unit);
				$this->addStatisticsNumber($statistics, $result['price_max'], JText::_('LIB_GBJ_STAT_MAX'), $measure, $unit);
			}
		}
		catch (RuntimeException $e)
		{
			$statistics = null;
			JFactory::getApplication()->enqueueMessage($e->getMessage(), 'warning');
		}

		return $statistics;
	}

	/**
	 * Calculates statistics from facts for current record.
	 *
	 * @return  array  The list of statistics variables and values.
	 */
	public function getStatisticsFacts()
	{
		$db	= $this->getDbo();
		$tableName = Helper::getTableName('facts');
		$query = $db->getQuery(true)
			->select('COUNT(*) AS cnt')
			->from($db->quoteName($tableName))
			->where('state=' . Helper::COMMON_STATE_PUBLISHED)	// Only published facts
			->where('id_project=' . $db->quote($this->id)	// Facts belonging to the project
			);
		$db->setQuery($query);

		try
		{
			$result = $db->loadAssoc();
			$statistics[JText::_('LIB_GBJ_STAT_CNT')] = $result['cnt'];
		}
		catch (RuntimeException $e)
		{
			$statistics = null;
			JFactory::getApplication()->enqueueMessage($e->getMessage(), 'warning');
		}

		return $statistics;
	}
}
