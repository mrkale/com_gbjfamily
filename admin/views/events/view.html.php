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
	 * @return  string  HTML display string.
	 */
	public function htmlStatistics()
	{
		$htmlString = parent::htmlStatistics();

		// Duration
		$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_MEASURE_UNIT'),
			JText::_('COM_GBJFAMILY_EVENT_DURATION_LABEL'), JText::_('LIB_GBJ_UNIT_HOURS')
		);
		$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_VARIABLE'), JText::_('LIB_GBJ_STAT_CNT'),
			Helper::formatNumber($this->statistics['duration']['cnt'], JText::_('LIB_GBJ_FORMAT_RECORDS'))
		);
		$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_VARIABLE'), JText::_('LIB_GBJ_STAT_SUM'),
			Helper::formatNumber($this->statistics['duration']['sum'], JText::_('COM_GBJFAMILY_EVENT_DURATION_FORMAT'))
		);
		$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_VARIABLE'), JText::_('LIB_GBJ_STAT_AVG'),
			Helper::formatNumber($this->statistics['duration']['avg'], JText::_('COM_GBJFAMILY_EVENT_DURATION_FORMAT'))
		);
		$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_RANGE'), JText::_('LIB_GBJ_STAT_RNG'),
			Helper::formatNumber($this->statistics['duration']['min'], JText::_('COM_GBJFAMILY_EVENT_DURATION_FORMAT')),
			Helper::formatNumber($this->statistics['duration']['max'], JText::_('COM_GBJFAMILY_EVENT_DURATION_FORMAT'))
		);

		return $htmlString;
	}
}
