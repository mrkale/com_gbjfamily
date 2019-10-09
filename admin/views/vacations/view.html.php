<?php
/**
 * @package    Joomla.Component
 * @copyright  (c) 2017 Libor Gabaj
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
class GbjfamilyViewVacations extends GbjSeedViewList
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
		$this->statistics['date_on']['max'] = $this->statistics['date_off']['max'];
		$periodStat = array_merge($periodStat, $this->statistics['date_on']);
		$htmlString = parent::htmlStatistics($periodStat);

		// Period
		$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_MEASURE'),
			JText::_('LIB_GBJ_FIELD_PERIOD_LABEL')
		);
		$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_VARIABLE'), JText::_('LIB_GBJ_STAT_SUM'),
			Helper::formatNumber($this->statistics['period']['sum'], JText::_('LIB_GBJ_FIELD_PERIOD_FORMAT'))
		);
		$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_VARIABLE'), JText::_('LIB_GBJ_STAT_AVG'),
			Helper::formatNumber($this->statistics['period']['avg'], JText::_('LIB_GBJ_FIELD_PERIOD_FORMAT_AVG'))
		);
		$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_RANGE'), JText::_('LIB_GBJ_STAT_RNG'),
			Helper::formatNumber($this->statistics['period']['min'], JText::_('LIB_GBJ_FIELD_PERIOD_FORMAT')),
			Helper::formatNumber($this->statistics['period']['max'], JText::_('LIB_GBJ_FIELD_PERIOD_FORMAT'))
		);

		return $htmlString;
	}
}
