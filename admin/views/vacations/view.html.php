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
	 * @return  string  HTML display string.
	 */
	public function htmlStatistics()
	{
		$htmlString = parent::htmlStatistics();

		// Period
		foreach ($this->statistics['period'] as $key => $value)
		{
			$value = Helper::formatNumber($value,
				$key == 'avg' ? '1' : JText::_('LIB_GBJ_FIELD_PERIOD_FORMAT')
			);
			$this->statistics['period'][$key] = $value;
		}

		$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_MEASURE'), JText::_('LIB_GBJ_FIELD_PERIOD_LABEL'));
		$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_VARIABLE'), JText::_('LIB_GBJ_STAT_SUM'), $this->statistics['period']['sum']);
		$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_VARIABLE'), JText::_('LIB_GBJ_STAT_AVG'), $this->statistics['period']['avg']);
		$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_RANGE'), JText::_('LIB_GBJ_STAT_RNG'),
			$this->statistics['period']['min'], $this->statistics['period']['max']
		);

		return $htmlString;
	}
}
