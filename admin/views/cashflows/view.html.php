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
 * View for handling cash flow records
 *
 * @since  3.8
 */
class GbjfamilyViewCashflows extends GbjSeedViewList
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
		$htmlString = parent::htmlStatistics($periodStat);

		// Price
		$statistic = 'price';

		if ($this->statistics[$statistic]['sum'])
		{
			$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_MEASURE_UNIT'),
				JText::_('LIB_GBJ_FIELD_AMOUNT_LABEL'), JText::_('LIB_GBJ_UNIT_EUR')
			);
			$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_VARIABLE'), JText::_('LIB_GBJ_STAT_SUM'),
				Helper::formatNumber($this->statistics[$statistic]['sum'], JText::_('LIB_GBJ_FIELD_AMOUNT_FORMAT'))
			);
			$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_VARIABLE'), JText::_('LIB_GBJ_STAT_AVG'),
				Helper::formatNumber($this->statistics[$statistic]['avg'], JText::_('LIB_GBJ_FIELD_AMOUNT_FORMAT'))
			);
			$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_RANGE'), JText::_('LIB_GBJ_STAT_RNG'),
				Helper::formatNumber($this->statistics[$statistic]['min'], JText::_('LIB_GBJ_FIELD_AMOUNT_FORMAT')),
				Helper::formatNumber($this->statistics[$statistic]['max'], JText::_('LIB_GBJ_FIELD_AMOUNT_FORMAT'))
			);
		}

		// Price monthly
		$statistic = 'price_month';

		if ($this->statistics[$statistic]['sum'])
		{
			$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_MEASURE_UNIT'),
				JText::_('COM_GBJFAMILY_FIELD_CASHFLOW_PRICEMONTH_LABEL'), JText::_('LIB_GBJ_UNIT_EUR')
			);
			$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_VARIABLE'), JText::_('LIB_GBJ_STAT_SUM'),
				Helper::formatNumber($this->statistics[$statistic]['sum'], JText::_('LIB_GBJ_FIELD_AMOUNT_FORMAT'))
			);
			$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_VARIABLE'), JText::_('LIB_GBJ_STAT_AVG'),
				Helper::formatNumber($this->statistics[$statistic]['avg'], JText::_('LIB_GBJ_FIELD_AMOUNT_FORMAT'))
			);
			$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_RANGE'), JText::_('LIB_GBJ_STAT_RNG'),
				Helper::formatNumber($this->statistics[$statistic]['min'], JText::_('LIB_GBJ_FIELD_AMOUNT_FORMAT')),
				Helper::formatNumber($this->statistics[$statistic]['max'], JText::_('LIB_GBJ_FIELD_AMOUNT_FORMAT'))
			);
		}

		// Period
		$statistic = 'period';

		if ($this->statistics[$statistic]['sum'])
		{
			$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_MEASURE'),
				JText::_('COM_GBJFAMILY_FIELD_CASHFLOW_PERIOD_GRID_LABEL')
			);
			$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_VARIABLE'), JText::_('LIB_GBJ_STAT_AVG'),
				Helper::formatNumber($this->statistics[$statistic]['avg'], JText::_('LIB_GBJ_FIELD_PERIOD_FORMAT_AVG'))
			);
			$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_RANGE'), JText::_('LIB_GBJ_STAT_RNG'),
				Helper::formatNumber($this->statistics[$statistic]['min'], JText::_('LIB_GBJ_FIELD_PERIOD_FORMAT')),
				Helper::formatNumber($this->statistics[$statistic]['max'], JText::_('LIB_GBJ_FIELD_PERIOD_FORMAT'))
			);
		}

		return $htmlString;
	}
}
