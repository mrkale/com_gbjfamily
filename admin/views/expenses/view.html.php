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
	 * @return  string  HTML display string.
	 */
	public function htmlStatistics()
	{
		$htmlString = parent::htmlStatistics();

		// Price
		foreach ($this->statistics['price'] as $key => $value)
		{
			$value = Helper::formatNumber($value,
				JText::_('LIB_GBJ_FIELD_PRICE_FORMAT')
			);
			$this->statistics['price'][$key] = $value;
		}

		// Quantity
		foreach ($this->statistics['quantity'] as $key => $value)
		{
			$value = Helper::formatNumber($value);
			$this->statistics['quantity'][$key] = $value;
		}

		// Period
		foreach ($this->statistics['period'] as $key => $value)
		{
			$value = Helper::formatNumber($value,
				$key == 'avg' ? '1' : JText::_('LIB_GBJ_FIELD_PERIOD_FORMAT')
			);
			$this->statistics['period'][$key] = $value;
		}

		$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_MEASURE_UNIT'), JText::_('LIB_GBJ_FIELD_PRICE_LABEL'), JText::_('LIB_GBJ_UNIT_EUR'));
		$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_VARIABLE'), JText::_('LIB_GBJ_STAT_SUM'), $this->statistics['price']['sum']);
		$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_VARIABLE'), JText::_('LIB_GBJ_STAT_AVG'), $this->statistics['price']['avg']);
		$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_RANGE'), JText::_('LIB_GBJ_STAT_RNG'),
			$this->statistics['price']['min'], $this->statistics['price']['max']
		);

		$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_MEASURE'), JText::_('COM_GBJFAMILY_FIELD_EXPENSE_QUANTITY_LABEL'));
		$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_VARIABLE'), JText::_('LIB_GBJ_STAT_SUM'), $this->statistics['quantity']['sum']);
		$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_VARIABLE'), JText::_('LIB_GBJ_STAT_AVG'), $this->statistics['quantity']['avg']);
		$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_RANGE'), JText::_('LIB_GBJ_STAT_RNG'),
			$this->statistics['quantity']['min'], $this->statistics['quantity']['max']
		);

		$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_MEASURE'), JText::_('COM_GBJFAMILY_FIELD_EXPENSE_PERIOD_LABEL'));
		$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_VARIABLE'), JText::_('LIB_GBJ_STAT_SUM'), $this->statistics['period']['sum']);
		$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_VARIABLE'), JText::_('LIB_GBJ_STAT_AVG'), $this->statistics['period']['avg']);
		$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_RANGE'), JText::_('LIB_GBJ_STAT_RNG'),
			$this->statistics['period']['min'], $this->statistics['period']['max']
		);

		return $htmlString;
	}
}
