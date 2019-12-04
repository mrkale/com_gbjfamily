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
 * View for handling expense records
 *
 * @since  3.8
 */
class GbjfamilyViewExpenses extends GbjSeedViewList
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

		// Price
		$statistic = 'price';

		if ($this->statistics[$statistic]['sum'])
		{
			$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_MEASURE_UNIT'),
				JText::_('LIB_GBJ_FIELD_PRICE_LABEL'), JText::_('LIB_GBJ_UNIT_EUR')
			);
			$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_VARIABLE'), JText::_('LIB_GBJ_STAT_SUM'),
				Helper::formatNumber($this->statistics[$statistic]['sum'], JText::_('LIB_GBJ_FIELD_PRICE_FORMAT'))
			);
			$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_VARIABLE'), JText::_('LIB_GBJ_STAT_AVG'),
				Helper::formatNumber($this->statistics[$statistic]['avg'], JText::_('LIB_GBJ_FIELD_PRICE_FORMAT'))
			);
			$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_RANGE'), JText::_('LIB_GBJ_STAT_RNG'),
				Helper::formatNumber($this->statistics[$statistic]['min'], JText::_('LIB_GBJ_FIELD_PRICE_FORMAT')),
				Helper::formatNumber($this->statistics[$statistic]['max'], JText::_('LIB_GBJ_FIELD_PRICE_FORMAT'))
			);
		}

		// Unit price
		$statistic = 'price_unit';

		if ($this->statistics[$statistic]['sum'])
		{
			$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_MEASURE_UNIT'),
				JText::_('COM_GBJFAMILY_FIELD_EXPENSE_PRICEUNIT_LABEL'), JText::_('LIB_GBJ_UNIT_EUR')
			);
			$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_VARIABLE'), JText::_('LIB_GBJ_STAT_CNT'),
				Helper::formatNumber($this->statistics[$statistic]['cnt'], JText::_('LIB_GBJ_FORMAT_RECORDS'))
			);
			$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_VARIABLE'), JText::_('LIB_GBJ_STAT_SUM'),
				Helper::formatNumber($this->statistics[$statistic]['sum'], JText::_('COM_GBJFAMILY_FIELD_EXPENSE_PRICEUNIT_FORMAT'))
			);
			$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_VARIABLE'), JText::_('LIB_GBJ_STAT_AVG'),
				Helper::formatNumber($this->statistics[$statistic]['avg'], JText::_('COM_GBJFAMILY_FIELD_EXPENSE_PRICEUNIT_FORMAT'))
			);
			$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_RANGE'), JText::_('LIB_GBJ_STAT_RNG'),
				Helper::formatNumber($this->statistics[$statistic]['min'], JText::_('COM_GBJFAMILY_FIELD_EXPENSE_PRICEUNIT_FORMAT')),
				Helper::formatNumber($this->statistics[$statistic]['max'], JText::_('COM_GBJFAMILY_FIELD_EXPENSE_PRICEUNIT_FORMAT'))
			);
		}

		// Quantity
		$statistic = 'quantity';

		if ($this->statistics[$statistic]['sum'])
		{
			$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_MEASURE'),
				JText::_('COM_GBJFAMILY_FIELD_EXPENSE_QUANTITY_LABEL')
			);
			$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_VARIABLE'), JText::_('LIB_GBJ_STAT_SUM'),
				Helper::formatNumber($this->statistics[$statistic]['sum'])
			);
			$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_VARIABLE'), JText::_('LIB_GBJ_STAT_AVG'),
				Helper::formatNumber($this->statistics[$statistic]['avg'])
			);
			$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_RANGE'), JText::_('LIB_GBJ_STAT_RNG'),
				Helper::formatNumber($this->statistics[$statistic]['min']),
				Helper::formatNumber($this->statistics[$statistic]['max'])
			);
		}

		// Period
		$statistic = 'period';

		if ($this->statistics[$statistic]['sum'])
		{
			$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_MEASURE_UNIT'),
				JText::_('COM_GBJFAMILY_FIELD_EXPENSE_PERIOD_LABEL'), JText::_('LIB_GBJ_UNIT_DAYS')
			);
			$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_VARIABLE'), JText::_('LIB_GBJ_STAT_CNT'),
				Helper::formatNumber($this->statistics[$statistic]['cnt'], JText::_('LIB_GBJ_FIELD_PERIOD_FORMAT'))
			);
			$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_VARIABLE'), JText::_('LIB_GBJ_STAT_SUM'),
				Helper::formatNumber($this->statistics[$statistic]['sum'], JText::_('LIB_GBJ_FIELD_PERIOD_FORMAT'))
			);
			$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_VARIABLE'), JText::_('LIB_GBJ_STAT_AVG'),
				Helper::formatNumber($this->statistics[$statistic]['avg'], JText::_('LIB_GBJ_FIELD_PERIOD_FORMAT_AVG'))
			);
			$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_RANGE'), JText::_('LIB_GBJ_STAT_RNG'),
				Helper::formatNumber($this->statistics[$statistic]['min'], JText::_('LIB_GBJ_FIELD_PERIOD_FORMAT')),
				Helper::formatNumber($this->statistics[$statistic]['max'], JText::_('LIB_GBJ_FIELD_PERIOD_FORMAT'))
			);
		}

		// Lifespan
		$statistic = 'lifespan';

		if ($this->statistics[$statistic]['sum'])
		{
			$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_MEASURE_UNIT'),
				JText::_('COM_GBJFAMILY_FIELD_EXPENSE_LIFESPAN_LABEL'), JText::_('LIB_GBJ_UNIT_DAYS')
			);
			$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_VARIABLE'), JText::_('LIB_GBJ_STAT_CNT'),
				Helper::formatNumber($this->statistics[$statistic]['cnt'], JText::_('LIB_GBJ_FIELD_PERIOD_FORMAT'))
			);
			$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_VARIABLE'), JText::_('LIB_GBJ_STAT_SUM'),
				Helper::formatNumber($this->statistics[$statistic]['sum'], JText::_('LIB_GBJ_FIELD_PERIOD_FORMAT'))
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
