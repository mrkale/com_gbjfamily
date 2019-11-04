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
 * View for handling fuel records
 *
 * @since  3.8
 */
class GbjfamilyViewFuels extends GbjSeedViewList
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

		// Quantity
		$statistic = 'quantity';

		if ($this->statistics[$statistic]['sum'])
		{
			$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_MEASURE'),
				JText::_('COM_GBJFAMILY_FIELD_FUEL_QUANTITY_LABEL')
			);
			$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_VARIABLE'), JText::_('LIB_GBJ_STAT_SUM'),
				Helper::formatNumber($this->statistics[$statistic]['sum'], JText::_('COM_GBJFAMILY_FIELD_FUEL_QUANTITY_FORMAT'))
			);
			$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_VARIABLE'), JText::_('LIB_GBJ_STAT_AVG'),
				Helper::formatNumber($this->statistics[$statistic]['avg'], JText::_('COM_GBJFAMILY_FIELD_FUEL_QUANTITY_FORMAT'))
			);
			$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_RANGE'), JText::_('LIB_GBJ_STAT_RNG'),
				Helper::formatNumber($this->statistics[$statistic]['min'], JText::_('COM_GBJFAMILY_FIELD_FUEL_QUANTITY_FORMAT')),
				Helper::formatNumber($this->statistics[$statistic]['max'], JText::_('COM_GBJFAMILY_FIELD_FUEL_QUANTITY_FORMAT'))
			);
		}

		// Period
		$statistic = 'period';

		if ($this->statistics[$statistic]['sum'])
		{
			$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_MEASURE'),
				JText::_('COM_GBJFAMILY_FIELD_FUEL_PERIOD_LABEL')
			);
			$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_VARIABLE'), JText::_('LIB_GBJ_STAT_SUM'),
				Helper::formatNumber($this->statistics[$statistic]['sum'], JText::_('COM_GBJFAMILY_FIELD_FUEL_PERIOD_FORMAT'))
			);
			$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_VARIABLE'), JText::_('LIB_GBJ_STAT_AVG'),
				Helper::formatNumber($this->statistics[$statistic]['avg'], JText::_('COM_GBJFAMILY_FIELD_FUEL_PERIOD_FORMAT'))
			);
			$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_RANGE'), JText::_('LIB_GBJ_STAT_RNG'),
				Helper::formatNumber($this->statistics[$statistic]['min'], JText::_('COM_GBJFAMILY_FIELD_FUEL_PERIOD_FORMAT')),
				Helper::formatNumber($this->statistics[$statistic]['max'], JText::_('COM_GBJFAMILY_FIELD_FUEL_PERIOD_FORMAT'))
			);
		}

		// Distance
		$statistic = 'distance';

		if ($this->statistics[$statistic]['sum'])
		{
			$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_MEASURE'),
				JText::_('COM_GBJFAMILY_FIELD_FUEL_DISTANCE_LABEL')
			);
			$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_VARIABLE'), JText::_('LIB_GBJ_STAT_SUM'),
				Helper::formatNumber($this->statistics[$statistic]['sum'], JText::_('COM_GBJFAMILY_FIELD_FUEL_DISTANCE_FORMAT'))
			);
			$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_VARIABLE'), JText::_('LIB_GBJ_STAT_AVG'),
				Helper::formatNumber($this->statistics[$statistic]['avg'], JText::_('COM_GBJFAMILY_FIELD_FUEL_DISTANCE_FORMAT'))
			);
			$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_RANGE'), JText::_('LIB_GBJ_STAT_RNG'),
				Helper::formatNumber($this->statistics[$statistic]['min'], JText::_('COM_GBJFAMILY_FIELD_FUEL_DISTANCE_FORMAT')),
				Helper::formatNumber($this->statistics[$statistic]['max'], JText::_('COM_GBJFAMILY_FIELD_FUEL_DISTANCE_FORMAT'))
			);
		}

		// Consumption
		$statistic = 'consumption';

		if ($this->statistics[$statistic]['sum'])
		{
			$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_MEASURE'),
				JText::_('COM_GBJFAMILY_FIELD_FUEL_CONSUMPTION_LABEL')
			);
			$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_VARIABLE'), JText::_('LIB_GBJ_STAT_AVG'),
				Helper::formatNumber($this->statistics[$statistic]['avg'], JText::_('COM_GBJFAMILY_FIELD_FUEL_CONSUMPTION_FORMAT'))
			);
			$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_RANGE'), JText::_('LIB_GBJ_STAT_RNG'),
				Helper::formatNumber($this->statistics[$statistic]['min'], JText::_('COM_GBJFAMILY_FIELD_FUEL_CONSUMPTION_FORMAT')),
				Helper::formatNumber($this->statistics[$statistic]['max'], JText::_('COM_GBJFAMILY_FIELD_FUEL_CONSUMPTION_FORMAT'))
			);
		}

		return $htmlString;
	}
}
