<?php
/**
 * @package    Joomla.Component
 * @copyright  (c) 2019 Libor Gabaj
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 * @since      3.8
 */

// No direct access
defined('_JEXEC') or die;

/**
 * View for handling asset records
 *
 * @since  3.8
 */
class GbjfamilyViewAssets extends GbjSeedViewList
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

		// Value
		$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_MEASURE_UNIT'),
			JText::_('COM_GBJFAMILY_FIELD_ASSET_VALUE_LABEL'), JText::_('LIB_GBJ_UNIT_EUR')
		);
		$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_VARIABLE'), JText::_('LIB_GBJ_STAT_SUM'),
			Helper::formatNumber($this->statistics['value']['sum'], JText::_('LIB_GBJ_FIELD_PRICE_FORMAT'))
		);
		$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_VARIABLE'), JText::_('LIB_GBJ_STAT_AVG'),
			Helper::formatNumber($this->statistics['value']['avg'], JText::_('LIB_GBJ_FIELD_PRICE_FORMAT'))
		);
		$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_RANGE'), JText::_('LIB_GBJ_STAT_RNG'),
			Helper::formatNumber($this->statistics['value']['min'], JText::_('LIB_GBJ_FIELD_PRICE_FORMAT')),
			Helper::formatNumber($this->statistics['value']['max'], JText::_('LIB_GBJ_FIELD_PRICE_FORMAT'))
		);

		// Price
		$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_MEASURE_UNIT'),
			JText::_('LIB_GBJ_FIELD_PRICE_LABEL'), JText::_('LIB_GBJ_UNIT_EUR')
		);
		$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_VARIABLE'), JText::_('LIB_GBJ_STAT_SUM'),
			Helper::formatNumber($this->statistics['price']['sum'], JText::_('LIB_GBJ_FIELD_PRICE_FORMAT'))
		);
		$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_VARIABLE'), JText::_('LIB_GBJ_STAT_AVG'),
			Helper::formatNumber($this->statistics['price']['avg'], JText::_('LIB_GBJ_FIELD_PRICE_FORMAT'))
		);
		$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_RANGE'), JText::_('LIB_GBJ_STAT_RNG'),
			Helper::formatNumber($this->statistics['price']['min'], JText::_('LIB_GBJ_FIELD_PRICE_FORMAT')),
			Helper::formatNumber($this->statistics['price']['max'], JText::_('LIB_GBJ_FIELD_PRICE_FORMAT'))
		);

		return $htmlString;
	}
}
