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
 * View for handling agenda records
 *
 * @since  3.8
 */
class GbjfamilyViewEvents extends GbjSeedViewList
{
	/**
	 * Create HTML string for displaying statistics.
	 *
	 * @param   array $periodStat  Array with date statistics.
	 *
	 * @return  string  HTML display string.
	 */
	public function htmlStatistics($periodStat = array())
	{
		$periodStat = array_merge($periodStat, $this->statistics['date_on']);
		$htmlString = parent::htmlStatistics($periodStat);

		// Duration
		$statistic = 'duration';

		if ($this->statistics[$statistic]['sum'])
		{
			$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_MEASURE_UNIT'),
				JText::_('COM_GBJFAMILY_EVENT_DURATION_LABEL'), JText::_('LIB_GBJ_UNIT_HOURS')
			);
			$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_VARIABLE'), JText::_('LIB_GBJ_STAT_CNT'),
				Helper::formatNumber($this->statistics[$statistic]['cnt'], JText::_('LIB_GBJ_FORMAT_RECORDS'))
			);
			$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_VARIABLE'), JText::_('LIB_GBJ_STAT_SUM'),
				Helper::formatNumber($this->statistics[$statistic]['sum'], JText::_('COM_GBJFAMILY_EVENT_DURATION_FORMAT'))
			);
			$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_VARIABLE'), JText::_('LIB_GBJ_STAT_AVG'),
				Helper::formatNumber($this->statistics[$statistic]['avg'], JText::_('COM_GBJFAMILY_EVENT_DURATION_FORMAT'))
			);
			$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_RANGE'), JText::_('LIB_GBJ_STAT_RNG'),
				Helper::formatNumber($this->statistics[$statistic]['min'], JText::_('COM_GBJFAMILY_EVENT_DURATION_FORMAT')),
				Helper::formatNumber($this->statistics[$statistic]['max'], JText::_('COM_GBJFAMILY_EVENT_DURATION_FORMAT'))
			);
		}

		return $htmlString;
	}
}
