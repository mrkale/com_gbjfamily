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
		foreach ($this->statistics['duration'] as $key => $value)
		{
			$value = number_format($value,
				JText::_('COM_GBJFAMILY_FORMAT_NUMBER_DECIMALS'),
				JText::_('COM_GBJFAMILY_FORMAT_NUMBER_SEPARATOR_DECIMALS'),
				JText::_('COM_GBJFAMILY_FORMAT_NUMBER_SEPARATOR_THOUSANDS')
			);
			$this->statistics['duration'][$key] = $value;
		}

		$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_MEASURE_UNIT'), JText::_('COM_GBJFAMILY_FIELD_EVENT_DURATION_LABEL'), JText::_('COM_GBJFAMILY_UNIT_HOURS'));
		$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_VARIABLE'), JText::_('LIB_GBJ_STAT_SUM'), $this->statistics['duration']['sum']);
		$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_VARIABLE'), JText::_('LIB_GBJ_STAT_AVG'), $this->statistics['duration']['avg']);
		$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_RANGE'), JText::_('LIB_GBJ_STAT_RNG'), $this->statistics['duration']['min'], $this->statistics['duration']['max']);

		return $htmlString;
	}
}
