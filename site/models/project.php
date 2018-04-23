<?php
/**
 * @package    Joomla.Component
 * @copyright  (c) 2018 Libor Gabaj
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
	 * Calculates statistcs from filtered records.
	 *
	 * @return  array  The list of statistics variables and values.
	 */
	public function getStatistics()
	{
		$statistics['duration'] = $this->getStatisticsEvents();

		return $statistics;
	}

	/**
	 * Calculates statistcs from events for current record.
	 *
	 * @return  array  The list of statistics variables and values.
	 */
	public function getStatisticsEvents()
	{
		$db	= $this->getDbo();
		$tableName = Helper::getTableName('events');
		$query = $db->getQuery(true)
			->select('COUNT(*) AS cnt, SUM(duration) as sum, AVG(duration) as avg, MIN(duration) AS min, MAX(duration) AS max')
			->from($db->quoteName($tableName))
			->where('state=1')	// Only published events
			->where('id_project=' . $db->quote($this->id))	// Events belonging to the project
			->where('duration IS NOT NULL');	// Events with duration sete
		$db->setQuery($query);
		try
		{
			$statistics = $db->loadAssoc();
		}
		catch (RuntimeException $e)
		{
			$statistics = null;
			JFactory::getApplication()->enqueueMessage($e->getMessage(), 'warning');
		}

		return $statistics;
	}

}
