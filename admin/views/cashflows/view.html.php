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
	 * @return  string  HTML display string.
	 */
	public function htmlStatistics()
	{
		$htmlString = parent::htmlStatistics();

		// Price
		foreach ($this->statistics['price'] as $key => $value)
		{
			$value = Helper::formatNumber(
				$value,
				JText::_('LIB_GBJ_FIELD_PRICE_FORMAT')
			);
			$this->statistics['price'][$key] = $value;
		}

		// Price
		foreach ($this->statistics['price_month'] as $key => $value)
		{
			$value = Helper::formatNumber(
				$value,
				JText::_('LIB_GBJ_FIELD_PRICE_FORMAT')
			);
			$this->statistics['price_month'][$key] = $value;
		}

		$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_MEASURE_UNIT'), JText::_('LIB_GBJ_FIELD_PRICE_LABEL'),
			JText::_('LIB_GBJ_UNIT_EUR')
		);
		$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_VARIABLE'), JText::_('LIB_GBJ_STAT_SUM'), $this->statistics['price']['sum']);
		$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_VARIABLE'), JText::_('LIB_GBJ_STAT_AVG'), $this->statistics['price']['avg']);
		$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_RANGE'), JText::_('LIB_GBJ_STAT_RNG'),
			$this->statistics['price']['min'], $this->statistics['price']['max']
		);

		$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_MEASURE_UNIT'), JText::_('COM_GBJFAMILY_FIELD_CASHFLOW_PRICEMONTH_LABEL'),
			JText::_('LIB_GBJ_UNIT_EUR')
		);
		$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_VARIABLE'), JText::_('LIB_GBJ_STAT_SUM'), $this->statistics['price_month']['sum']);
		$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_VARIABLE'), JText::_('LIB_GBJ_STAT_AVG'), $this->statistics['price_month']['avg']);
		$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_RANGE'), JText::_('LIB_GBJ_STAT_RNG'),
			$this->statistics['price_month']['min'], $this->statistics['price_month']['max']
		);

		return $htmlString;
	}
}
