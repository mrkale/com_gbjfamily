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
		$statistics['events'] = $this->getStatisticsEvents();
		$statistics['incomes'] = $this->getStatisticsIncomes();

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
			->where('state=1')	// Only published events
			->where('id_project=' . $db->quote($this->id)	// Events belonging to the project
			);
		$db->setQuery($query);

		try
		{
			$result = $db->loadAssoc();
			$statistics[JText::_('LIB_GBJ_STAT_CNT')] = $result['cnt'];

			if ($result['cnt'])
			{
				$statistics[JText::_('LIB_GBJ_FIELD_DATEON_LABEL')]
					= JHtml::_('date', $result['dateon_min'], JText::_('LIB_GBJ_FORMAT_DATE_LONG'));
				$statistics[JText::_('LIB_GBJ_FIELD_DATEOFF_LABEL')]
					= JHtml::_('date', $result['dateon_max'], JText::_('LIB_GBJ_FORMAT_DATE_LONG'));

				$unit = JText::_('LIB_GBJ_UNIT_HOURS');

				$label = JText::sprintf('LIB_GBJ_STAT_VALUE_TITLE',
					JText::_('COM_GBJFAMILY_EVENT_DURATION_LABEL'),
					JText::_('LIB_GBJ_STAT_SUM')
				);
				$statistics[$label] = JText::sprintf('LIB_GBJ_STAT_VALUE_UNIT', $result['duration_sum'], $unit);

				$label = JText::sprintf('LIB_GBJ_STAT_VALUE_TITLE',
					JText::_('COM_GBJFAMILY_EVENT_DURATION_LABEL'),
					JText::_('LIB_GBJ_STAT_AVG')
				);
				$statistics[$label] = JText::sprintf('LIB_GBJ_STAT_VALUE_UNIT', $result['duration_avg'], $unit);

				$label = JText::sprintf('LIB_GBJ_STAT_VALUE_TITLE',
					JText::_('COM_GBJFAMILY_EVENT_DURATION_LABEL'),
					JText::_('LIB_GBJ_STAT_MIN')
				);
				$statistics[$label] = JText::sprintf('LIB_GBJ_STAT_VALUE_UNIT', $result['duration_min'], $unit);

				$label = JText::sprintf('LIB_GBJ_STAT_VALUE_TITLE',
					JText::_('COM_GBJFAMILY_EVENT_DURATION_LABEL'),
					JText::_('LIB_GBJ_STAT_MAX')
				);
				$statistics[$label] = JText::sprintf('LIB_GBJ_STAT_VALUE_UNIT', $result['duration_max'], $unit);
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
			->where('state=1')	// Only published events
			->where('id_project=' . $db->quote($this->id)	// Events belonging to the project
			);
		$db->setQuery($query);

		try
		{
			$result = $db->loadAssoc();
			$statistics[JText::_('LIB_GBJ_STAT_CNT')] = $result['cnt'];

			if ($result['cnt'])
			{
				$statistics[JText::_('LIB_GBJ_FIELD_DATEON_LABEL')]
					= JHtml::_('date', $result['dateon_min'], JText::_('LIB_GBJ_FORMAT_DATE_LONG'));
				$statistics[JText::_('LIB_GBJ_FIELD_DATEOFF_LABEL')]
					= JHtml::_('date', $result['dateon_max'], JText::_('LIB_GBJ_FORMAT_DATE_LONG'));

				$unit = JText::_('LIB_GBJ_UNIT_EUR');

				$label = JText::sprintf('LIB_GBJ_STAT_VALUE_TITLE',
					JText::_('LIB_GBJ_FIELD_PRICE_LABEL'),
					JText::_('LIB_GBJ_STAT_SUM')
				);
				$statistics[$label] = JText::sprintf('LIB_GBJ_STAT_VALUE_UNIT', $result['price_sum'], $unit);

				$label = JText::sprintf('LIB_GBJ_STAT_VALUE_TITLE',
					JText::_('LIB_GBJ_FIELD_PRICE_LABEL'),
					JText::_('LIB_GBJ_STAT_AVG')
				);
				$statistics[$label] = JText::sprintf('LIB_GBJ_STAT_VALUE_UNIT', $result['price_avg'], $unit);

				$label = JText::sprintf('LIB_GBJ_STAT_VALUE_TITLE',
					JText::_('LIB_GBJ_FIELD_PRICE_LABEL'),
					JText::_('LIB_GBJ_STAT_MIN')
				);
				$statistics[$label] = JText::sprintf('LIB_GBJ_STAT_VALUE_UNIT', $result['price_min'], $unit);

				$label = JText::sprintf('LIB_GBJ_STAT_VALUE_TITLE',
					JText::_('LIB_GBJ_FIELD_PRICE_LABEL'),
					JText::_('LIB_GBJ_STAT_MAX')
				);
				$statistics[$label] = JText::sprintf('LIB_GBJ_STAT_VALUE_UNIT', $result['price_max'], $unit);
			}
		}
		catch (RuntimeException $e)
		{
			$statistics = null;
			JFactory::getApplication()->enqueueMessage($e->getMessage(), 'warning');
		}

		return $statistics;
	}

}
